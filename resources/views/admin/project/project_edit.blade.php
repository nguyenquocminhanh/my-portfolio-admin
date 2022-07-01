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
                        <a href="{{ route('project.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right"><i class="fas fa-list"> Back</i></a>

                        <h4 class="card-title">Edit Project</h4>
                        <br>
                       
                        <form id="myForm" method="POST" action="{{ route('project.update') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="project_id" value="{{ $project->id }}">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Project Title*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="title" value="{{ $project->title }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Project Sub-title*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="sub_title" value="{{ $project->sub_title }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-10 col-form-label">Project Category*</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <select id="category_id" name="category_id" class="form-select select2">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Project Technologies</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="technologies" value="{{ $project->technologies }}" data-role="tagsinput">
                                        @error('technologies')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Project Link</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="project_link" value="{{ $project->project_link }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Github Link (Short Link)</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="github_link" value="{{ $project->github_link }}">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-10 col-lg-12">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Project Content* (Overview, h4)</label>
                                  
                                    <textarea id="elm1" name="content" class="form-control">{{ $project->content }}</textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Client</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="client" value="{{ $project->client }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Location</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="location" value="{{ $project->location }}">
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
                                                <img id="showThumbnailImage" class="rounded avatar-lg" src="{{ $project->thumbnail_image ? $project->thumbnail_image : url('upload/no_image.jpg') }}"  class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Thumbnail Caption</label>
                                    <div class="form-group col-10 col-lg-12">
                                        <input class="form-control" type="text" name="thumbnail_caption" value="{{ $project->thumbnail_caption }}">
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
                                                <img id="showWallpaperImage" class="rounded avatar-lg" src="{{ $project->wallpaper_image? $project->wallpaper_image : url('upload/no_image.jpg') }}" class="card-img-top">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Database Image</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="file" name="db_image" id="author_image">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                            <div class="col-10 col-lg-12">
                                                <img id="showAuthorImage" class="rounded avatar-lg" src="{{ $project->db_image ? $project->db_image : url('upload/no_image.jpg') }}" class="card-img-top">
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Design Image</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="file" name="design_image" id="design_image">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label"></label>
                                            <div class="col-10 col-lg-12">
                                                <img id="showDesignImage" class="rounded avatar-lg" src="{{ $project->design_image ? $project->design_image : url('upload/no_image.jpg') }}" class="card-img-top">
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Demo Video Link</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="text" name="demo_video" value="{{ $project->demo_video }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Project Date</label>
                                            <div class="form-group col-10 col-lg-12">
                                                <input class="form-control" type="month" name="date" value="{{ $project->date }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <center>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Project">
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
                sub_title: {
                    required : true,
                },
                category_id: {
                    required : true,
                }, 
                content: {
                    required : true,
                }, 
            },
            messages :{
                title: {
                    required : 'Project Title Required',
                },
                sub_title: {
                    required : 'Project Sub-title Required',
                },
                category_id: {
                    required : 'Project Category Required',
                },
                content: {
                    required : 'Project Content Required',
                },
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

        $('#design_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showDesignImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection