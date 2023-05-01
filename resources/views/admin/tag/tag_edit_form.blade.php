@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Tag Edit</h3>
                </div>
                <form action="{{route('tag.update',$tags->id)}}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Tag Name</label>
                        <input type="text" name="tag_name" value={{$tags->tag_name}} class="form-control">
                        @error('tag_name')
                                        <span class="text-danger">{{$message}}</span>
                                     @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
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
  title: '{{session('success')}}',
  showConfirmButton: false,
  timer: 1500
})
</script>
@endif
@endsection