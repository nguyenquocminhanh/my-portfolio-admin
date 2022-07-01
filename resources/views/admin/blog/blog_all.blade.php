@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Blog All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <a href="{{ route('blog.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-plus-circle"> Add Blog</i></a>

                    <br></br>

                    <h4 class="card-title">Blog Data</h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Thumbnail</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($blogs as $key => $blog)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->author_name }}</td>
                                    <td>{{ date('M d, Y', strtotime($blog->created_at)) }}</td>
                                    <td>{{ $blog->category->name }}</td>
                                    <td><img src="{{ $blog->thumbnail_image != null ? asset($blog->thumbnail_image) : url('upload/no_image.jpg') }}" style="width: 60px; height: 50px;"></td>
                                    <td>
                                        <a href="{{ route('blog.view', $blog->id) }}" class="btn btn-warning sm" title="View Data"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('blog.delete', $blog->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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