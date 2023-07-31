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

                            <form class="forms-sample" method="POST" action="{{ route('store.type') }}"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Type Name</label>
                                    <input type="text" class="form-control" 
                                        id="exampleInputUsername1" name="type_name" autocomplete="off" placeholder="name"
                                        >
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Icon</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        name="type_icon" placeholder="Email">
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

    <script>
        $(document).ready(function() {
            $('#photo').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#showimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
