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
                  <h2 class="main-content-title tx-24 mg-b-5">Order Management</h2>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Assign Lab to Customer List</li>
                  </ol>
                </div>
                <div class="d-flex">
                  <div class="justify-content-center">
                    <button type="button" class="btn btn-primary my-2 btn-icon-text">
                      <i class="fe fe-download-cloud me-2"></i> Download Report
                    </button>
                  </div>
                </div>
              </div>
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                          <div class="card-header  border-bottom-0 pb-0">
                            <div>
                              <div class="d-flex">
                                <label class="main-content-label my-auto pt-2">All Assigned List</label>
                              </div>
                            </div>
                          </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover" style="width:100%" id="example2">
                                  
                                  <thead>
                                    <tr>
                                      <th>Sr No.</th>
                                      <th>Lab Details</th>
                                      <th>Customer Details</th>
                                      <th>Order Details</th>
                                      <th>Payment Details</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Lab ID - LAB1122 <br>Lab Details - PathLab,Govidpuri,New Delhi,110091 <br>Status from Lab - <span class="badge bg-pill bg-warning-light">Pending</span><br>Collection ID - <span class="badge bg-pill bg-success-light">CO39670</span><a class="badge bg-pill bg-danger" href="{{ route('lab.data') }}">Received</a></td>
                                        <td>Customer ID - CUST1234 <br>Name - Customer One</td>
                                        <td>Order ID - SM1122 <br>Order Details - Service One <br> Order Amt - ₹ 99/-</td>
                                        <td>Payment ID - rzp_112233 <br>Payment Status - <span class="badge bg-pill bg-success-light">Success</span> <br>Payment Mode - Online</td>
                                        <td>26-09-2023</td>
                                      <td><div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple  dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="fa fa-ellipsis-v" aria-hidden="true" style="font-size: 18px;"></i></button>
                                        <div class="dropdown-menu tx-13">
                                            <a class="dropdown-item" href="javascript:void(0)" >Delete</a>
                                            <a class="dropdown-item" href="#" data-bs-target="#update_status" data-bs-toggle="modal">Update Status</a>
                                          </div>
                                     </div></td>
                                      
                                    </tr>
                                  </tbody>
                                </table>

                              </div>
                        </div>
                    </div>
                </div>
                {{-- assign to lab model --}}
                <div class="modal" id="update_status">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                      <div class="modal-header">
                        <h6 class="modal-title">Update Lab Status</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                              <p class="mg-b-10">Select Status<b class="text-danger">*</b></p>
                              <select name="lab_status" id="lab_status" class="form-control">
                                <option value="Pending" selected>Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancel">Cancel</option>
                              </select>
                          </div>
                        </div>
                        <!-- Select2 -->
                      </div>
                      <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn ripple btn-primary" type="button">Update</button>
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
