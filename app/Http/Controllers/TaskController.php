<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

// Route::get('/property', 'PropertyController@index');
// Route::get('/property/create', 'PropertyController@create');
// Route::post('/property', 'PropertyController@store');
// Route::get('/property/{property}', 'PropertyController@show');
// Route::get('/property/edit/{property}', 'PropertyController@edit');
// Route::post('/property/{property}', 'PropertyController@update');
// Route::delete('/property/{property}', 'PropertyController@destroy');

class TaskController extends Controller
{
    public function index()
    {
        return Task::where('archive', 0)
                    ->orderBy('id', 'desc')->get();
    }

    public function archived()
    {
        return Task::where('archive', 1)
                     ->orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
             'body' => 'required|max:500'
         ]);
        return Task::create(['body' => request('body')]);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:500'
        ]);

        $task = Task::findOrFail($id);
        $task ->body = $request->body;
        $task->save();
    }

    public function archive($id)
    {
        $task = Task::findOrFail($id);
        $task->archive = ! $task->archive;
        $task->save();
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
