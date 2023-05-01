@extends('Frontend.master')

@section('content')
<main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">

                @foreach ($slider_post as $slider)
                <div class="swiper-slide">
                  <a href="{{route('post_even.details', $slider->id)}}" class="img-bg d-flex align-items-end" style="background-image: url('{{asset('dashboard_post/'.$slider->featured_image)}}');">
                    <div class="img-bg-inner">
                      <h2>{{$slider->title}}</h2>
                      <p>ক্যাটাগরি : {{$slider->rel_to_category->category_name}}</p>
                      <p>লেখক : {{$slider->rel_to_user->name}}</p>
                      <p>প্রকাশিত : {{$slider->created_at->format('M-d-Y')}}</p>
                    </div>
                  </a>
                </div>
                @endforeach



              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="section-header d-flex justify-content-between align-items-center mb-5">
          <h2>Posts</h2>
          <div><a href="category.html" class="more"></a></div>
        </div>
        <div class="row g-5">
            @foreach ($posts_even as $post_big)
          <div class="col-lg-4">
            {{-- $posts_big --}}
<div class="card">




            <div class="post-entry-1 lg">
              <a href="single-post.html"><img src="{{asset('dashboard_post/'.$post_big->featured_image)}}" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">{{$post_big->rel_to_category->category_name}}</span> <span class="mx-1">&bullet;</span> <span>{{$post_big->created_at->format('d-M-Y')}}</span></div>
              <h4><a href="{{route('post_even.details',$post_big->id)}}">{{$post_big->title}}</a></h4>

              <div class="d-flex align-items-center author">
                <div class="photo"><img src="{{asset('frontend_asset/assets/img/person-1.jpg')}}" alt="" class="img-fluid"></div>
                <div class="name">
                  <span class="author">Writer : {{$post_big->rel_to_user->name}}</span>
                </div>
              </div>
            </div>
        </div>




          </div>
          @endforeach
          {{-- {!! $posts_even->links('vendor.pagination.custom') !!} --}}
          {{ $posts_even->links('vendor.pagination.custom')}}





            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section> <!-- End Post Grid Section -->

    <!-- ======= Culture Category Section ======= -->
   <!-- End Business Category Section -->



  </main>
@endsection
