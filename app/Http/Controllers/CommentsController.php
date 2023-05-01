<?php

namespace App\Http\Controllers;

use App\Models\ComentModel;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    function comment_store(Request $request){
        
        ComentModel::create([
        'guest_id'=>Auth::guard('guestlogin')->user()->id,
        'post_id'=>$request->post_id,
        'comment'=>$request->message,
        'parent_id'=>$request->parent_id,
        
        ]);
        return back();
    }
    function comment_stores(Request $request){
        $input = $request->all();
        $input['guest_id'] = Auth::guard('guestlogin')->user()->id;
    
        Comment::create($input);
   
        return back();
    }
}
