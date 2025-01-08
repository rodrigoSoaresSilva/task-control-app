<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NewTaskMail;

// use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        // Authentication middleware
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->paginate(10);
        return view('task.index', ['tasks' => $tasks]);
        /*
        $id = auth()->user()->id;
        $name = auth()->user()->name;
        $email = auth()->user()->email;

        return "ID: $id | Name: $name | Email: $email";

        // Authentication with Helper
        if(auth()->check()){
            $id = auth()->user()->id;
            $name = auth()->user()->name;
            $email = auth()->user()->email;

            return "ID: $id | Name: $name | Email: $email";
        } else {
            return 'You are not logged in.';
        }
        */

        /*
        // Authentication with import
        // use Illuminate\Support\Facades\Auth;
        if(Auth::check()){
            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;

            return "ID: $id | Name: $name | Email: $email";
        } else {
            return 'You are not logged in.';
        }
         */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validations = [
            'task' => 'required|min:3|max:255',
            'deadline' => 'required|date',
        ];

        $validation_messages = [
            'required' => 'O campo deve ser preenchido',
            'task.min' => 'O campo Tarefa deve ter no mínimo 3 caracteres',
            'task.max' => 'O campo Tarefa deve ter no máximo 255 caracteres',
            'deadline.date' => 'O campo Data limite conclusão deve ter uma data válida',
        ];

        $request->validate($validations, $validation_messages);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $task = Task::create($data);

        $receiver = auth()->user()->email;

        Mail::to($receiver)->send(new NewTaskMail($task));

        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return $task->user_id == auth()->user()->id ? view('task.edit', ['task' => $task]) : view('access-denied');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if($task->user_id != auth()->user()->id){
            return view('access-denied');
        }

        $validations = [
            'task' => 'required|min:3|max:255',
            'deadline' => 'required|date',
        ];

        $validation_messages = [
            'required' => 'O campo deve ser preenchido',
            'task.min' => 'O campo Tarefa deve ter no mínimo 3 caracteres',
            'task.max' => 'O campo Tarefa deve ter no máximo 255 caracteres',
            'deadline.date' => 'O campo Data limite conclusão deve ter uma data válida',
        ];

        $request->validate($validations, $validation_messages);

        $task->update($request->all());

        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if($task->user_id != auth()->user()->id){
            return view('access-denied');
        }

        $task->delete();

        return redirect()->route('task.index');
    }
}
