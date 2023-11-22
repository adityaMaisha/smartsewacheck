@extends('admin.layout.master')
@section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">

            
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Data From LAB Collection Code - CO39645</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Order Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data from LAB</li>
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
            <!-- End Page Header -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Customer & Test Details</label>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent">ID</th>
                                                <th class="bg-transparent">Case Number</th>
                                                <th class="bg-transparent">Priority</th>
                                                <th class="bg-transparent">Bar Code</th>
                                                <th class="bg-transparent">POD Number</th>
                                                <th class="bg-transparent">First Name</th>
                                                <th class="bg-transparent">Last Name</th>
                                                <th class="bg-transparent">DOB</th>
                                                <th class="bg-transparent">Age</th>
                                                <th class="bg-transparent">Gender</th>
                                                <th class="bg-transparent">UID No.</th>
                                                <th class="bg-transparent">MRN No.</th>
                                                <th class="bg-transparent">Mobile</th>
                                                <th class="bg-transparent">Email</th>
                                                <th class="bg-transparent">Pin</th>
                                                <th class="bg-transparent">Address</th>
                                                <th class="bg-transparent">Client ID</th>
                                                <th class="bg-transparent">Institution ID</th>
                                                <th class="bg-transparent">Physician ID</th>
                                                <th class="bg-transparent">Temprature</th>
                                                <th class="bg-transparent">Created at</th>
                                                <th class="bg-transparent">Status</th>
                                                <th class="bg-transparent">Others</th>
                                                <th class="bg-transparent">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom">
                                                <td>{{ $lab_data->id }}</td>
                                                <td>{{ $lab_data->case_number }}</td>
                                                <td>{{ $lab_data->priority }}</td>
                                                <td>{{ $lab_data->barcode }}</td>
                                                <td>{{ $lab_data->pod_number }}</td>
                                                <td>{{ $lab_data->first_name }}</td>
                                                <td>{{ $lab_data->last_name }}</td>
                                                <td>{{ $lab_data->dob }}</td>
                                                <td>{{ $lab_data->age }}</td>    
                                                <td>{{ $lab_data->gender }}</td>
                                                <td>{{ $lab_data->uid_number }}</td>
                                                <td>{{ $lab_data->mrn_number }}</td>
                                                <td>{{ $lab_data->mobile }}</td>
                                                <td>{{ $lab_data->email }}</td>
                                                <td>{{ $lab_data->pin_code }}</td>
                                                <td>{{ $lab_data->address }}</td>
                                                <td>{{ $lab_data->client_id }}</td>
                                                <td>{{ $lab_data->institution_id }}</td>
                                                <td>{{ $lab_data->physician_id }}</td>
                                                <td>{{ $lab_data->temperature }}</td>
                                                <td>{{ $lab_data->collection_date_and_time }}</td>
                                                <td>{{ $lab_data->status }}</td>
                                                <td>{{ $lab_data->clinicalhistoryattached }} <br> {{ $lab_data->clinicalhistoryattached }}</td>
                                                
                                                <td><a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">Trade</a></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-xxl-12 col-md-12 col-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Reports</label>
                        </div>
                        <div class="card-body pb-3">
                            <div class="row row-sm">
                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
											<a href="javascript:void(0);"><img src="{{ asset('dashboard/img/files/file.png')}}" alt="img" class="br-7"></a>
										</div>
										<h6 class="mb-1 font-weight-semibold mt-0">Test Name</h6>
									</div>
								</div>
							</div>
                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
											<a href="javascript:void(0);"><img src="{{ asset('dashboard/img/files/file.png')}}" alt="img" class="br-7"></a>
										</div>
										<h6 class="mb-1 font-weight-semibold mt-0">Test Name</h6>
									</div>
								</div>
							</div>
                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
											<a href="javascript:void(0);"><img src="{{ asset('dashboard/img/files/file.png')}}" alt="img" class="br-7"></a>
										</div>
										<h6 class="mb-1 font-weight-semibold mt-0">Test Name</h6>
									</div>
								</div>
							</div>
                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
											<a href="javascript:void(0);"><img src="{{ asset('dashboard/img/files/file.png')}}" alt="img" class="br-7"></a>
										</div>
										<h6 class="mb-1 font-weight-semibold mt-0">Test Name</h6>
									</div>
								</div>
							</div>
                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
											<a href="javascript:void(0);"><img src="{{ asset('dashboard/img/files/file.png')}}" alt="img" class="br-7"></a>
										</div>
										<h6 class="mb-1 font-weight-semibold mt-0">Test Name</h6>
									</div>
								</div>
							</div>
                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
											<a href="javascript:void(0);"><img src="{{ asset('dashboard/img/files/file.png')}}" alt="img" class="br-7"></a>
										</div>
										<h6 class="mb-1 font-weight-semibold mt-0">Test Name</h6>
									</div>
								</div>
							</div>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-xxl-12 col-md-12 col-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Test Details</label>
                        </div>
                        <div class="card-body pb-3">
                            <div class="row row-sm">
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                        <strong>Collection ID </strong> - CO39670 <br>
                                        <strong>Test Code </strong> - IA1355 <br>
                                        <strong>Test Name </strong> - MLH1 
                                        </div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Collection ID </strong> - CO39670 <br>
                                            <strong>Test Code </strong> - IA1355 <br>
                                            <strong>Test Name </strong> - MLH1 
                                            </div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Collection ID </strong> - CO39670 <br>
                                            <strong>Test Code </strong> - IA1355 <br>
                                            <strong>Test Name </strong> - MLH1 
                                            </div>
									</div>
								</div>
							</div>
                        
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-xxl-12 col-md-12 col-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Panel Details</label>
                        </div>
                        <div class="card-body pb-3">
                            <div class="row row-sm">
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Collection ID </strong> - CO39670 <br>
                                            <strong>Panel Code </strong> - IA1355 <br>
                                            <strong>Panel Name </strong> - AML Prognostic Panel (3 Markers) 
                                            </div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Collection ID </strong> - CO39670 <br>
                                            <strong>Panel Code </strong> - IA1355 <br>
                                            <strong>Panel Name </strong> - AML Prognostic Panel (3 Markers) 
                                            </div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Collection ID </strong> - CO39670 <br>
                                            <strong>Panel Code </strong> - IA1355 <br>
                                            <strong>Panel Name </strong> - AML Prognostic Panel (3 Markers) 
                                            </div>
									</div>
								</div>
							</div>
                        
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-xxl-12 col-md-12 col-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Attachment Details</label>
                        </div>
                        <div class="card-body pb-3">
                            <div class="row row-sm">
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card overflow-hidden">
									<a href="file-details.php.html"><img src="{{ asset('dashboard/img/files/img-1.jpg')}}" alt="img"></a>
									<div class="card-footer bd-t-0 py-3">
										<div class="d-flex">
											<div>
												<h6 class="mb-0">221.jpg</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card overflow-hidden">
									<a href="file-details.php.html"><img src="{{ asset('dashboard/img/files/img-1.jpg')}}" alt="img"></a>
									<div class="card-footer bd-t-0 py-3">
										<div class="d-flex">
											<div>
												<h6 class="mb-0">221.jpg</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card overflow-hidden">
									<a href="file-details.php.html"><img src="{{ asset('dashboard/img/files/img-1.jpg')}}" alt="img"></a>
									<div class="card-footer bd-t-0 py-3">
										<div class="d-flex">
											<div>
												<h6 class="mb-0">221.jpg</h6>
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

            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-xxl-12 col-md-12 col-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Other Details</label>
                        </div>
                        <div class="card-body pb-3">
                            <div class="row row-sm">
                            <div class="col-xl-4 col-md-3  col-lg-6">
                                
								<div class="card custom-card border shadow-none">
                                    
									<div class="card-body  text-center">
                                    	<div class="file-manger-icon">
                                            <strong>Client ID </strong> - 1053 <br>
                                            <strong>Client Code </strong> - CL01053 <br>
                                            <strong>Client Name </strong> - ABC Private Limited
                                            </div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Institution ID </strong> - 32 <br>
                                            <strong>Institution Code </strong> - IN00032 <br>
                                            <strong>Institution Name </strong> - ABC Hospital
                                            </div>
									</div>
								</div>
							</div>
                            <div class="col-xl-4 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Physician ID </strong> - 2 <br>
                                            <strong>Physician Code </strong> - PY00002 <br>
                                            <strong>Physician Name </strong> - Surender
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>History Attached </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Smoking </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Past History Cancer </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Diabetes </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Drunk Status </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Radiology </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Other History </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>

                            <div class="col-xl-2 col-md-3  col-lg-6">
								<div class="card custom-card border shadow-none">
									<div class="card-body  text-center">
										<div class="file-manger-icon">
                                            <strong>Other History Desc </strong> - True <br>
                                            </div>
									</div>
								</div>
							</div>
                        
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-xxl-12 col-md-12 col-12">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0">
                            <label class="main-content-label my-auto">Specimen Details</label>
                        </div>
                        <div class="card-body pb-3">
                            <div class="row row-sm">
                            <div class="col-xl-12 col-md-12  col-lg-12">
                                
								<table class="table table-striped table-hover" style="width:100%" id="example2">
                                  
                                    <thead>
                                      <tr>
                                        <th>Collection ID</th>
                                        <th>Name</th>
                                        <th>Barcode</th>
                                        <th>Container Title</th>
                                        <th>Preservation Title</th>
                                        <th>Minimum Vol Weight</th>
                                        <th>Unit Name</th>
                                        <th>Quantity</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                          <td>39645</td>
                                          <td>Whole Blood</td>
                                          <td>123456</td>
                                          <td>Container Title</td>
                                          <td>Preservation Title</td>
                                          <td>Minimum Vol Weight</td>
                                          <td>Unit Name</td>
                                          <td>1</td>
                                        
                                      </tr>
                                    </tbody>
                                  </table>
							</div>
                            
                        
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- End row -->

            <!-- row opened -->
            
            <!-- Row End -->


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