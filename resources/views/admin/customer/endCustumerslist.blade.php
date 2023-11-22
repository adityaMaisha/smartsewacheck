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
                        <h2 class="main-content-title tx-24 mg-b-5">End Customers Service Listing</h2>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                              <a href="{{ route('end.custumers') }}" style="color: white;">  <i class="fa fa-add me-2"></i> Add New</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-hover" style="width:100%" id="example3">
                                  <thead>
                                    <tr>
                                      <th>Sr No.</th>
                                      <th>Service Name</th>
                                      <th>Category</th>
                                      <th>Mode Of Del.</th>
                                      <th>Price</th>
                                      <th>Disease</th>
                                      <th>Organs</th>
                                      <th>Consumable Time</th>
                                      <th>Description</th>
                                      <th>Pin Code</th>
                                      <th>Gender</th>
                                      <th>Age Group</th>
                                      <th>Start Time</th>
                                      <th>End Time</th>
                                      <th>Status</th>
                                      <th>Created at</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(!empty($end_cust_serv))
                                    @foreach ($end_cust_serv as $key => $val )

                                    <tr>
                                      <td>{{ $key+1 }}</td>
                                      <td>{{ $val->service_name }}</td>
                                      <td>{{ $val->service_category }}</td>
                                      <td>{{ $val->del_mode }}</td>
                                      <td>{{ $val->service_price }}</td>
                                      <td>{{ $val->disease }}</td>
                                      <td>{{ $val->attach_organ }}</td>
                                      <td>{{ $val->time_consume }}</td>
                                      <td>{{ $val->ser_details }}</td>
                                      <td>{{ $val->service_pincode }}</td>
                                      <td>{{ $val->customer_gender }}</td>
                                      <td>{{ $val->ageGroup }}</td>
                                      <td>{{ $val->startDateTime }}</td>
                                      <td>{{ $val->endDateTime }}</td>
                                      <td>{{ $val->flag }}</td>
                                      <td>{{ $val->created_at }}</td>
                                      <td>
                                        <a href="{{ route('edit.endCustSer',$val->_id) }}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> &nbsp; Edit &nbsp;</a>
                                        <a href="/delete-list-end-custumers/{{encrypt($val->_id)}}" class="btn btn-sm btn-remove" ><i class="fas fa-trash"></i> &nbsp; Delete</a>
                                        <a href="/smartsewa-endcustomer-status/{{encrypt($val->_id)}}" class="btn btn-sm btn-remove" >
                                            <i class="fas fa-trash"></i> &nbsp;
                                            {{$val->flag=="1"?"Active":"Deactive"}}
                                        </a>
                                    </td>
                                    </tr>
                                    @endforeach
                                    @endif
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
    // new DataTable('#dataTable');
</script>
@endsection
