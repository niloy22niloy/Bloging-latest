<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ComentModel;
use App\Models\PopularPost;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function homepage(){
         $slider_post = Post::latest('created_at')->take(3)->get();
         $posts_big = Post::whereRaw('id % 5 = 0')->orderByDesc('created_at')->get();

          $posts_even =  Post::latest()->paginate(3);
          $posts_odd = Post::whereRaw('id % 2  != 0')->orderByDesc('created_at')->get();
          $popular_posts = PopularPost::groupBy('post_id')
   ->selectRaw('post_id, sum(total_view) as sum')
   ->orderBy('sum','DESC')
   ->take(5)
   ->get();



        $posts = Post::orderByDesc('created_at')->get();
        $posts_divisible_by_5 = $posts->filter(function ($post) {
        return $post->id % 5 == 0;
        });

       $posts_odd = $posts->filter(function ($post) {
       return $post->id % 2 == 1;
      })->reject(function ($post) use ($posts_divisible_by_5) {
    return $posts_divisible_by_5->contains('id', $post->id);
   });



        $categories = CategoryModel::all();
        $tags = Tag::all();
        return view('Frontend.first_page',[
            'categories'=>$categories,
            'slider_post'=>$slider_post,
            'posts_big'=> $posts_big,
            'posts_even'=>$posts_even,
            'posts_odd'=>$posts_odd,
            'tags'=>$tags,
            'popular_posts'=>$popular_posts,
        ]);
    }
    function categorywise_blog_show($id,$name){

        $categories=CategoryModel::all();
        $tags = Tag::all();
       $asd = CategoryModel::where('id',$id)->first();
       $category_wise_post =  Post::where('category_id',$asd->id)->get();
       $popular_posts = PopularPost::groupBy('post_id')
   ->selectRaw('post_id, sum(total_view) as sum')
   ->orderBy('sum','DESC')
   ->take(5)
   ->get();

      return view('Frontend.categorywise_post',[
        'asd'=>$asd,
        'categories'=>$categories,
        'tags'=>$tags,
        'category_wise_post'=>$category_wise_post,
        'popular_posts'=>$popular_posts,
      ]);
    }
    function writer_post($id){

      $tagss =  Post::select('tag_id')->groupBy('tag_id')
   ->selectRaw('tag_id, sum(tag_id) as sum')
   ->where('author_id',$id)
   ->get();
        // $tagss = Post::select('tag_id')
        // ->distinct()
        // ->where('author_id', $id)
        // ->get();

        $category_info = Post::select('category_id')->groupBy('category_id')->selectRaw('category_id, sum(category_id) as sum')->where('author_id',$id)->get();

        $user = User::find($id);
       $author_posts =  Post::where('author_id',$id)->get();
       $categories = CategoryModel::all();
       $tags = Tag::all();
       return view('Frontend.author_post',[
        'author_posts'=>$author_posts,
        'categories'=>$categories,
        'tags'=>$tags,
        'user'=>$user,
        'category_info'=>$category_info,
        'tagss'=>$tagss,

       ]);
    }
    function author_list(){
      $categories = CategoryModel::all();
      $tags = Tag::all();

       $author_list =  Post::select('author_id')->groupBy('author_id')->selectRaw('author_id, sum(author_id) as sum')->get();
      return view('Frontend.author_list',[
        'author_list'=>$author_list,
        'categories'=>$categories,
        'tags'=>$tags,

      ]);

    }
    function post_even_details($id){
        $post = Post::find($id);

     $ip =  gethostbyname(gethostname());
      $asd=Post::where('id',$id)->get();



      $post_details = Post::find($id);
      if(PopularPost::where('post_id',$id)->exists()){
        PopularPost::where('post_id',$id)->increment('total_view',1);
      }else{
        PopularPost::create([
          'post_id'=>$id,
          'total_view'=>1,


        ]);
      }


      // $comments = ComentModel::where('post_id',$asd->first()->id)->get();
      // $comments = ComentModel::with('replies')->where('post_id',$asd->first()->id)->get();
      $comments =  ComentModel::where('post_id',$asd->first()->id)->where('parent_id',Null)->get();
      $reply =     ComentModel::with('replies')->where('post_id',$asd->first()->id)->where('parent_id','!=',Null)->get();

      $categories = CategoryModel::all();
      $tags = Tag::all();
      $popular_posts = PopularPost::groupBy('post_id')
   ->selectRaw('post_id, sum(total_view) as sum')
   ->orderBy('sum','DESC')
   ->take(5)
   ->get();

      return view('Frontend.post_details_even',[
        'categories'=>$categories,
        'tags'=>$tags,
        'post_details'=>$post_details,
        'comments'=>$comments,
        'reply'=>$reply,
        'popular_posts'=>$popular_posts,

      ]);
      return back();
    }
}
