<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reply;
use App\Comment;
use Auth;

class ReplysController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        if (Auth::check()) {
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $reply = Reply::create([
            'user_id' => $user_id,
            'comment_id' => $request->comment_id,
            'content' => $request->content,
        ]);
    }
}
