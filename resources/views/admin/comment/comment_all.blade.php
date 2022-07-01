@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Comment All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <br></br>

                    <h4 class="card-title">Comment Data</h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Date</th>
                                    <th width="10%">Commentator</th>
                                    <th width="10%">Blog</th>
                                    <th width="50%">Content</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($comments as $key => $comment)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('M d, Y', strtotime($comment->created_at)) }}</td>
                                    <td>{{ $comment->owner }}</td>
                                    <td>{{ Str::limit($comment->blog->title, 15) }}</td>
                                    <td>{{ Str::limit($comment->content, 75) }}</td>
                                    <td>
                                        <a href="{{ route('comment.view', $comment->id) }}" class="btn btn-warning sm" title="View Data"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('comment.delete', $comment->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
                
    </div> <!-- container-fluid -->
</div>

@endsection