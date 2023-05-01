<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagModel;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function add_tag_form(){
        $tags = Tag::all();
        return view('admin.tag.tag_form',[
            'tags'=>$tags,
        ]);
    }
    function tag_insert(Request $request){
        $request->validate([
            'tag_name' => "required|unique:tags,tag_name",
            
        ]);
       Tag::create([
        'tag_name'=>$request->tag_name,
       ]);
       return back()->with('success','Tag Inserted Successfully');
    }
    function tag_delete($id){
        Tag::find($id)->delete();
        return back()->with('success','Tag Deleted Successfully');
    }
    function tag_edit_form($id){
        $tags = Tag::find($id);
        return view('admin.tag.tag_edit_form',[
            'tags'=>$tags,
        ]);
    }
    function tag_update(Request $request,$id){
        $request->validate([
            'tag_name' => "required|unique:tags,tag_name",
            
        ]);
        Tag::where('id',$id)->update([
        'tag_name'=>$request->tag_name,
        ]);
        return back()->with('success','Tag Edited Successfully');
    }
}
