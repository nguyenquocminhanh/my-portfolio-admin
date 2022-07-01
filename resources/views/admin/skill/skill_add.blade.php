@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('skill.all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;"><i class="fas fa-list"> Back</i></a>

                        <h4 class="card-title">Add Skill</h4>
                        <br>
                        <br>
                       
                        <form id="myForm" method="POST" action="{{ route('skill.store') }}">
                            @csrf
                   
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Skill Name</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                                </div>
                            </div>

                            <br> 

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Percentage(%)</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="percentage" value="{{old('percentage')}}">
                                </div>
                            </div>

                            <br>

                            <center>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add New Skill">
                            </center>
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                percentage: {
                    required : true,
                }
            },
            messages :{
                name: {
                    required : 'Skill Name Required',
                },
                percentage: {
                    required : 'Skill Percentage Required',
                }
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

@endsection