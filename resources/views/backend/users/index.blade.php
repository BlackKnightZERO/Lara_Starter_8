@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>User Management
            </div>
        </div>
        <div class="page-title-actions">
            {{-- @can(Auth::user()->hasPermission('app.users.create')) --}}
            <a href="{{ route('app.users.create') }}" 
                title="Create User" 
                data-placement="bottom" 
                class="btn btn-shadow mr-3 btn btn-dark"
            >
                <i class="fas fa-plus-circle"></i>&nbsp;Add
            </a>
            {{-- @end --}}
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
                        <th class="text-center">Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="widget-content-left">
                                            
                                            <img width="40" class="rounded-circle"
                                                    src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar') : config('app.placeholder').'160' }}" alt="User Avatar">
                                                    
                                            {{--         
                                            <img width="40" class="rounded-circle"
                                            src="{{ config('app.placeholder').'160' }}" alt="User Avatar">     
                                            --}}      
                                        </div>
                                    </div>
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading">{{ $user->name }}</div>
                                        <div class="widget-subheading opacity-7">
                                            @if ($user->role)
                                                <span class="badge badge-info">{{ $user->role->name }}</span>
                                            @else
                                                <span class="badge badge-danger">--</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            {{ $user->email }}
                        </td>
                        <td class="text-center">
                            @if ($user->status)
                                <div class="badge badge-success">Active</div>
                            @else
                                <div class="badge badge-warning">Inactive</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                        <td class="text-center">               
                            {{-- @can(Auth::user()->hasPermission('app.users.create')) --}}
                                <a href="{{ route('app.users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            {{-- @endcan --}}
                            {{-- @can(Auth::user()->hasPermission('app.users.index')) --}}
                                <a href="{{ route('app.users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            {{-- @endcan --}}
                            {{-- @can(Auth::user()->hasPermission('app.users.destroy')) --}}
                                <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteData({{ $user->id }})"
                                ><i class="fas fa-times"></i></button>
                                <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('app.users.destroy', $user->id) }}" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            {{-- @endcan --}}
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