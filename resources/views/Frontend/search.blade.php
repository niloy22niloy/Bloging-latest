@extends('Frontend.master')
@section('content')
<main id="main">
    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-9" data-aos="fade-up">
            <h3 class="category-title">Search Result For: {{$asd}}</h3>
@forelse ($search_post as $search)


            <div class="d-md-flex post-entry-2 half">
              <a href="single-post.html" class="me-4 thumbnail">
                <img src="{{asset('dashboard_post/'.$search->featured_image)}}" alt="" class="img-fluid">
              </a>
              <div>
                <div class="post-meta"><span class="date">{{$search->rel_to_category->category_name}}</span> <span class="mx-1">&bullet;</span> <span>{{$search->created_at->format('d-M-Y')}}</span></div>
                <h3><a href="{{route('post_even.details', $search->id)}}">{{$search->title}}</a></h3>
                {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p> --}}
                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">{{$search->rel_to_user->name}}</h3>
                  </div>
                </div>
              </div>
            </div>
            @empty
            Not Found For <span class="badge bg-primary">{{$asd}}</span>

            @endforelse

            <div class="text-start py-4">
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
