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
                        <h2 class="main-content-title tx-24 mg-b-5">Business Client Service Listing</h2>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                              <a href="{{ route('business.clients') }}" style="color: white;">  <i class="fa fa-add me-2"></i> Add New</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-hover" style="width:100%" id="example2">
                                  <thead>
                                    <tr>
                                      <th>Sr No.</th>
                                      <th>Service Name</th>
                                      <th>Category</th>
                                      <th>Cost</th>
                                      <th>Consumable Time</th>
                                      <th>Pin Code</th>
                                      <th>Act. Start Time</th>
                                      <th>Act. End Time</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($businessClients as $businessClient)
                                        <tr>
                                        <td>1</td>
                                        <td>{{$businessClient->service_name}}</td>
                                        <td>{{$businessClient->service_category}}</td>
                                        <td>{{$businessClient->per_cust_cost}}</td>
                                        <td>{{$businessClient->time_consume_customer}}</td>
                                        <td>{{$businessClient->ser_pin_code}}</td>
                                        <td>{{$businessClient->startDateTime}}</td>
                                        <td>{{$businessClient->endDateTime}}</td>
                                        <td><div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple  dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 18px;"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="edit-business-clients/{{encrypt($businessClient->_id)}}">Edit</a>
                                                <a class="dropdown-item" href="/delete-business-clients/{{encrypt($businessClient->_id)}}">Delete</a>
                                                <a class="dropdown-item" href="#" data-bs-target="#modal-datepicker" data-bs-toggle="modal" >Take Service</a>
                                            </div>
                                        </div></td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                                </table>

                              </div>
                        </div>
                    </div>
                </div>
                {{-- model --}}

                <div class="modal" id="modal-datepicker">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-content-demo">
                      <div class="modal-header">
                        <h6 class="modal-title">Take Smart Sewa Service</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      @if($wallet_sum > 900)
                      <div class="alert alert-info" role="alert" style="text-align: center;">
                        <a href="javascript:void(0);" class="alert-link">Awesome 😊 ! Your wallet amount is ₹ {{ $wallet_sum }}/- Sufficiant for this service</a>
                      </div>
                      @else
                      <div class="alert alert-danger" role="alert" style="text-align: center;">
                        <a href="javascript:void(0);" class="alert-link">Oops ☹️ ! Your wallet amount is low ₹ {{ $wallet_sum }}/- for this service</a>
                      </div>
                      @endif
                      <div class="modal-body">
                        <form method="post" id="purchase_service" enctype="multipart/form-data">
                        <div class="row">
                          @if($wallet_sum > 900)
                          <div class="col-md-6">
                            <p class="mg-b-10">Proceed With Wallet? <b class="text-danger">*</b></p>
                            <select class="form-control" name="is_wallet_pay" id="is_wallet_pay" onchange="is_wallet_payment(this.value)">
                              <option value="" selected> Select</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                            </select>
                        </div>
                        @endif
                          <div class="col-md-6">
                              <p class="mg-b-10">Number Of Customer <b class="text-danger">*</b></p>
                              <input class="form-control" type="number" name="number_of_customer" id="number_of_customer" placeholder="Number of customer" required>
                          </div>
                          <div class="col-md-6 mg-t-10 mg-lg-t-0 mt-2">
                            <p class="mg-b-10">Cost Per Customer<b class="text-danger">*</b></p>
                            <input class="form-control" type="number" name="cost_per_customer" id="cost_per_customer" placeholder="Cost per customer" required>
                        </div>
                          <div class="col-md-6 mg-t-10 mg-lg-t-0 mt-2">
                            <p class="mg-b-10">Total Cost<b class="text-danger">*</b></p>
                            <input class="form-control" type="number" name="total_cost" id="total_cost" value="400" required>
                        </div>

                        <div class="col-md-6 mg-t-10 mg-lg-t-0 mt-2">
                          <p class="mg-b-10">Upload Customer List<b class="text-danger">*</b></p>
                          <input class="form-control" type="file" name="number_of_customer" id="number_of_customer" required>
                      </div>
                        </div>
                        </form>

                        <!-- Select2 -->
                      </div>
                      <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn ripple btn-primary pay_btn" type="button">Proceed To Pay</button>
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
<script>
function is_wallet_payment(val)
{
  if(val == 'Yes')
  {
    $('.pay_btn').html('Purchase Service');
  }else{
    $('.pay_btn').html('Proceed To Pay');
  }
}


</script>
@endsection
