@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">

    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        
        
    @endif
    

    
    <h6 class="card-title">Data Table</h6>
    <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">

        <a name="" id="" class="btn btn-success" href="{{ route('add.property') }}" role="button">Add Property</a>
      
       
        <thead>
          <tr>
            <th>Sl</th>
            <th>Image</th>
            <th>Name</th>
            <th>P Type</th>
            <th>Status Type</th>
            <th>city</th>
            
            <th>
                Action
            </th>
            
          </tr>
        </thead>
        <tbody>

            @foreach ($property as $propertys => $item)
                
            
          <tr>
            <td>{{ $propertys+1 }}</td>
            <td><img src="{{ asset($item->property_thumbnail) }}" alt="" width="70" height="40"></td>
            <td>{{ $item->property_name }}</td>
            <td>{{ $item->ptype_id }}</td>
            <td>{{ $item->property_status }}</td>
            <td>{{ $item->city }}</td>
            <td>
                @if ($itme->status == 1)
                <span class="badge rounded-pill bg-success">Active</span>
                @else

                <span class="badge rounded-pill bg-danger">Inactive</span>
                @endif

            </td>
            
            <td>
                <a class="btn btn-warning btn-sm me-1" href="{{ route('edit.amarties',$item->id) }}" role="button">Edit </a>
                <a class="btn btn-danger btn-sm " href="{{ route('delete.amarties',$item->id) }}" id="delete" role="button"> Delete</a>
            </td>
            
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
        </div>
    </div>

</div>

@endsection