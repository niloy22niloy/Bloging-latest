@extends('admin.admin_master')
@section('content')


<div class="container">
    <div class="row">
        <div class="mb-3">
        <h3>Welcome,{{Auth::user()->name}}</h3>
       
    </div>
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    
                    <form action="{{route('delete.check')}}" method="POST">
                        @csrf
                    <h3>User List</h3>
                    <button class="btn btn-danger ">Delete All</button>
                </div>
                
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <tr>
                            <th><input type="checkbox" id="checkAll" name="check"> Check All </th>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $key=>$user)
                      <tr>
                        <td><input type="checkbox"  name="check[]" value="{{$user->id}}"></td>
                        <td>{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->image)
                            <img src="{{asset('images')}}/{{$user->image}}" style="width:60px;" alt="">
                            
                            @else
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" style="width:40px;" />
                            @endif
                        </td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-success">Edit</a>
                           
                            <a href="#" class="btn btn-primary del" data-link={{route('user.delete',$user->id)}}>Delete</a>
                        </td>
                      </tr>
                     
                        @endforeach
                        
                    </table>
                    {{$users->links()}}
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="contaienr">
    <form action="{{route('search')}}" method="POST">
        @csrf
        <input type="date" id="birthdaytime" name="name">
        <input type="submit" >

    </form>
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

@if(session('Delete'))
<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session('Delete')}}',
  showConfirmButton: false,
  timer: 1500
})
</script>
@endif

@if(session('Select'))
<script>
   Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '{{session('Select')}}',
   
  })

</script>
@endif


<script>
    $('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });
</script>
@endsection