@extends('admin.layout.master')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">

@endsection
@section('content')
<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Labs & Diagnostics</h2>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                            <i class="fa fa-filter me-2"></i> Filter
                        </button>
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                          <a href="{{ route('vendor.new.path.lab') }}" style="color: white;">  <i class="fa fa-add me-2"></i> Add New Lab</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Vendor ID</th>
                                            <th>Vendor Name</th>
                                            <th>Contact</th>
                                            <th>State/City</th>
                                            <th>Email Id</th>
                                            <th>Contact Person Name</th>
                                            <th>Mobile Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $PathLab)
                                            <tr>
                                                <td>{{ $loop->iteration  }}</td>
                                                <td>{{ $PathLab->vendor_id }}</td>
                                                <td>{{ $PathLab->vendor_name }}</td>
                                                <td>{{ $PathLab->mobile_number }}</td>
                                                <td>{{ $PathLab->getState->name ?? '' }} / {{ $PathLab->getCity->name ?? '' }}</td>
                                                <td>{{ $PathLab->email_id }}</td>
                                                <td>{{ $PathLab->contact_person_name }}</td>
                                                <td>{{ $PathLab->contact_per_mobile }}</td>
                                                <td>{{ strtoupper($PathLab->vendor_status) }}</td>
                                                <td>
                                                    <a href="{{route('vendor.show.path.lab',encrypt($PathLab->_id))}}" class="viewPage btn btn-sm btn-edit" data-get=""><i class="fas fa-eye"></i> &nbsp; View &nbsp;</a>
                                                    <a href="{{route('vendor.edit.path.lab',encrypt($PathLab->_id))}}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> &nbsp; Edit &nbsp;</a>
                                                    <a href="{{route('labs.delete',encrypt($PathLab->_id))}}" class="btn btn-sm btn-remove" ><i class="fas fa-trash"></i> &nbsp; Delete</a>
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
    </div>
</div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script>

    // new DataTable('#dataTable');
</script>
@endsection
