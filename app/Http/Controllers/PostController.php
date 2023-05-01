<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function add_post(){
        $tags = Tag::all();
        $categories = CategoryModel::all();
        return view('admin.post.add_post',[
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }
    function post_store(Request $request){
         $after_implode= implode(',',$request->tag_id);


        $imageName = $request->title.'.'.$request->feature_image->extension();

            // Public Folder
            $request->feature_image->move(public_path('Dashboard_post'), $imageName);

        Post::create([
            'author_id'=>Auth::id(),
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'description'=>$request->description,
            'tag_id'=>$after_implode,
            'featured_image'=>$imageName,
            'slug'=>$request->title.'-'.rand(10000,9999999),
        ]);
        return back()->with('success','Successfully Added The Post');
    }
    function post_list(){

        $post = Post::where('author_id',Auth::id())->get();

        return view('admin.post.post_list',[
            'post'=>$post,
        ]);
    }
    function post_details($id){

        $post_details = Post::find($id);
         $post_details->title;
         return view('admin.post.post_details',[
            'post_details'=>$post_details,
         ]);
    }
    function delete_post(Request $request){
        Post::find($request->up_id)->delete();
        return response()->json([
            'status'=>'success',
          ]);

    }
    function post_edit($id){
        $categories = CategoryModel::all();
       $post =  Post::find($id);
       $tags = Tag::all();
       return view('admin.post.post_edit',[
        'post'=>$post,
        'categories'=>$categories,
        'tags'=>$tags,
       ]);
    }
    function edit_post(Request $request){
        $after_implode= implode(',',$request->tag_id);

        Post::where('id',$request->id)->update([
               'category_id'=>$request->category_id,
               'title'=>$request->title,
               'description'=>$request->description,
               'tag_id'=>$after_implode,
        ]);
        return back()->with('success',"successfully Updated");
    }
}
