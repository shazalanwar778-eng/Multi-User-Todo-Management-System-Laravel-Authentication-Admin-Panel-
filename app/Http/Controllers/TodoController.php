<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Auth::user()->todos;
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt,zip,rar,jpeg,jpg,png,gif|max:5120',
        ]);

        $data = $request->only(['title', 'description']);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('todo_images', 'public');
        }

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('todo_attachments', 'public');
        }

        // Create todo for authenticated user
        Auth::user()->todos()->create($data);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    public function show(Todo $todo)
    {
        // Ensure user can only view their own todos
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        // Ensure user can only edit their own todos
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        // Ensure user can only update their own todos
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt,zip,rar,jpeg,jpg,png,gif|max:5120',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($todo->image) {
                Storage::disk('public')->delete($todo->image);
            }
            $data['image'] = $request->file('image')->store('todo_images', 'public');
        }

        if ($request->hasFile('attachment')) {
            // Delete old attachment
            if ($todo->attachment) {
                Storage::disk('public')->delete($todo->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('todo_attachments', 'public');
        }

        $todo->update($data);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        // Ensure user can only delete their own todos
        if ($todo->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete associated files
        if ($todo->image) {
            Storage::disk('public')->delete($todo->image);
        }
        if ($todo->attachment) {
            Storage::disk('public')->delete($todo->attachment);
        }

        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
    }
}
