@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Edit</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('permission.update')}}" method="POST">
                        @csrf 
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="hidden" name="user_id" value="{{$users->id}}">
                        <input type="text" readonly value="{{$users->name}}" class="form-control">
                        
                        
                        {{-- <?php
                        // $object=$users->getRoleNames();
                        // $data = $object->toArray();
                    //    ?>
                        @foreach ( $data as $memu )
                        <span class="badge badge-success">{{$memu}}</span>
                        @endforeach --}}

                        @foreach ($users->getRoleNames() as $role)
                        <span class="badge badge-success">{{$role}}</span>
                        @endforeach
                        
                        
                       
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                            @foreach ($permissions as $permission)
                            <div class="form-check">

                                <input {{($users->hasPermissionTo($permission->name))?'checked':''}} class="form-check-input" name="permission[]" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  {{$permission->name}}
                                </label>
                                
                              </div>
                            @endforeach
                            @foreach ($users->getAllPermissions() as $permissions )
                                
                            <span class="badge badge-primary">{{$permissions->name}}</span>
                                
                            @endforeach
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
                </div>
                
            </div>

        </div>
        
    </div>
    
</div>
@endsection