<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index()
    {
        $todo = Todo::all();
        return view('index')->with('todos', $todo);
    }

    public function create()
    {
        return view('todos.create');

        
    }

    public function details(Todo $todo){

    return view('details')->with('todo', $todo);

}

    public function edit(Todo $todo)
{
    return view('edit')->with('todo', $todo);
}

    public function update(Todo $todo){
 
        $data = request()->all();

       
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');

    }

    public function delete(Todo $todo){

        $todo->delete();

        return redirect('/');

    }

    public function store(Request $request)
    {
          $data = request()->all();


        $data = Todo::create([
            'name'=> $data['title'],
            'description'=> $data['description'],
        ]);

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');
    }
}

