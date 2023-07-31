@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    33<div class="page-content">


        <div class="row profile-body">
            <!-- left wrapper start -->
          
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Basic Form</h6>

                            <form id="myForm" class="forms-sample" method="POST" action="{{ route('store.amarties') }}"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="form-group mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Amarties Name</label>
                                    <input type="text" class="form-control" 
                                        id="exampleInputUsername1" name="amarties_name" autocomplete="off" placeholder="Amerties Name"
                                        >

                                </div>
                                


                                <button class="btn btn-success">Submit</button>






                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->
            <div class="d-none d-xl-block col-xl-3">

            </div>
            <!-- right wrapper end -->
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    amarties_name: {
                        required : true,
                    }, 
                    
                },
                messages :{
                    amarties_name: {
                        required : 'Please Enter ama',
                    }, 
                     
    
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
