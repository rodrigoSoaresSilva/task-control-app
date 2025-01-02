<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Authentication middleware
    public function __construct(){
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Authentication with Helper
        if(auth()->check()){
            $id = auth()->user()->id;
            $name = auth()->user()->name;
            $email = auth()->user()->email;

            return "ID: $id | Name: $name | Email: $email";
        } else {
            return 'You are not logged in.';
        }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
