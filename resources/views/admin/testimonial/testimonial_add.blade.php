@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('testimonial.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-list"> Back</i></a>

                        <h4 class="card-title">Add Testimonial</h4>
                        <br>
                        <br>
                       
                        <form id="myForm" method="POST" action="{{ route('testimonial.store') }}" enctype="multipart/form-data">
                            @csrf
                   
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                                </div>
                            </div>

                            <br> 

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Company</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="position" value="{{old('position')}}">
                                </div>
                            </div>

                            <br>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Content</label>
                                <div class="form-group col-sm-10">
                                    <textarea name="content" rows="6" class="form-control">{{ old('content') }}</textarea>
                                </div>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror          
                            </div>

                            <br>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="form-group col-10">
                                    <input class="form-control" type="file" name="profile_image" id="image">
                                    @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>

                                <div class="form-group col-sm-10">
                                    <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                    <div class="col-10 col-lg-12">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                </div>
                            </div>

                            <center>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Testimonial">
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
                name: {
                    required : true,
                },
                position: {
                    required : true,
                },
                content: {
                    required : true,
                },
                profile_image: {
                    required: true
                }
            },
            messages :{
                name: {
                    required : 'Name Required',
                },
                position: {
                    required : 'Company Required',
                },
                content: {
                    required : 'Testimonial Content Required',
                },
                profile_image: {
                    required: 'Profile Image Required'
                }
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
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection