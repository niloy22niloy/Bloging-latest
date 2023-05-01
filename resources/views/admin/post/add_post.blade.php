@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Post</h3>
            </div>
            <div class="card-body">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" id="" class="form-control">
                            <option value="">---Select Category-----</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach


                        </select>
                    </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Post Title</label>
                        <input type="text" name="title" class="form-control">
                     </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Post Description</label>
                        <textarea name="description" id="summernote" class="form-control"  cols="30" rows="10"></textarea>
                     </div>
                     <div class="mb-3">

                        <label for="" class="form-label">Select Tags:</label>
                        <div class="form-check py-4">

                            @foreach ($tags as $tag)
                            <input style="margin-left:2px;" class="form-check-input" name="tag_id[]" type="checkbox" id="inlineCheckbox1" value="{{$tag->id}}" />
                            <label style="margin-right:5px;" class="form-check-label ml-3" for="inlineCheckbox1">{{$tag->tag_name}}</label>
                            @endforeach


                          </div>



                        </label>
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Featured Images</label>
                        <input type="file" name="feature_image" >
                      </div>
                      <div class="mb-3">
                        <button class="btn btn-primary">Submit</button>
                      </div>

                    </div>
                </form>
            </div>
        </div>
       </div>
    </div>
</div>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
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
