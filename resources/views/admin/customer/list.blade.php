@extends('admin.layout.master')
@section('style')
<style>
    .main-wrapper .page-wrapper .page-content {
      flex-grow: 1;
      padding: 25px;
      margin-top: 60px;
      background: #fff;
    }

    form small {
      color: #666;
      font-size: 10px;
    }

    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 100%;
    }

    .select2-container--default .select2-selection--single {
      background-color: #fff;
      border: 1px solid #e9ecef;
      border-radius: 4px;
    }

    .form-control,
    .select2-container--default .select2-search--dropdown .select2-search__field,
    .typeahead.tt-hint,
    .typeahead.tt-input {
      display: block;
      width: 100%;
      height: 45px;
      padding: 0.469rem 0.8rem;
      font-size: .875rem;
      font-weight: 400;
      line-height: 1.5;
      color: #000;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #e9ecef;
      appearance: none;
      border-radius: 0.25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .pass2,
    .pass2 {
      position: relative;
    }

    .toggle-password,
    .toggle-password1 {
      position: absolute;
      right: 15px;
      top: 45px;
      font-size: 14px;
      color: #757575;
      cursor: pointer;
    }

    div#ErrMsg {
      font-size: 10px;
      font-weight: 500;
      color: red;
      margin-top: 0;
      margin-bottom: 10px;
    }

  </style>
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Customers Listing</h2>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                              <a href="{{ route('new.customer') }}" style="color: white;">  <i class="fa fa-add me-2"></i> Add New Customer</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="dataTable" class="table" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th>Sr No.</th>
                                      <th>Client ID</th>
                                      <th>Name</th>
                                      <th>Mobile</th>
                                      <th>Email Id</th>
                                      <th>DHP Status</th>
                                      <th>Subcribtion Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($customers as $customer)

                                    <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ !empty($customer->client_id) ? $customer->client_id : '-' }}</td>
                                      <td>{{ ucwords($customer->first_name) }} {{ ucwords($customer->middle_name) }} {{ ucwords($customer->last_name) }}</td>
                                      <td>{{ $customer->mobile_number }}</td>
                                      <td>{{ $customer->email_address }}</td>
                                      <td>{{ strtoupper($customer->status) }}</td>
                                      <td>{{ !empty($customer->subcribtion_status) ? $customer->subcribtion_status : '-' }}</td>
                                      <td>
                                      &nbsp;
                                        <a href="{{ route('edit.customer', $customer->uuid) }}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> &nbsp; Edit &nbsp;</a>
                                      &nbsp;
                                        <a href="#" class="btn btn-sm btn-remove" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> &nbsp; Delete</a>
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
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script>
    new DataTable('#dataTable');
</script>
@endsection
