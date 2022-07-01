@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Hire Message All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <br></br>

                    <h4 class="card-title">Hire Message Data</h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Date</th>
                                    <th width="10%">Sender</th>
                                    <th width="15%">Email</th>
                                    <th width="50%">Message</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($messages as $key => $mess)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('M d, Y', strtotime($mess->created_at)) }}</td>
                                    <td>{{ $mess->name }}</td>
                                    <td>{{ $mess->email }}</td>
                                    <td>{{ Str::limit($mess->message, 75) }}</td>
                                    <td>
                                        <a href="{{ route('hire.view', $mess->id) }}" class="btn btn-warning sm" title="View Data"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('hire.delete', $mess->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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