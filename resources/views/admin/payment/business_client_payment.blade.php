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
                      <h2 class="main-content-title tx-24 mg-b-5">Payment History</h2>
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Business Client Paymnet History</li>
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
                            <div class="card-body">

                              <div class="text-wrap">
                                <div class="example">
                                  <div class="panel panel-primary tabs-style-2">
                                    <div class=" tab-menu-heading">
                                      <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                          <li><a href="#tab4" class="nav-link active mt-1" data-bs-toggle="tab">Payment Success Report</a></li>
                                          <li><a href="#tab5" class="nav-link mt-1" data-bs-toggle="tab">Payment Failure Report</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                      <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                          <table class="table table-striped table-hover example3" style="width:100%">
                                            <thead>
                                              <tr>
                                                <th>Sr No.</th>
                                                <th>Payment Status</th>
                                                <th>Order ID</th>
                                                <th>Order For</th>
                                                <th>Amount</th>
                                                <th>TXN code</th>
                                                <th>TXN Message</th>
                                                <th>Acquirer Name</th>
                                                <th>Pay TXN ID</th>
                                                <th>Captured Amt</th>
                                                <th>Pay Mode</th>
                                                <th>Mask Card No.</th>
                                                <th>Card Holder Name</th>
                                                <th>Date & time</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @if(!empty($success_payment))
                                              @foreach($success_payment as $key => $val)
                                              <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><a class="badge bg-pill bg-success">{{ $val->txn_response_msg }}</a></td>
                                                <td>{{ $val->unique_merchant_txn_id }}</td>
                                                <td>Service One</td>
                                                <td>{{ $val->final_amt }}</td>
                                                <td>{{ $val->txn_response_code }}</td>
                                                <td>{{ $val->txn_response_msg }}</td>
                                                <td>{{ $val->acquirer_name }}</td>
                                                <td>{{ $val->pine_pg_transaction_id }}</td>
                                                <td>{{ $val->captured_amount_in_paisa }} (In Paisa)</td>
                                                <td>{{ $val->payment_mode }}</td>
                                                <td>{{ $val->masked_card_number }}</td>
                                                <td>{{ $val->card_holder_name }}</td>

                                                <td>{{ $val->created_at }}</td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="tab-pane" id="tab5">
                                          <table class="table table-striped table-hover example3" style="width:100%" >
                                            <thead>
                                              <tr>
                                                <th>Sr No.</th>
                                                <th>Payment Status</th>
                                                <th>Order ID</th>
                                                <th>Order For</th>
                                                <th>Amount</th>
                                                <th>TXN code</th>
                                                <th>TXN Message</th>
                                                <th>Acquirer Name</th>
                                                <th>Pay TXN ID</th>
                                                <th>Captured Amt</th>
                                                <th>Pay Mode</th>
                                                <th>Mask Card No.</th>
                                                <th>Card Holder Name</th>
                                                <th>Date & time</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @if(!empty($failed_payment))
                                              @foreach($failed_payment as $key => $val)
                                              <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><a class="badge bg-pill bg-success">{{ $val->txn_response_msg }}</a></td>
                                                <td>{{ $val->unique_merchant_txn_id }}</td>
                                                <td>Service One</td>
                                                <td>{{ $val->final_amt }}</td>
                                                <td>{{ $val->txn_response_code }}</td>
                                                <td>{{ $val->txn_response_msg }}</td>
                                                <td>{{ $val->acquirer_name }}</td>
                                                <td>{{ $val->pine_pg_transaction_id }}</td>
                                                <td>{{ $val->captured_amount_in_paisa }} (In Paisa)</td>
                                                <td>{{ $val->payment_mode }}</td>
                                                <td>{{ $val->masked_card_number }}</td>
                                                <td>{{ $val->card_holder_name }}</td>

                                                <td>{{ $val->created_at }}</td>
                                              </tr>
                                              @endforeach
                                              @endif
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                          <p>praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,</p>
                                          <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              </div>
                        </div>
                    </div>
                </div>


                {{-- assign to lab model --}}

            </div>
        </div>
    </div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script>
    $('.example3').DataTable({
      responsive: {
         details: {
            display: $.fn.dataTable.Responsive.display.modal({
               header: function (row) {
                  var data = row.data();
                  return 'Payment Details Of ' + data[2];
               }
            }),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
               tableClass: 'table'
            })
         }
      }
   });
</script>
@endsection
