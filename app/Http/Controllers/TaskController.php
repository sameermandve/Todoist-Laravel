<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::where("user_id", Auth::id())
            ->where("status", "pending")
            ->latest("created_at")
            ->get();

        return view("home", [
            "tasks" => $tasks,
        ]);
    }

    public function historyTaskList()
    {
        $tasks = Task::where("user_id", Auth::id())
            ->latest("created_at")
            ->get();

        return view("tasks.history", [
            "tasks" => $tasks,
        ]);
    }

    public function addTask()
    {
        return view("tasks.add");
    }

    public function addTaskPost(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required | max:255",
            "description" => "required",
            "deadline" => "required | date | after_or_equal:today",
        ]);

        $task = Task::create([
            ...$validatedData,
            "user_id" => Auth::id(),
        ]);

        if ($task) {
            return redirect(route("home"))
                ->with("success", "Task added successfully");
        }

        return redirect(route("tasks.view.add"))
            ->with("error", "Error occured while adding task");
    }

    public function updateTask($id)
    {
        $result = Task::where("id", $id)
            ->update(["status" => "Completed"]);

        if ($result) {
            return redirect()->route('home')
                ->with('success', 'Task marked as complete');
        }

        return redirect()->route('home')
            ->with('error', 'Failed to update task');
    }

    public function deleteTask($id)
    {
        $result = Task::destroy($id);

        if ($result) {
            return redirect(route("home"))
                ->with("success", "Task deleted successfully");
        }

        return redirect(route("home"))
            ->with("error", "Failed to delete task");
    }
}
