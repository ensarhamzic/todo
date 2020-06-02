<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AList;

class AjaxController extends Controller
{
    public function index(Request $request) {
        $id = $request->listId;
        $tasks = AList::find($id)->tasks;
        if(AList::find($id)->user->id == auth()->user()->id){
            return $tasks->pluck('task');
        }
        else{
            abort(404);
        }
     }
    public function store(Request $request){
        $id = $request->userId;
        $listName = $request->newListName;
        AList::create([
            'user_id' => $id,
            'name' => $listName
        ]);
    }
}
