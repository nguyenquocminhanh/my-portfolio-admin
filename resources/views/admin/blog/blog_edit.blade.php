@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
        background-color: #F0F0F0
    } 

    .bootstrap-tagsinput {
        width: 100%;
        line-height: 30px;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('blog.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-list"> Back</i></a>

                        <h4 class="card-title">Edit Blog</h4>
                        <br>
                       
                        <form id="myForm" method="POST" action="{{ route('blog.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Blog Title*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="title" value="{{ $blog->title }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-10 col-form-label">Blog Category*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <select id="category_id" name="category_id" class="form-select select2">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Author Name*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="author_name" value="{{ $blog->author_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Author Image</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="file" name="author_image" id="author_image">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                            <div class="col-10 col-lg-12">
                                                <img id="showAuthorImage" class="rounded avatar-lg" src="{{ $blog->author_image ? $blog->author_image : url('upload/no_image.jpg') }}" class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-10 col-lg-12">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Content*</label>
                                  
                                    <textarea id="elm1" name="content" class="form-control">{{ $blog->content }}</textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-10 col-lg-12">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description*</label>
                                  
                                    <textarea rows="4" name="description" class="form-control">{{ $blog->description }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Blog Tags</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="tags" value="{{ $blog->tags }}" data-role="tagsinput">
                                        @error('blog_tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Duration*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="duration" value="{{ $blog->duration }}">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Thumbnail Image</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="file" name="thumbnail_image" id="thumbnail_image">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                            <div class="col-10 col-lg-12">
                                                <img id="showThumbnailImage" class="rounded avatar-lg" src="{{ $blog->thumbnail_image ? $blog->thumbnail_image : url('upload/no_image.jpg') }}"  class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Thumbnail Caption</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="thumbnail_caption" value="{{ $blog->thumbnail_caption }}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Wallpaper Image</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="file" name="wallpaper_image" id="wallpaper_image">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                            <div class="col-10 col-lg-12">
                                                <img id="showWallpaperImage" class="rounded avatar-lg" src="{{ $blog->wallpaper_image ? $blog->wallpaper_image : url('upload/no_image.jpg') }}" class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <center>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog">
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
                title: {
                    required : true,
                }, 
                category_id: {
                    required : true,
                }, 
                author_name: {
                    required : true,
                }, 
                content: {
                    required : true,
                }, 
                duration: {
                    required: true
                }
            },
            messages :{
                title: {
                    required : 'Blog Title Required',
                },
                category_id: {
                    required : 'Blog Category Required',
                },
                author_name: {
                    required : 'Author Required',
                },
                content: {
                    required : 'Blog Content Required',
                },
                duration: {
                    required: 'Reading Duration Required'
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
        $('#author_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showAuthorImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#thumbnail_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showThumbnailImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#wallpaper_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showWallpaperImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection