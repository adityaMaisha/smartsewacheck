@extends('admin.layout.master')
@section('style')
@endsection
@section('content')
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            <div class="inner-body">

                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Add New Hospitals & Others</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Hospitals & Others</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <a href="{{route('vendor.hospital.list')}}" style="color: white;"> <i class="fa fa-backward me-2"></i> Back</a>
                            </button>
                        </div>
                    </div>
                </div>

                <form action="{{ route('vendor.new.setup') }}" method="POST" enctype="multipart/form-data" id="htmlForm">
                    @csrf

                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card custom-card">
                                {{-- <div class="mb-4 hny_tt">
                                    <h6 class="main-content-label mb-1">Personal Detail</h6>
                                </div> --}}
                                <div class="card-body">
                                    <div class="row row-sm mg-b-20 text-center">
                                        <div class="col-lg">
                                           <h3>Add New Hospitals & Others</h3>
                                           <p>You can open a form on the screen to create a new vendor. From here, you can create vendors for hospitals, health insurance, gyms, and similar types of businesses.</p>
                                        </div>
                                    </div>

                                    <div class="row row-sm mg-b-20">
                                        <div class="col-lg">
                                            <p class="mg-b-10">Vendor Type <b class="text-danger">*</b></p>
                                            <select class="form-control select2" name="vendorType">
                                                <option value="" label="Choose one"> </option>
                                                <option value="hospitals">Hospitals</option>
                                                <option value="health_insurance">Health Insurance</option>
                                                <option value="gym">Gym</option>
                                                <option value="rejuvation_ceters">Rejuvation Ceters</option>
                                                <option value="fitness_coach">Fitness Coach</option>
                                                <option value="yoga_instructor">Yoga Instructor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 mb-4">
                                    <div class="col-12 text-center">
                                        <input type="submit" class="btn btn-primary my-2 btn-icon-text" style="color: white;"
                                            value="&nbsp; Next Step - Create Vendor &nbsp;">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection
@section('script')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#htmlForm', function(ev) {

        ev.preventDefault();
        var frm = $('#htmlForm');
        var form = $('#htmlForm')[0];
        var data = new FormData(form);

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: data,
            beforeSend: function() {

                $('body').css('pointer-events', 'none');

            },
            success: function(data) {

                if(data.success == true){
                    window.open(data.url,"_self")
                }

            },
            error: function(err) {

                //

            },
            complete: function(data) {

                $('body').css('pointer-events', 'auto');

            }

        });

    });

</script>
@endsection
