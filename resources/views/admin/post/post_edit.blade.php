@extends('admin.admin_master')
@section('content')
<div class="container">
   
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Post Edit</h3>
            </div>
            <form action="{{route('edit.post',$post->id)}}" method="POST" enctype="multipart/form-data"> 
                @csrf
            <div class="card-body">
                <div class="mb-3">
                    <select name="category_id" id="" class="form-control">
                        <option  value="">---Select Category-----</option>
                        @foreach ($categories as $category)
                        <option @if ($post->category_id == $category->id)
                            selected
                            
                        @endif  value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                       

                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}">
                    
                </div>
                <div class="mb-3">
                    <label for="" class="fomr-label">Description</label>
                    <textarea name="description" id="summernote" class="form-control"  cols="30" rows="10" readonly>{!! $post->description !!}</textarea>

                </div>
                <div class="mb-3">
                       
                    <label for="" class="form-label">Select Tags:</label>
                    <div class="form-check form-check-inline px-5">
                        
                        @php
                        $after_explode = explode(',',$post->tag_id);
                        
                        @endphp
                @foreach ($tags as $tagss)
                          
                           <input class="form-check-input"
                           
                           @foreach (  $after_explode as $tag)
                           @if ($tag == $tagss->id)
                           checked
                               
                           @endif
                          @endforeach
                         name="tag_id[]" type="checkbox" id="inlineCheckbox1" value="{{$tagss->id}}" />

                    
                        
                       
                       


                        <label class="form-check-label ml-3" for="inlineCheckbox1">{{$tagss->tag_name}}</label>
                        @endforeach
                      
                        
                      </div>
                      <div class="mb-3 mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  
                    
                    
                    </label>
                  </div>
            </div>
        </form>
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
Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
)

</script>
@endif
@endsection