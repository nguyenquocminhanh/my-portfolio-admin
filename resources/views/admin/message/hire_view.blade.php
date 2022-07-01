@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('hire.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-list"> Back</i></a>
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <h5 class="card-title">Message from {{ date('M d, Y, g:i A', strtotime($message->created_at)) }}</h5>
                                <hr>
                                <ul class="list-group">
                                    <li class="list-group-item">Name: {{ $message->name }}</li>
                                    <li class="list-group-item">Email: {{ $message->email }}</li>
                                    <li class="list-group-item">Phone Number: {{ $message->phone_number }}</li>
                                    <li class="list-group-item">Message: {{ $message->message }}</li>
                                    
                                </ul>
                            </div>
                        </div>
                        <br>
                        <br>
                        <center>
                            <a href="{{ route('hire.delete', $message->id) }}" id="delete" class="btn btn-danger waves-effect waves-light">Delete Message</a>
                        </center>
                        
                    </div>
                </div>      
                <!-- end row -->
            </div>
        </div>

    </div>
</div>




@endsection