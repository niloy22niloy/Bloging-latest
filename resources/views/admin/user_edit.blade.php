@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit User</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                 
                    <input type="file" name="image" accept="image/*" onchange="loadFile(event)">
                    <div>
                        @if ($user->image)
                        <img class="img-fluid mt-3" src="{{asset('images')}}/{{$user->image}}" id="output" style="width:150px;"/>
                            @else
                            <img class="img-fluid mt-3" src="{{ Avatar::create($user->name)->toBase64() }}" id="output" style="width:70px;" />
                        @endif
                    
                 </div>
           
                
                    <div class="mb-3">
                        <label for="" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" value="">
                    </div>
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                       <p class="text-danger">{{$error}}</p>
                    @endforeach
                @endif
                    <div class="mb-3 mx-auto">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    
                </form>    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
@if(session('success'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('success')}}',
  showConfirmButton: false,
  timer: 1500
})
</script>
@endif
@endsection