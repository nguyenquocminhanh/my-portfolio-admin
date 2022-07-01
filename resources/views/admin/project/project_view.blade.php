@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <a href="{{ route('project.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right; max-width: 100px"><i class="fas fa-list"> Back</i></a>
        <div class="row">
            <h4 class="card-title">Project Preview</h4>
            <br><br>
            <div class="col-lg-8">
                <article class="article">
                    <h2 class="text-center">{{ $project->title }}</h2>
                    <figure class='mt-2'>
                        <img alt="Project Article Figure" src="{{ $project->wallpaper_image }}" class="img-fluid rounded-3x"/>
                    </figure>
                    <h4 class="text-center">Last updated: {{ date('M d, Y', strtotime($project->updated_at)) }}</h4>
                    <br>
        
                    <figure class='mt-2'>
                        <img alt="Project Article Figure" src="{{ $project->thumbnail_image }}" class="img-fluid rounded-3x"/>
                        <br><br>
                        <figcaption class="text-center">Here is a caption for this picture</figcaption>
                    </figure>
                    <ul class="blog__post__meta d-flex justify-content-between p-0" style="list-style-type: none">
                        <li><i class="fa fa-calendar-alt"></i> Created at: {{ date('M d, Y', strtotime($project->updated_at)) }}</li>
                
                        <li class="post-share"><span href="#"><i class="fa fa-share"></i> ({{ $project->share_count }})</span></li>
                    </ul>
                {!! $project->content !!}
                </article>

                <hr class="my-7"/>

                <div class="blog__details__bottom">
                    <ul class="blog__details__tag d-flex p-0" style="list-style-type: none">
                        <li class="title">Tag:</li> &nbsp;
                        @foreach(explode(',',$project->technologies) as $technology)
                        <li class="tags-list">
                            <a href="#">{{ $technology }}</a>
                        </li> &nbsp;
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection