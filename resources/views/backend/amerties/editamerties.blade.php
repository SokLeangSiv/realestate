@extends('admin.admin_dashboard')

@section('admin')


<div class="col-md-8 col-xl-8 middle-wrapper">
    <div class="row">

        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Basic Form</h6>

                <form class="forms-sample" method="POST" action="{{ route('update.amarties',$amerties->id) }}"
                    enctype="multipart/form-data">

                    @csrf
                    

                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Amentie Name</label>
                        <input type="text" class="form-control" 
                            id="exampleInputUsername1" name="amarties_name" value="{{ $amerties->amarties_name }}" autocomplete="off" placeholder="name">
                        @error('amarties_name')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                   


                    <button class="btn btn-success">Submit</button>


            </div>
        </div>
    </div>
</div>


@endsection