@extends('Frontend.master')
@section('content')
<main id="main">
    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-12" data-aos="fade-up">
            <h3 class="category-title">Category: {{$asd->category_name}}</h3>
               @if ($category_wise_post !== null)
               @foreach ($category_wise_post as $posts)


               <div class="d-md-flex post-entry-2 half">
                   <a href="single-post.html" class="me-4 thumbnail">
                     <img src="{{asset('dashboard_post')}}/{{$posts->featured_image}}" alt="" class="img-fluid">
                   </a>
                   <div>
                     <div class="post-meta"><span class="date">{{$posts->rel_to_category->category_name}}</span> <span class="mx-1">&bullet;</span> <span>{{$posts->created_at->format('M-d-Y')}}</span></div>
                     <h3><a href="{{route('post_even.details', $posts->id)}}">{{$posts->title}}</a></h3>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
                     <div class="d-flex align-items-center author">
                       <div class="photo"><img src="{{asset('dashboard_post')}}/{{$posts->featured_image}}" alt="" class="img-fluid"></div>

                       <div class="name">

                        <h3 class="m-0 p-0"><a href="{{route('writer.post',$posts->author_id)}}">Writter : {{$posts->rel_to_user->name}}</a></h3>

                       </div>
                     </div>
                   </div>
                 </div>
                 @endforeach



               <div class="text-start py-4">
                @else
                no post

               @endif


              <div class="custom-pagination">
                <a href="#" class="prev">Prevous</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="next">Next</a>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>
  </main>
@endsection
