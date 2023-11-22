@extends('admin.layout.master') @section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" />
<style>
    .summ_tit {
        background-color: white;
        padding: 4px 0px;
        text-align: center;
        margin-bottom: 14px;
        border: 1px solid #c1c1c1;
        border-radius: 10px;
    }
    .ssinner h5 {
    font-size: 13px;
}

.ssinner {
    border-bottom: 1px solid #dddddd;
    padding: 6px;
}

    input[type="checkbox"] {
        width: 25px; /*Desired width*/
        height: 25px; /*Desired height*/
    }

    table.tableizer-table {
        font-size: 12px;
        border: 1px solid #ccc;
        font-family: Arial, Helvetica, sans-serif;
    }
    .tableizer-table td {
        padding: 4px;
        margin: 3px;
        border: 1px solid #ccc;
    }
    .tableizer-table th {
        background-color: #104e8b;
        color: #fff;
        font-weight: bold;
    }
    .hny_gap{
        gap: 12px;
    }
</style>
@endsection @section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Labs & Diagnostics</h2>
                </div>

               <div class="d-flex hny_gap">
                <div class="summ_tit">
                    <div class="ssinner">
                        <h5>Total Diagnostics</h5>
                    </div>
                    <div class="newdis">
                        <p class="mb-0">500</p>
                    </div>
                </div>


                <div class="summ_tit">
                    <div class="ssinner">
                        <h5>Diagnostics Allocated with Lab</h5>
                    </div>
                    <div class="newdis">
                        <p class="mb-0">205</p>
                    </div>
                </div>
               </div>





            </div>
            <!-- End Page Header -->


            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-between mb-4">
                                    <h4>Diagnostics Allocated with Lab</h4>
                                    <button type="button" class="btn btn-outline-primary" id="diagnosticsAllocatedButton">Diagnostics Allocated</button>
                                </div>


                                <table class="tableizer-table" id="dataTable">
                                    <thead>
                                        <tr class="tableizer-firstrow">
                                            <th></th>
                                            <th>testIdF</th>
                                            <th>providerId</th>
                                            <th>name</th>
                                            <th>category</th>
                                            <th>basePrice</th>
                                            <th>discount</th>
                                            <th>sampleType</th>
                                            <th>method</th>
                                            <th>description</th>
                                            <th>resultTime</th>
                                            <th>age group</th>
                                            <th>gender</th>
                                            <th>organs</th>
                                            <th>tags</th>
                                            <th>attachedVitals</th>
                                            <th>forOraganUnlock</th>
                                            <th>Numer of Vital Attached</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="DiagnosticsBox" >
                                            </td>
                                            <td>LT-01</td>
                                            <td>AHD01</td>
                                            <td>ABO Group & RH Type (Blood Group)</td>
                                            <td>Blood Sample</td>
                                            <td>99</td>
                                            <td>upto 15%</td>
                                            <td>W B-ED TA (3ml)</td>
                                            <td>Agglutination</td>
                                            <td>Blood Group</td>
                                            <td>Same Day</td>
                                            <td>0-100</td>
                                            <td>Both</td>
                                            <td>Blood</td>
                                            <td>Blood Group</td>
                                            <td>&nbsp;</td>
                                            <td>FALSE</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="DiagnosticsBox" >
                                            </td>
                                            <td>LT-13</td>
                                            <td>AHDPL-001</td>
                                            <td>AFP (Alpha Feto Protein)</td>
                                            <td>Blood Sample</td>
                                            <td>349</td>
                                            <td>upto 15%</td>
                                            <td>Serum (1 ml)</td>
                                            <td>CLIA</td>
                                            <td>AFP (Alpha Feto Protein)</td>
                                            <td>Same Day</td>
                                            <td>0-100</td>
                                            <td>Both</td>
                                            <td>Liver, Yolk Sac</td>
                                            <td>Baby risk, Genetic Problem, Birth Defects, Liver Cancer</td>
                                            <td>&nbsp;</td>
                                            <td>TRUE</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Row -->
        </div>
    </div>
</div>
@endsection @section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
<script>
    new DataTable("#dataTable");
</script>
<script>
    // Define a function to show or hide the button based on checkbox states
    function updateButtonVisibility() {
      if ($('.DiagnosticsBox:checked').length > 0) {
        $('#diagnosticsAllocatedButton').show();
      } else {
        $('#diagnosticsAllocatedButton').hide();
      }
    }

    // Call the function on page load (onload)
    $(document).ready(function() {
      updateButtonVisibility(); // Call the function on page load
    });

    // Call the function when any checkbox with class "DiagnosticsBox" changes (onchange)
    $('.DiagnosticsBox').change(function() {
      updateButtonVisibility(); // Call the function when checkboxes change
    });
</script>
@endsection
