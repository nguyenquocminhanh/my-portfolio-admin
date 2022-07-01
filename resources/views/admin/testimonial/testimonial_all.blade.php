@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Testimonial All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <a href="{{ route('testimonial.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-plus-circle"> Add Testimonial</i></a>

                    <br></br>

                    <h4 class="card-title">Testimonial Data</h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="10%">SL</th>
                                    <th width="30%">Name</th>
                                    <th>Profile Image</th>
                                    <th width="25%">Company</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td><img src="{{ $testimonial->profile_image ? $testimonial->profile_image :  url('upload/no_image.jpg') }}" style="width: 60px; height: 50px;"/></td>
                                    <td>{{ $testimonial->position }}</td>
                                    <td>
                                        <a href="{{ route('testimonial.edit', $testimonial->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('testimonial.delete', $testimonial->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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