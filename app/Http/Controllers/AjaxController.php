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
        return $tasks->pluck('task');
     }
}
