<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <form action="{{route('guest.store')}}" method="POST">
                @csrf
               <h1 class="mb-5">Register Page</h1>

               <!-- Name input -->

               <div class="form-outline mb-4">
                  <input type="text" id="form1Example13" name="name" class="form-control form-control-lg" />
                  @error('name')
                  <div class="text-danger">{{$message}}</div>
               @enderror
                  <label class="form-label"  for="form1Example13">Name</label>

                </div>


                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
                  @error('email')
                  <div class="text-danger">{{$message}}</div>
               @enderror
                  <label class="form-label"  for="form1Example13">Email address</label>

                </div>


                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
                  @error('password')
                  <div class="text-danger">{{$message}}</div>
               @enderror
                  <label class="form-label"  for="form1Example23">Password</label>
                </div>

                <div class="d-flex justify-content-around align-items-center mb-4">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                  </div>
                  <a href="{{route('guest.pass.reset.req')}}" style="text-decoration: none;">Forgot password?</a>
                  <a href="{{route('guest.login')}}" class="btn btn-danger">Sign In</a>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                </div>

                <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                  role="button">
                  <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                </a>
                <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                  role="button">
                  <i class="fab fa-twitter me-2"></i>Continue with Twitter</a>

                  <a class="btn btn-primary btn-lg btn-block mt-3"  style="background-color: #f38273" href="{{route('google.redirect')}}"
                  role="button">
                  <i class="fab fa-twitter me-2"></i>Login With Google</a>


              </form>
            </div>
          </div>
        </div>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  </body>
</html>
<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}

</style>

