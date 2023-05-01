@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Category-Edit</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('category_edit.confirm',$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}">
                        </div>
                        <input type="file" name="category_image" accept="image/*" onchange="loadFile(event)">
                    <div>
                        @if ($category->category_image)
                        <div class="mt-2">
                            <img src="{{asset('category_images')}}/{{$category->category_image}}" id="output" style="width:150px;"/> 
                        </div>
                        @else
                        <img src="" name="category_image" id="output" style="width:150px;"/>                 
                        @endif
                    
                    <div class="mb-3">
                        <button class="btn btn-primary">Insert</button>
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
@endsection