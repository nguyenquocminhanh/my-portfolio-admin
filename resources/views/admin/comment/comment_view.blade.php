@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('comment.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-list"> Back</i></a>
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <h5 class="card-title">Comment from {{ date('M d, Y, g:i A', strtotime($comment->created_at)) }}</h5>
                                <hr>
                                <ul class="list-group">
                                    <li class="list-group-item">Name: {{ $comment->owner }}</li>
                                    <li class="list-group-item">Email: {{ $comment->email }}</li>
                                    <li class="list-group-item">Phone Number: {{ $comment->phone }}</li>
                                    <li class="list-group-item">Blog: {{ $comment->blog->title }}</li>
                                    <li class="list-group-item">Content: {{ $comment->content }}</li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <br>
                        <center>
                            <a href="{{ route('comment.delete', $comment->id) }}" id="delete" class="btn btn-danger waves-effect waves-light">Delete Comment</a>
                        </center>
                        
                    </div>
                </div>      
                <!-- end row -->
            </div>
        </div>

    </div>
</div>




@endsection