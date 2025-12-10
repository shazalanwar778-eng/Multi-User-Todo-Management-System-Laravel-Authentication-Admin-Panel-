<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // Double-check admin authorization
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized. Admin access required.');
        }

        $totalUsers = User::where('role', 'user')->count();
        $totalTodos = Todo::count();
        $allTodos = Todo::with('user')->orderBy('created_at', 'desc')->paginate(20);
        $users = User::where('role', 'user')->orderBy('name')->get();

        return view('admin.dashboard', compact('totalUsers', 'totalTodos', 'allTodos', 'users'));
    }

    public function showUserTodos(User $user)
    {
        // Double-check admin authorization
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized. Admin access required.');
        }

        // Ensure only regular users can be viewed (not admins)
        if ($user->role !== 'user') {
            abort(404, 'User not found.');
        }

        $userTodos = $user->todos()->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.user-todos', compact('user', 'userTodos'));
    }

    public function showTodo(Todo $todo)
    {
        // Double-check admin authorization
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized. Admin access required.');
        }

        return view('admin.todo-detail', compact('todo'));
    }
}
