<?php

namespace App\Http\Controllers;

use App\Account;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function create(Account $account)
    {
        return view('tasks.create', compact('account'));
    }


    public function store(Account $account)
    {
        $validated = request()->validate([
            'name' => 'required',
            'account_id' => 'required|exists:accounts,id',
            'command' => 'required',
            'arguments' => 'sometimes',
            'frequency' => 'required',
            'limit' => 'sometimes'
        ]);

        $account->tasks()->create($validated);

        return redirect()->route('accounts.show', $account->id)->with('flash_message', 'Task created successfully');
    }

    public function index(Account $account)
    {
        return $account->tasks;
    }
    public function destroy(Account $account, Task $task)
    {
        $task->delete();

        return response(null, 204);
    }

    public function edit(Account $account, Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
}
