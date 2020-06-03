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
        if($id == auth()->user()->id) {
            $listName = $request->newListName;
            $newList = AList::create([
                'user_id' => $id,
                'name' => $listName
            ]);
            $data = [$newList->id, $newList->name];
            return $data;
        }
        else {
            abort(404);
        }
    }
    public function create(Request $request){
        $num = 0;
        $id = $request->userId;
        if($id == auth()->user()->id){
            $taskName = $request->taskName;
            $ids = $request->ids;
            $allIds = auth()->user()->lists->pluck('id');
            if(count($allIds) == count($ids)){
                for($i = 0; $i < count($allIds); $i++){
                    if($allIds[$i] == $ids[$i]){
                        $num+=1;
                    }
                    if($num == count($allIds)){
                        return "a";
                    }
                }
            }
        }
    }
}
