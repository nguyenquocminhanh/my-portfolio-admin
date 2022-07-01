@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <a href="{{ route('blog.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right; max-width: 100px"><i class="fas fa-list"> Back</i></a>
        <div class="row">
            <h4 class="card-title">Blog Preview</h4>
            <br><br>
            <div class="col-lg-8">
                <article class="article">
                    <h2 class="text-center">{{ $blog->title }}</h2>
                    <figure class='mt-2'>
                        <img alt="Blog Article Figure" src="{{ $blog->wallpaper_image }}" class="img-fluid rounded-3x"/>
                    </figure>
                    <h4 class="text-center">Last updated: {{ date('M d, Y', strtotime($blog->updated_at)) }} - {{ $blog->duration }} read</h4>
                    <br>
                    <img class="rounded-circle header-profile-user" src="{{ $blog->author_image ? $blog->author_image :'https://minh-portfolio.s3.us-east-2.amazonaws.com/no_image.jpg' }}" alt="Header Avatar">
                    &nbsp;
                    <span>{{ $blog->author_name }}</span>
                    <figure class='mt-2'>
                        <img alt="Blog Article Figure" src="{{ $blog->thumbnail_image }}" class="img-fluid rounded-3x"/>
                        <br><br>
                        <figcaption class="text-center">Here is a caption for this picture</figcaption>
                    </figure>
                    <ul class="blog__post__meta d-flex justify-content-between p-0" style="list-style-type: none">
                        <li><i class="fa fa-calendar-alt"></i> Created at: {{ date('M d, Y', strtotime($blog->updated_at)) }}</li>
                        <li><i class="fa fa-comments"></i> <span href="#">Comment (08)</span></li>
                        <li class="post-share"><span href="#"><i class="fa fa-share"></i> ({{ $blog->share_count }})</span></li>
                    </ul>
                {!! $blog->content !!}
                </article>

                <hr class="my-7"/>

                <div class="blog__details__bottom">
                    <ul class="blog__details__tag d-flex p-0" style="list-style-type: none">
                        <li class="title">Tag:</li> &nbsp;
                        @foreach(explode(',',$blog->tags) as $tag)
                        <li class="tags-list">
                            <a href="#">{{ $tag }}</a>
                        </li> &nbsp;
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection