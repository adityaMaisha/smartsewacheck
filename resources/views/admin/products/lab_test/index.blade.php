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

    .my-badge{
        background: #465988!important;
        color: white!important;
        border-radius: 15px!important;
        cursor: pointer!important;
    }
</style>
@endsection @section('content')
<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            {{-- <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Packages List</h2>
                </div> --}}
{{--
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
 --}}

            {{-- </div> --}}
            <!-- End Page Header -->

            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Lab Tests</h2>

                </div>
                <div class="d-flex">
                    <div class="justify-content-center">

                        {{-- <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                            <i class="fa fa-filter me-2"></i> Filter
                        </button> --}}

                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                          <a href="{{ route('products.labtests.create') }}" style="color: white;">  <i class="fa fa-add me-2"></i> Add New Lab Test</a>
                        </button>

                    </div>
                </div>
            </div>


            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="tableizer-table w-100" id="dataTable">
                                    <thead>
                                        <tr class="tableizer-firstrow">
                                            <th>ID</th>
                                            <th>Provider Id</th>
                                            <th>Name</th>
                                            <th>Base Price</th>
                                            <th>Sample Type</th>
                                            <th>Method</th>
                                            <th>Result Time</th>
                                            <th>Gender</th>
                                            <th>Organs</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($labtests as $labtest)
                                            <tr>
                                                <td>{{$labtest->test_idf}}</td>
                                                <td>{{$labtest->providerId}}</td>
                                                <td>{{$labtest->name}}</td>
                                                <td>{{$labtest->basePrice}}</td>
                                                <td>{{$labtest->sampleType}}</td>
                                                <td>{{$labtest->method}}</td>
                                                <td>{{$labtest->resultTime}}</td>
                                                <td>{{$labtest->gender}}</td>
                                                @php
                                                    $organ = \App\Models\Organ::where('_id',$labtest->organs)->first();
                                                @endphp
                                                <td>{{$organ->name}}</td>
                                                <td>
                                                    <a href="{{route('products.labtests.edit',encrypt($labtest->_id))}}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> &nbsp; Edit &nbsp;</a>
                                                    {{-- href={{route('products.labtests.destroy',encrypt($labtest->_id))}} --}}
                                                    <a data-delete-id="{{encrypt($labtest->_id)}}" class="btn btn-sm btn-remove removeItem" ><i class="fas fa-trash"></i> &nbsp; Delete</a>
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

            <!-- End Row -->




            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LT-128 Information</h5>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                         <p><b>Provider ID</b> : AHDPL-001</p>
                        </div>
                        <div class="mb-3">
                            <p><b>Name</b> : ABO Group & RH Type (Blood Group) </p>
                        </div>
                        <div class="mb-3">
                            <p><b>Category</b> : Blood Sample </p>
                        </div>
                        <div class="mb-3">
                            <p><b>Base Price</b> : 99 </p>
                        </div>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection @section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
<script>
    $('.removeItem').click(function(){
        // console.log();
        let data_delete = $(this).attr('data-delete-id');
        let elem = this;
        $.ajax({
            url:`/products/labtests/${data_delete}`,
            type:'delete',
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            datatype:'json',
            success:function(res){
                console.log('success');
                console.log(res);
                $(elem).closest('tr').remove();
            },
            error:function(res){
                console.log('error');
                console.log(res);
            }
        });
    });
    new DataTable("#dataTable");
</script>
@endsection
