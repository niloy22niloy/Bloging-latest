@extends('admin.admin_master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Post List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <tr>
                            <th>Serial</th>
                            <th>Category_Name</th>
                            <th>Title</th>
                           <th>Tags</th>
                            <th>Feature Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($post as $key=>$pos)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$pos->rel_to_category->category_name}}</td>
                            <td>{{$pos->title}}</td>

                            <td>

                                @php
                                    $after_explode = explode(',',$pos->tag_id);
                                    @endphp

                                   @foreach( $after_explode as $tag)
                                       @php
                                       $add = App\Models\Tag::where('id',$tag)->get();
                                       @endphp

                                       @foreach ($add as $ad)


                                       <span class="badge rounded-pill bg-primary text-white mt-2 p-2" style="">{{$ad->tag_name}}</span>


                                       @endforeach

                                    @endforeach


                            </td>
                            <td>


                                    <img src="{{asset('Dashboard_post')}}/{{$pos->featured_image}}" style="width:50px;" alt="">



                            </td>
                            <td>
                                <a href="" class="btn btn-danger delete_post" data-id="{{$pos->id}}">Delete</a>
                                <a href="{{route('post.edit',$pos->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{route('post.details',$pos->id)}}" class="btn btn-primary">Details</a>
                            </td>

                        </tr>

                        @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Toastr::message() !!}
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
      $(document).ready(function(){
        $(document).on('click','.delete_post',function(e){
            e.preventDefault();
            let up_id = $(this).data('id');


            if(confirm('Are You Sure to Delete ??')){
                $.ajax({
            url:"{{ route('delete.post') }}",
            method:'post',
            data:{up_id:up_id, _token: '{{csrf_token()}}'},
            success:function(res){
                 if(res.status == 'success'){
                   $('.table').load(location.href+' .table');

                   toastr.options = {
                    "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
            }
            toastr.error(`Deleted Successfully!`)





                 }
            }


            });
            }



        })
      });
</script>


@endsection
<style> #toast-container > .toast-error{ background-color: green; } </style>
