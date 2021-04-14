@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Roles Management
            </div>
        </div>
        <div class="page-title-actions">
            @can('app.roles.create', App\Models\Role::class)
            <a href="{{ route('app.roles.create') }}" 
                title="Create Role" 
                data-placement="bottom" 
                class="btn btn-shadow mr-3 btn btn-dark"
            >
                <i class="fas fa-plus-circle"></i>&nbsp;Add
            </a>
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
                        <th class="text-center">Name</th>
                        <th class="text-center">Permissions</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $role->name }}</td>
                        <td class="text-center">
                            @if($role->permissions->count() > 0)
                                <span class="badge badge-info">{{ $role->permissions->count() }}</span>
                            @else       
                                <span class="badge badge-secondary">NO</span> 
                            @endif
                        </td>
                        <td class="text-center">{{ $role->updated_at->diffForHumans() }}</td>
                        <td class="text-center">
                            @can('app.roles.create', App\Models\Role::class)
                                <a href="{{ route('app.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">&#128394; </a>
                            @endcan   
                            @can('app.roles.destroy', App\Models\Role::class)
                                @if($role->deletable==true)
                                <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteData({{ $role->id }})"
                                >&#10006; </button>
                                <form id="delete-form-{{ $role->id }}" method="POST" action="{{ route('app.roles.destroy', $role->id) }}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
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