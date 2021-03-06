@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-refresh-cloud icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Backups Management
            </div>
        </div>
        <div class="page-title-actions">
            @can('app.backups.destroy')
            <button onclick="event.preventDefault();
                          document.getElementById('clean-old-backups').submit();"
                            class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-trash fa-w-20"></i>
                        </span>
                        {{ __('Clean Old Backups') }}
                    </button>
                    <form id="clean-old-backups" action="{{ route('app.backups.clean') }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
            @endcan        

            @can('app.backups.create')
            <button type="button" onclick="event.preventDefault(); document.getElementById('backup_form').submit();"; 
                title="Create" 
                data-placement="bottom" 
                class="btn btn-shadow mr-3 btn btn-primary"
            >
                <i class="fas fa-plus-circle"></i>&nbsp;Create
            </button>
            <form id="backup_form" action="{{ route('app.backups.store') }}" method="POST" style="display:none">
                @csrf
            </form>
            @endcan
        </div>    
    </div>
</div>  

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">

            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">File Name</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($backups as $key => $backup)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $backup['file_name'] }}</td>
                        <td class="text-center">{{ $backup['file_size'] }}</td>
                        <td class="text-center">{{ $backup['created_at'] }}</td>
                        <td class="text-center">
                            @can('app.backups.download')
                                <a href="{{ route('app.backups.download', $backup['file_name']) }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i></a>
                            @endcan     
                            @can('app.backups.destroy')
                                <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteData({{ $key }})"
                                ><i class="fas fa-times"></i></button>
                                <form id="delete-form-{{ $key }}" method="POST" action="{{ route('app.backups.destroy', $backup['file_name']) }}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
    
@endsection