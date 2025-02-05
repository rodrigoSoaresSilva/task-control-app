<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NewTaskMail;
use App\Exports\TasksExport;
use Barryvdh\DomPDF\Facade\Pdf;

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
        if ($task->user_id != auth()->user()->id) {
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
        if ($task->user_id != auth()->user()->id) {
            return view('access-denied');
        }

        $task->delete();

        return redirect()->route('task.index');
    }

    /**
     * Exports task data based on the requested file extension.
     *
     * This method retrieves the requested file extension from the request (either 'xlsx' or 'csv').
     * If the extension is not provided, it defaults to 'xls'. The extension is then validated
     * against a list of permitted extensions. If the requested extension is invalid, the user
     * is redirected back to the task index page.
     *
     * If the extension is valid, the method proceeds to export the task data using the
     * `TasksExport` class, generating the file in the specified format.
     */
    public function exportExcel(Request $request)
    {
        $permitted_extensions  = ['xlsx', 'csv'];
        $extension = $request->get('extension') ?? 'xls';

        if (in_array($extension, $permitted_extensions)) {
            $exporter = new TasksExport();
            
            return $exporter->export($extension);
        }
        
        return redirect()->route('task.index');
    }

    /**
     * Export the user's tasks as a PDF document.
     *
     * This method retrieves all tasks associated with the authenticated user,
     * generates a PDF using the specified view ('task.pdf'), and streams the
     * PDF to the browser for viewing. The PDF is formatted for A4 paper in
     * landscape orientation.
     */
    public function exportPDF(Request $request)
    {
        $tasks = auth()->user()->tasks()->get();

        $pdf = Pdf::loadView('task.pdf', ['tasks' => $tasks]);

        $pdf->setPaper('A4', 'landscape');

        // return $pdf->download('tarefas.pdf'); // Forces download
        return $pdf->stream('tarefas.pdf');
    }
}
