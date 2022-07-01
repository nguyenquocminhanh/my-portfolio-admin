<!-- Page Content -->
@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @php
            $visitors = App\Models\Visitor::count();
        @endphp
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Visitors</p>
                                <h4 class="mb-2">{{ $visitors }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-user-3-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                            
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            @php
                $blogs = App\Models\Blog::count();
            @endphp
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Blogs</p>
                                <h4 class="mb-2">{{ $blogs }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            @php
                $messages = App\Models\Message::count();
            @endphp
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Contact Messages</p>
                                <h4 class="mb-2">{{ $messages }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="fas fa-envelope font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            @php
                $hires = App\Models\HireMessage::count();
            @endphp
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Hire Requests</p>
                                <h4 class="mb-2">{{ $hires }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-briefcase-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->       

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Unread Contact Messages</h4>
                            <a href="{{ route('read.all.contact') }}" id="read" class="text-success font-weight-bold">Mark as read all</a>
                        </div>
                        <br>
                        <div class="">
                            @php
                                $messages = App\Models\Message::latest()->where('read_at', null)->get();
                            @endphp
                            @forelse($messages as $key => $mess)
                                <div class="alert alert-warning" role="alert">
                                    <a href="{{ route('message.view', $mess->id) }}" style="color: #0a1832">
                                        <i class="fas fa-envelope"></i> &nbsp;
                                        On <b>{{ date('M d, Y', strtotime($mess->created_at)) }}</b>, you have an unread message from <b>{{ $mess->name }}</b>.
                                    </a>
                                </div>
                    
                            @empty
                                <div class="alert alert-secondary" role="alert">
                                    You have no message yet!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->


            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Unread Hire Messages</h4>
                            <a href="{{ route('read.all.hire') }}" id="read" class="text-success font-weight-bold">Mark as read all</a>
                        </div>
                        <br>
                        <div class="">
                            @php
                                $messages = App\Models\HireMessage::latest()->where('read_at', null)->get();
                            @endphp
                            @forelse($messages as $key => $mess)
                                <div class="alert alert-info" role="alert">
                                    <a href="{{ route('hire.view', $mess->id) }}" style="color: #0a1832">
                                        <i class="ri-briefcase-line"></i> &nbsp;
                                        On <b>{{ date('M d, Y', strtotime($mess->created_at)) }}</b>, you have an unread message from <b>{{ $mess->name }}</b>.
                                    </a>
                                </div>
                    
                            @empty
                                <div class="alert alert-secondary" role="alert">
                                    You have no message yet!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
    
</div>

@endsection