@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-pe-7s-photo-gallery icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>User Management
            </div>
        </div>
        <div class="page-title-actions">
            @can('app.pages.create', App\Models\Page::class)
            <a href="{{ route('app.pages.edit', $user->id) }}" 
                title="Create User" 
                data-placement="bottom" 
                class="btn btn-shadow mr-3 btn btn-dark"
            >
                <i class="fa fa-pen"></i>&nbsp;Edit
            </a>
            @endcan
            @can('app.pages.index', App\Models\Page::class)
            <a href="{{ route('app.pages.index') }}" title="Create Role" data-placement="bottom" class="btn btn-shadow mr-3 btn btn-secondary">
                <i class="fas fa-arrow-circle-left"></i>&nbsp;List
            </a>
            @endcan
        </div>    
    </div>
</div>  

<div class="row">
    <div class="col-md-2">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <img src="{{ $user->getFirstMediaUrl('avatar') }}" class="img-fluid img-thumbnail" />
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="main-card mb-3 card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Role</th>
                            <td>
                                @if ($user->role)
                                    <span class="badge badge-info">{{ $user->role->name }}</span>
                                @else
                                    <span class="badge badge-danger">--</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td>
                                @if ($user->status)
                                    <div class="badge badge-success">Active</div>
                                @else
                                    <div class="badge badge-warning">Inactive</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                        <th scope="row">Created At</th>
                            <td>{{ $user->created_at->diffForhumans() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
@endsection