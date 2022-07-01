@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Home Page</h4>
                        <br>
                        <br>
                       
                        <form id="myForm" method="POST" action="{{ route('home.page.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Cover Image</label>
                                <div class="form-group col-10">
                                    <input class="form-control" type="file" name="cover_image" id="cover_image">
                                </div>
                        
                                <div class="form-group col-sm-10">
                                    <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                    @if($home)
                                    <div class="col-10 col-lg-12">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ $home->cover_image ? $home->cover_image : url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                    @else
                                    <div class="col-10 col-lg-12">
                                        <img id="showCoverImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <br>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Avatar Image</label>
                                <div class="form-group col-10">
                                    <input class="form-control" type="file" name="avatar_image" id="avatar_image">
                                </div>
                        
                                <div class="form-group col-sm-10">
                                    <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                    @if($home)
                                    <div class="col-10 col-lg-12">
                                        <img id="showAvatarImage" class="rounded avatar-lg" src="{{ $home->avatar_image ? $home->avatar_image : url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                    @else
                                    <div class="col-10 col-lg-12">
                                        <img id="showAvatarImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <center>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Home Page">
                            </center>
                            <br>
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
  
            },
            messages :{
   
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#cover_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showCoverImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#avatar_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showAvatarImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection