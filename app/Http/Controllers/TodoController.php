<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::orderBy('created_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $newTodo = new Todo();
        $newTodo->title = $request->todo['title'];
        $newTodo->completed = $request->todo['completed'];
        $newTodo->save();
        return $newTodo;
    }

    public function update(Request $request, $id)
    {
        $existTodo = Todo::find($id);
        if ($existTodo) {
            $existTodo->title = $request->todo['title'];
            $existTodo->completed = $request->todo['completed'] ? true : false;
            $existTodo->completed_at = $request->todo['completed'] ? Carbon::now() : null;
            $existTodo->save();
            return $existTodo;
        }
        return "Todo not found !!!";
    }
    public function destroy($id)
    {
        $existTodo = Todo::find($id);
        if ($existTodo) {
            $existTodo->delete();
        }
        return "Todo not found !!!";
    }
}
