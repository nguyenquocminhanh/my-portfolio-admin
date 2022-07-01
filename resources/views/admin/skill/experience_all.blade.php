@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Experience All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <a href="{{ route('experience.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-plus-circle"> Add experience</i></a>

                    <br></br>

                    <h4 class="card-title">Experience Data</h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="10%">SL</th>
                                    <th width="25%">Position</th>
                                    <th width="15%">Duration</th>
                                    <th width="40%">Description</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($experiences as $key => $experience)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $experience->position }}</td>
                                    <td>{{ $experience->duration }}</td>
                                    <td>{{ Str::limit($experience->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('experience.edit', $experience->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('experience.delete', $experience->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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