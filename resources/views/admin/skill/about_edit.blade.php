@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <h4 class="card-title">Edit About Me Information</h4>
                        <br>
                        <br>
                       
                        <form id="myForm" method="POST" action="{{ route('about.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                                <div class="form-group col-10">
                                    <input class="form-control" type="file" name="image" id="image">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-sm-10">
                                    <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                    @if($about)
                                    <div class="col-10 col-lg-12">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ $about->image ? $about->image : url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                    @else
                                    <div class="col-10 col-lg-12">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}"  class="card-img-top">
                                    </div>
                                    @endif
                                </div>
                            </div>
                   
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Main Intro</label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" type="text" rows="6" name="main_intro">{{ $about? $about->main_intro : old('main_intro') }}</textarea>
                                </div>
                            </div>

                            <br> 

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Sub Intro</label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" type="text" rows="4" name="sub_intro">{{ $about? $about->sub_intro : old('sub_intro') }}</textarea>
                                </div>
                            </div>

                            <br>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Github Link</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="github_link" value="{{ $about? $about->github_link : old('github_link') }}">
                                </div>
                            </div>

                            <br>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">LinkedIn Link</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="linkedin_link" value="{{ $about? $about->linkedin_link : old('linkedin_link') }}">
                                </div>
                            </div>

                            <br>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Resume</label>
                                <div class="form-group col-10">
                                    <input class="form-control" type="file" name="resume">
                                    @error('resume')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <center>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About Me Information">
                            </center>
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
                main_intro: {
                    required : true,
                },
                sub_intro: {
                    required : true,
                },
                github_link: {
                    required : true,
                },
                linkedin_link: {
                    required : true,
                }
            },
            messages :{
                main_intro: {
                    required : 'Main Intro Required',
                },
                sub_intro: {
                    required : 'Sub Intro Required',
                },
                github_link: {
                    required : 'Github Link Required',
                },
                linkedin_link: {
                    required : 'LinkedIn Link Required',
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