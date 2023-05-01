<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PopularPost;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function search(Request $request){
       $asd =  $request->q;
        $data = $request->all();
        $search_post = Post::where(function($q) use ($data){
               if(!empty($data['q']) && $data['q']!='' && $data['q']!= 'undefined'){
                $q->where(function ($q) use ($data){
                   $q->where('title','like','%'.$data['q'].'%');
                   $q->orwhere('description','like','%'.$data['q'].'%');
                });

               }
        })->get();

        $categories = CategoryModel::all();
        $tags = Tag::all();
        $popular_posts = PopularPost::groupBy('post_id')
   ->selectRaw('post_id, sum(total_view) as sum')
   ->orderBy('sum','DESC')
   ->take(5)
   ->get();

        return view('frontend.search',[
            'categories'=>$categories,
            'tags'=>$tags,
            'search_post'=>$search_post,
            'asd'=>$asd,
            'popular_posts'=>$popular_posts,

        ]);
    }

    function check($id){
        return $id;
    }
}
