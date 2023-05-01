@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Permission</h3>
                    @foreach ($permissions as $permission)
                        <a href="{{route('permission.edit',$permission->id)}}"><span class="badge badge-primary">{{$permission->name}}</span></a>
                       
                           <a href="#" class="del" data-link={{route('permission.delete',$permission->id)}}><span aria-hidden="true">&times;</span></a> 
                        
                        
                    @endforeach
                  
                </div>
                <div class="card-body">
                    <form action="{{route('permission.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Permission Name</label>
                             <input type="text" name="permission_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add Permission</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Role List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                      <tr>
                        <th>Serial</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($roles as $key=>$role )
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <?php
                             $asd=$role->getAllPermissions();
                            //  $array = (array) $asd;
                            //  $as = implode(",",$array);
                            //  echo gettype($as);
                            // ?>
                            @foreach ($asd as $permission )
                            <span class="badge badge-success">{{$permission->name}}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href=" {{route('role_with_permission.edit',['id'=>$role->id,'name'=>$role->name])}}" class="btn btn-success">Edit</a>
                           
                        </td>
                      </tr> 
                      @endforeach
                      

                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-5">
                <div class="card-header">
                    <h3>Add Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('role.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Role Name</label>
                             <input type="text" name="role_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Permission Name</label>
                            @foreach ($permissions as $permission)
                            <div class="form-check">

                                <input class="form-check-input" name="permission[]" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  {{$permission->name}}
                                </label>
                                
                              </div>
                            @endforeach
                            
                              
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add Role</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Show Assign Roles</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Serial</th>
                            <th>User's Name</th>
                            <th>Role</th>
                            <th>Permission's Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as  $key=>$user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $roleee)
                                    
                                    <span class="badge badge-success">{{$roleee}}</span>
                                    @empty
                                    <span class="badge badge-danger">Not Assign Yet</span>
                                @endforelse
                            </td>
                            <div class="d-flex" style="">
                            <td>
                                
                                @foreach ($user->getAllPermissions() as $permissions )
                                
                                <span class="badge badge-primary">{{$permissions->name}}</span>
                                    
                                @endforeach
                           
                            </td>
                        </div>
                            <td>
                                <div class="d-flex align-items-center">
                                <a href="{{route('edit_user.role.permission',$user->id)}}" class="btn btn-primary  mx-2">Edit</a>
                                <a href="{{route('remove.role',$user->id)}}" class="btn btn-danger">Remove</a>
                            </div>
                            </td>
                        </tr>
                            
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Assign Role To Users</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('assign.role')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="user_id" id="" class="form-control js-example-basic-single">
                                <option value="" name="">----Select Users----</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="role_id" id="" class="form-control js-example-basic-single">
                                <option value="" name="">----Select Role---</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
  title:  '{{session('success')}}',
  showConfirmButton: false,
  timer: 1500
})

</script>
@endif
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@endsection