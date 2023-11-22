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
                        <h2 class="main-content-title tx-24 mg-b-5">Department Listing</h2>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                              <a href="{{ route('new.roles') }}" style="color: white;">  <i class="fa fa-add me-2"></i> Add New Department</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="dataTable" class="table" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th>Sr No.</th>
                                      <th>Title</th>
                                      <th>Editable</th>
                                      <th>Deletable</th>
                                      <th>Status</th>
                                      <th>Access Everything</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($roles as $role)

                                    <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ ucwords($role->title) }}</td>
                                      <td>{{ strtoupper($role->editable) }}</td>
                                      <td>{{ strtoupper($role->deletable) }}</td>
                                      <td>{{ strtoupper($role->status) }}</td>
                                      <td>{{ strtoupper($role->vip) }}</td>
                                      <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y') }}</td>
                                      <td>
                                      @if($role->editable == 'yes')
                                        <a href="{{ route('privileges', lock($role->id)) }}" class="btn btn-sm btn-success"><i class="fas fa-user"></i> &nbsp; Permission &nbsp;</a>
                                      @else
                                        <a href="javascript:void(0)" onclick="alert('{{ ucwords($role->title) }} is not editable')" class="btn btn-sm btn-success" style="cursor: not-allowed;pointer-events: all !important;"><i class="fas fa-lock"></i> &nbsp; Permission &nbsp;</a>
                                      @endif

                                      &nbsp;

                                      @if($role->editable == 'yes')
                                        <a href="{{ route('edit.roles', lock($role->id)) }}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> &nbsp; Edit &nbsp;</a>
                                      @else
                                        <a href="javascript:void(0)" onclick="alert('{{ ucwords($role->title) }} is not editable')" class="btn btn-sm btn-edit" style="cursor: not-allowed;pointer-events: all !important;"><i class="fas fa-lock"></i> &nbsp; Edit &nbsp;</a>
                                      @endif

                                      &nbsp;

                                      @if($role->deletable == 'yes')
                                        <a href="{{ route('remove.roles', lock($role->id)) }}" class="btn btn-sm btn-remove" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> &nbsp; Delete</a>
                                      @else
                                        <a href="javascript:void(0)" onclick="alert('{{ ucwords($role->title) }} is not deletable')" class="btn btn-sm btn-remove" style="cursor: not-allowed;pointer-events: all !important;"><i class="fas fa-lock"></i> &nbsp; Delete</a>
                                      @endif

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
        </div>
    </div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script>
    new DataTable('#dataTable');
</script>
@endsection
