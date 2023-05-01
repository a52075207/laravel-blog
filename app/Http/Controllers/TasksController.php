<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::incomplete()->get();
        foreach($tasks as $task) {
            echo '<a href="/tasks/'.$task->id.'"/>';
            echo $task->created_at->timezone('Asia/Taipei')->format('Y-m-d')."<br>";
        }
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
}
