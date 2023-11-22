@extends('admin.layout.master')
@section('style')

@endsection @section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Customer edit</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Customers</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer edit</li>
                    </ol>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <a href="product.php" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-sm">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist" style="padding-left: 26px;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="userPortfolioTab" data-bs-toggle="tab" data-bs-target="#userPortfolio" type="button" role="tab" aria-controls="userPortfolio" aria-selected="true">Customer details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="userKycTab" data-bs-toggle="tab" data-bs-target="#userKyc" type="button" role="tab" aria-controls="userKyc" aria-selected="false">Kyc Status</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="WalletTab" data-bs-toggle="tab" data-bs-target="#Wallet" type="button" role="tab" aria-controls="Wallet" aria-selected="false">Wallet</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dhpManagementTab" data-bs-toggle="tab" data-bs-target="#dhpManagement" type="button" role="tab" aria-controls="dhpManagement" aria-selected="false">DHP Management</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="userPortfolio" role="tabpanel" aria-labelledby="userPortfolioTab">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <!-- <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">Customer Details</h6>
                                </div> -->
                                <div class="card-body">
                                    <form action="form-validations.php" data-parsley-validate="">
                                        <div class="row row-sm mg-b-20">
                                            <div class="col-md-4">
                                                <p class="mg-b-10">First Name <b class="text-danger">*</b></p>
                                                <input class="form-control" placeholder="First Name" type="text" name="first_name" />
                                            </div>

                                            <div class="col-md-4">
                                                <p class="mg-b-10">Middle Name</p>
                                                <input class="form-control" placeholder="Middle Name" type="text" name="middle_name" />
                                            </div>

                                            <div class="col-md-4">
                                                <p class="mg-b-10">Last Name</p>
                                                <input class="form-control" placeholder="Last Name" type="text" name="last_name" />
                                            </div>

                                            <div class="col-md-4 mt-3">
                                                <p class="mg-b-10">Gender <b class="text-danger">*</b></p>
                                                <div class="form-group">
                                                    <select name="gender" class="form-control select2" required>
                                                        <option value="">Default Select</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                    <span class="text-danger ERROR__gender"></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mt-3 mg-t-20 mg-lg-t-0">
                                                <p class="mg-b-10">Date of birth <b class="text-danger">*</b></p>
                                                <div class="mg-b-20">
                                                    <div class="input-group">
                                                        <div class="input-group-text border-end-0">
                                                            <i class="fa fa-calendar lh--9 op-6"></i>
                                                        </div>
                                                        <input class="form-control fc-datepicker" required placeholder="MM/DD/YYYY" type="text" name="date_of_birth" />
                                                    </div>
                                                    <span class="text-danger ERROR__date_of_birth"></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mt-3 mg-t-10 mg-lg-t-0">
                                                <p class="mg-b-10">Blood Group</p>
                                                <div class="form-group">
                                                    <select name="blood_group" class="form-control select2">
                                                        <option value="">Select Blood Group</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                    </select>
                                                    <span class="text-danger ERROR__blood_group"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <p class="mg-b-10">Email Address <b class="text-danger">*</b></p>
                                                <input class="form-control" placeholder="Email Address" type="text" name="email_address" />
                                            </div>

                                            <div class="col-md-4">
                                                <p class="mg-b-10">Mobile Number</p>
                                                <input class="form-control" placeholder="Mobile Number" type="text" name="mobile_number" />
                                            </div>

                                            <div class="col-md-4">
                                                <p class="mg-b-10">Reset Login Password (Optional)</p>
                                                <input class="form-control" placeholder="New Login Password Setup" type="password" name="login_password" />
                                            </div>

                                            <div class="col-lg-12 mt-3">
                                                <p class="mg-b-10">Address <b class="text-danger">*</b></p>
                                                <textarea class="form-control" name="address" required id="" cols="3" rows="3" placeholder="Enter Full Address"></textarea>
                                                <span class="text-danger ERROR__address"></span>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mb-4">
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary my-2 btn-icon-text">Save Employee Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="userKyc" role="tabpanel" aria-labelledby="userKycTab">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <!-- <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">KYC Status</h6>
                                </div> -->
                                <div class="card-body">
                                    <div class="row row-sm mg-b-20">
                                        <div class="col-md-6">
                                            <p class="mg-b-10">Adhaar Card No</p>
                                            <input
                                                class="form-control"
                                                placeholder="Adhaar Card"
                                                type="text"
                                                name="adhaar_card_no"
                                                pattern="[0-9]{12}"
                                                title="Please enter valid 12 digits"
                                                value=""
                                                placeholder="12 Digit Adhaar Card Number"
                                                onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"
                                                maxlength="12"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mg-b-10">Adhhar Card Verfication</p>
                                            <div class="form-group">
                                                <select name="adhhar_card_verfication_status" class="form-control select2">
                                                    <option value="">Default Select</option>
                                                    <option value="verified">Verified</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="mg-b-10 fw-bold">
                                                Adhaar Card Upload: <b class="text-danger">*</b> &nbsp;
                                                <a href="#" target="_NEW" class="broken_404 text-warning">( <i class="fa-solid fa-eye"></i> <u>View Adhaar Card</u> )</a>
                                            </p>
                                            <input type="file" class="dropify" data-height="100" name="upload_adhaar_card_attachment" />
                                            <span class="text-danger ERROR__upload_adhaar_card_attachment"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-4">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary my-2 btn-icon-text">Save Employee Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Wallet" role="tabpanel" aria-labelledby="WalletTab">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <!-- <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">KYC Status</h6>
                                </div> -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Wallet ID</h6>
                                            <p>8140c121-fd55-42e1-9f73-8e574f868cd7</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Status</h6>
                                            <p>active</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Created At</h6>
                                            <p>20 Jun,2023 09:37 PM</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Updated At(System)</h6>
                                            <p>05 Sep,2023 04:34 PM</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                                            <h5>Main Balance</h5>
                                            <p>Rs. 360</p>
                                        </div>
                                        <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                                            <h5>On Hold Balance</h5>
                                            <p>Rs. 0</p>
                                        </div>
                                        <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                                            <h5>Other Balance</h5>
                                            <p>Rs. 0</p>
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col">
                                            <div class="row mt-3 mb-4">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-primary my-2 btn-icon-text">Wallet Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row row-sm mg-b-20">
                                        <div class="col">
                                            <h5>Order History: </h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sr.</th>
                                                        <th scope="col">Order ID</th>
                                                        <th scope="col">Payment status</th>
                                                        <th scope="col">Mode of payment</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Invoice details</th>
                                                        <th scope="col">Refund Status</th>
                                                        <th scope="col">Refund Status</th>
                                                        <th scope="col">Lab report</th>
                                                        <th scope="col">Radiolgy Report</th>
                                                        <th scope="col">Presciption if available</th>
                                                        <th scope="col">Presciption if available</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>1</th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="dhpManagement" role="tabpanel" aria-labelledby="dhpManagementTab">
                    <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                <!-- <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">KYC Status</h6>
                                </div> -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Percentage of DHP</h6>
                                            <p>10%</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Verification Status</h6>
                                            <p>active</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Next Due Verfifcation</h6>
                                            <p>-</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Organs Locked</h6>
                                            <p>-</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Organs Yet to Unclock</h6>
                                            <p>-</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h6>Status of each organ</h6>
                                            <p>-</p>
                                        </div>
                                    </div>

<!--
                                    <div class="row">
                                        <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                                            <h5></h5>
                                            <p>-</p>
                                        </div>
                                        <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
                                            <h5></h5>
                                            <p>-</p>
                                        </div>
                                    </div> -->

                                    <!-- <div class="row">
                                        <div class="col">
                                            <div class="row mt-3 mb-4">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-primary my-2 btn-icon-text">Wallet Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
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
@endsection
