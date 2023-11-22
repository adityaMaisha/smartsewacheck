@extends('admin.layout.master')
@section('style')
<style>
    .ammunt_hny img {
    width: 12px;
    margin-right: 6px;
}
</style>
@endsection
@section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">

            
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Wallet of Vendor #{{ $vendor_id }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Vendor Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wallet Details</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text" data-bs-target="#add_money" data-bs-toggle="modal">
                          <i class="fa fa-credit-card me-2"></i> Add Money
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="modal" id="add_money" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo rounded-5">
                        <div class="modal-header">
                            <h6 class="modal-title">Add Money</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>
                        <form method="post" id="add_amount_in_wallet" action="{{ route('wallet.addmoney') }}">
                            @csrf()
                            <div class="row row-sm">
                            <div class="col-lg-12 col-md-12">
                                <div class="">
                                    <div class="card-body">
                                        <div>
                                            <h6 class=" mb-2">Amount</h6>
                                        </div>
                                        <div>
                                            <input id="amount" class="form-control" type="text" name="amount" placeholder="Enter Amount" required>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input class="btn ripple btn-primary" type="submit" value="Add Money">
                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">cancel</button>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row row-sm">
                <div class="col-xxl-4 col-xl-12 col-lg-12 col-md-12">
                    <div class="card custom-card crypto-cur">
                        <div class="card-header border-bottom-0 mb-0">
                            <label class="main-content-label mb-0">Wallet</label>
                            
                        </div>
                        <div class="card-body pt-1">
                            <div class="text-center">
                                <span class="text-uppercase tx-14 mt-4 text-muted">Available Amount</span>
                                <div class="d-flex justify-content-center ammunt_hny">
                                    <img src="{{ asset('dashboard/img/svgs/inr.svg') }}" alt="" width="20px">
                                    <div class="d-flex my-auto"><h2 class="mt-1 mb-0">{{ $wallet_sum }}/-</h2></div>
                                </div>
                            </div>
                            <div class="d-flex mt-4 justify-content-between">
                                <div>
                                    <p class="text-uppercase tx-13 text-muted mb-1">Amount Add in this month</p>
                                    <div class="d-flex my-auto"><h5 class="mt-1 mb-0">₹ {{ $wallet_sum }}/-</h5></div>
                                </div>
                                <div>
                                    <p class="text-uppercase tx-13 text-muted mb-1">Total Added Amount</p>
                                    <div class="d-flex my-auto"><h5 class="mt-1 mb-0">₹ {{ $wallet_sum }}/-</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg-6 col-md-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div>
                                        <h6 class="main-content-label mb-1">Recharge Chart</h6>
                                    </div>
                                    <div class="chartjs-wrapper-demo">
                                        <canvas id="chartLine"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div>
                                        <h6 class="main-content-label mb-1">History Chart</h6>
                                    </div>
                                    <div class="chartjs-wrapper-demo">
                                        <canvas id="chartBar2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card crypto-cur2">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label mt-3">Recharge History</label>
                        </div>
                        <div class="card-body p-3">
                            <table class="table table-striped table-hover" style="width:100%" id="example">
                                  
                                <thead>
                                  <tr>
                                    <th>Sr No.</th>
                                    <th>Wallet ID</th>
                                    <th>Payment Mode</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($wallet_data))
                                    @foreach ($wallet_data as $key => $val)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $val->wallet_id }}</td>
                                        <td>{{ $val->wallet_mode }}</td>
                                        <td>{{ $val->unique_merchant_txn_id }}</td>
                                        <td>₹ {{ $val->wallet_amt }}/-</td>
                                        <td>{{ $val->added_date }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                  <tr>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>

                    <div class="card custom-card crypto-cur2">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label mt-3">Transaction History</label>
                        </div>
                        <div class="card-body p-3">
                            <table class="table table-striped table-hover" style="width:100%" id="example2">
                                  
                                <thead>
                                  <tr>
                                    <th>Sr No.</th>
                                    <th>Wallet ID</th>
                                    <th>Wallet Mode</th>
                                    <th>Dr. / Cr.</th>
                                    <th>Pre Amount</th>
                                    <th>Current Amount</th>
                                    <th>Added Amount</th>
                                    <th>Created At</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($transaction_data))
                                    @foreach ($transaction_data as $key => $val)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $val->wallet_id }}</td>
                                        <td>{{ $val->wallet_mode }}</td>
                                        <td>Credit</td>
                                        <td>₹ {{ $val->pre_wallet_amt }}/-</td>
                                        <td>₹ {{ $val->current_wallet_amt }}/-</td>
                                        <td>₹ {{ $val->added_wallet_amt }}/-</td>
                                        <td>{{ $val->added_date }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                  <tr>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row End -->


        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/js/chart.chartjs.js')}}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script>
    new DataTable('#example2');
</script>
<script>
    var ctx = document.getElementById("chartBar2");
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
			datasets: [{
				label: "Credit",
				data: [65, 59, 80, 81, 56, 55, 40],
				borderColor: "#19b159",
				borderWidth: "0",
				backgroundColor: "#19b159"
			}, {
				label: "Debit",
				data: [28, 48, 40, 19, 86, 27, 90],
				borderColor: "red",
				borderWidth: "0",
				backgroundColor: "red"
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			scales: {
				xAxes: [{
					ticks: {
						fontColor: "#77778e",
					 },
					gridLines: {
						color: 'rgba(119, 119, 142, 0.2)'
					}
				}],
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontColor: "#77778e",
					},
					gridLines: {
						color: 'rgba(119, 119, 142, 0.2)'
					},
				}]
			},
			legend: {
				labels: {
					fontColor: "#77778e"
				},
			},
		}
	});

</script>
@endsection