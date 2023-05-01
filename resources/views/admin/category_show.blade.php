@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    Category List
                </div>
                <div class="card-body text-center">
                    <table class="table table-striped">
                        <tr>
                            <th>Serial</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $key=>$category)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>
                                @if ($category->category_image)
                                <img src="{{asset('category_images')}}/{{$category->category_image}}" style="width:50px;" alt="">
                                  @else
                                  <span class="badge badge-primary">Image Has Not Uploaded For This <span class="badge badge-pill badge-danger">{{$category->category_name}}</span> category</span> 
                                @endif
                            </td>
                            <td>
                              
                                    
                                
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger del" data-link="{{route('category.delete',$category->id)}}">Delete</a>
                                
                            </td>
                        </tr>
                            
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

  
</div>
<script>
    $(document).ready(function () {
        $(".del").click(function () {
            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   var link = $(this).attr('data-link');
   window.location.href = link;
  }
})
            
        })
    });
   
    
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