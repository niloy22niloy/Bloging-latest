
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ZenBlog Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('frontend_asset/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('frontend_asset/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('frontend_asset/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend_asset/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('frontend_asset/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend_asset/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend_asset/assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="{{asset('frontend_asset/assets/css/variables.css')}}" rel="stylesheet">
  <link href="{{asset('frontend_asset/assets/css/main.css')}}" rel="stylesheet">

  <script src=
  "https://code.jquery.com/jquery-3.6.0.min.js"
  integrity=
"sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <div>
      <a href="{{route('homepage')}}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>ব্লগ ওয়েবসাইট</h1>

      </a>


    </div>



      <nav id="navbar" class="navbar">
        <ul>
            @foreach ($categories as $category)

                <li><a href="{{route('categorywise_blog.show',[$category->id,$category->category_name])}}">{{$category->category_name}} ({{App\Models\Post::where('category_id',$category->id)->count()}})</a></li>
            @endforeach
          {{-- <li><a href="index.html">Blog</a></li>
          <li><a href="single-post.html">Single Post</a></li>
          <li class="dropdown"><a href="category.html"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>

              @foreach ($categories as $category)
              <li><a href="#">{{$category->category_name}}</a></li>
              @endforeach


              </li>

            </ul>
          </li>

          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li> --}}
        </ul>
      </nav><!-- .navbar -->


      <div class="position-relative">


        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <div class="search-form">
     <span class="icon bi-search search-ss"></span>
            <input type="text" placeholder="Search"  class="form-control search-input">

            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </div>

        </div><!-- End Search Form -->

      </div>
      @auth('guestlogin')

      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          {{Auth::guard('guestlogin')->user()->name}}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="{{route('logout.guest')}}">Log Out</a></li>
       </ul>
      </div>
     @else
     <a href="{{route('guest.register')}}" class="btn btn-primary">Sign up</a>
     @endauth

    </div>


  </header><!-- End Header -->


  @yield('content')
  <!-- End #main -->

  <!-- ======= Footer ======= -->

  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About ZenBlo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="{{route('author.list')}}" class="footer-link-more">Author List</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">ট্যাগস</h3>
            <ul class="footer-links list-unstyled">
              @foreach ($tags as $tag)
              <li><a href="index.html"><i class="bi bi-chevron-right"></i> {{$tag->tag_name}}</a></li>
              @endforeach


            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">ক্যাটাগরি</h3>
            <ul class="footer-links list-unstyled">
              @foreach ($categories as $category)
              <li><a href="category.html"><i class="bi bi-chevron-right"></i>{{$category->category_name}}</a></li>
              @endforeach



            </ul>
          </div>

          <div class="col-lg-4">
            <h3 class="footer-heading">Trending Posts</h3>

            <ul class="footer-links footer-blog-entry list-unstyled">
              {{-- <li>
                <a href="single-post.html" class="d-flex align-items-center">
                  <img src="assets/img/post-sq-1.jpg" alt="" class="img-fluid me-3">
                  <div>
                    <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <span>5 Great Startup Tips for Female Founders</span>
                  </div>
                </a>
              </li> --}}
              @foreach ($popular_posts as $key=>$popular)
              <li>
                <a href="{{route('post_even.details',$popular->post_id)}}">

                  <div>
                    <div class="post-meta d-block"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <span>{{$popular->rel_to_post->title}}</span>
                  </div>


                  <span class="author"><?php
                  $guest = App\Models\User::find($popular->rel_to_post->author_id);
                  echo $guest->name;
                  ?></span>
                </a>
              </li>
              @endforeach







            </ul>

          </div>
        </div>
      </div>
    </div>
<button class="btn btn-success bbb" id="sss">asd</button>
    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>
    <button id="btn">Click me!</button>
  </footer>


  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('frontend_asset/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('frontend_asset/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('frontend_asset/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('frontend_asset/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('frontend_asset/assets/vendor/php-email-form/validate.js')}}"></script>


  <!-- Template Main JS File -->
  <script src="{{asset('frontend_asset/assets/js/main.js')}}"></script>


  <script>
    $(document).ready(function () {
        $(".search-ss").click(function () {
            // var link = " {{route('search')}} ";
            // window.location.href = link;
            var search_input = $('.search-input').val();

            var link = "{{route('search')}}" + "?q="+search_input;
            window.location.href = link;
        });
    });
</script>

</body>


</html>
