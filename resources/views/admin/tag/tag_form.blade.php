@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Tag</h3>
                </div>
                <form action="{{route('tag.insert')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div id="contact" class="container mt-4">
                        
                
                      
                
                            
                                
                                    <div class="mb-3">
                                        <input class="form-control" id="name" name="tag_name" placeholder="Tag Name" type="text">
                                        @error('tag_name')
                                        <span class="text-danger">{{$message}}</span>
                                     @enderror
                                    </div>
                                    
                
                                
                                     <div class="mb-3">
                                        <button class="btn btn-primary pull-right" type="submit">Send</button>
                                    </div>
           
                                
                            
                       
                    </div>
            </form>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tag List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                          <tr>
                            <th>Serial</th>
                            <th>Tag Name</th>
                            <th>Action</th>
                          </tr>
                           @foreach ($tags as $key=>$tag)
                           <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$tag->tag_name}}</td>
                            <td>
                                <a href="{{route('tag_edit.form',$tag->id)}}" class="btn btn-primary">Edit</a>
                                <a href="#" class="btn btn-danger del" data-link="{{route('tag.delete',$tag->id)}}">Delete</a>
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