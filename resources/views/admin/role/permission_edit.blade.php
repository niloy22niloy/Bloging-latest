@extends('admin.admin_master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Permission Edit</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('permission.update',$permission_edit->id)}}" method="POST">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" name="permission_name" class="form-control" value="{{$permission_edit->name}}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
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
@endsection