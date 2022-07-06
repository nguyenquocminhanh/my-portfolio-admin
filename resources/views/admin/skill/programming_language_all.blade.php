@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Programming Language All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <a href="{{ route('programming_language.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-plus-circle"> Add Programming Language</i></a>

                    <br></br>

                    <h4 class="card-title">Programming Language Data</h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="10%">SL</th>
                                    <th width="40%">Name</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($languages as $key => $language)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $language->name }}</td>
                                    <td>
                                        <a href="{{ route('programming_language.edit', $language->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('programming_language.delete', $language->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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