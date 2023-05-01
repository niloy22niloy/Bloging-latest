@extends('admin.admin_master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Post Details</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="" id="" value="{{$post_details->title}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Post Description</label>
                        <textarea name="description" id="summernote" class="form-control"  cols="30" rows="10" readonly>{!! $post_details->description !!}</textarea>
                     </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Tags: </label>
                        @php
                                    $after_explode = explode(',',$post_details->tag_id);
                                 
                                    @endphp

                                   @foreach( $after_explode as $tag)
                                       @php
                                       $add = App\Models\Tag::where('id',$tag)->get();
                                       @endphp

                                       @foreach ($add as $ad) 

                                        
                                       <span class="badge rounded-pill bg-primary text-white mt-2 p-2" style="">{{$ad->tag_name}}</span>
                                      
                                       
                                       @endforeach
                                    
                                    @endforeach
                     </div>

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
@endsection