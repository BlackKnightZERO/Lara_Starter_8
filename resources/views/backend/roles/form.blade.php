@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
            @isset($role) 
                Update 
            @else 
                Add 
            @endisset 
                Roles
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.roles.index') }}" title="Create Role" data-placement="bottom" class="btn btn-shadow mr-3 btn btn-secondary">
                <i class="fas fa-arrow-circle-left"></i>&nbsp;List
            </a>
        </div>    
    </div>
</div>  

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <form method="POST" action="{{ isset($role) ? route('app.roles.update', $role->id) : route('app.roles.store') }}">
                @csrf
                @isset($role)
                    @method('PUT')
                @endisset    
                <div class="card-body">
                    <h5 class="card-title">
                    Manage Role
                    </h5>
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input id="name" type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ $role->name ?? old('name') }}" 
                        required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                    <div class="text-center my-4 text-white rounded bg-secondary">
                        <strong>Manage Permissions</strong>
                        @error('permissions')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" 
                                class="custom-control-input" 
                                id="select-all">
                                <label for="select-all" 
                                class="custom-control-label">Select All</label>
                        </div>
                    </div>

                    @forelse($modules->chunk(2) as $chunks)
                        <div class="form-row">
                            @foreach($chunks as $module)
                                <div class="col">
                                    <h5>Module : {{ $module->name }}</h5>
                                    @foreach($module->permissions as $key => $permission)
                                        <div class="mb-3 ml-4">
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" 
                                                    class="custom-control-input" 
                                                    id="permission-{{ $permission->id }}" 
                                                    value="{{ $permission->id }}"
                                                    name="permissions[]"
                                                    @isset($role)
                                                        @foreach($role->permissions as $rPermissions)
                                                            {{ $permission->id == $rPermissions->id ? 'checked' : '' }}
                                                        @endforeach
                                                    @endisset
                                                    >
                                                <label for="permission-{{ $permission->id }}" 
                                                class="custom-control-label">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                    @empty
                        <div class="row">
                            <div class="col text-center">
                                No Module Found
                            </div>
                        </div>
                    @endforelse

                    <button type="submit" class="btn btn-info btn-block"><i class="fas fa-check-circle"></i>
                    @isset($role) 
                        Update 
                    @else 
                        Create 
                    @endisset 
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    $('#select-all').click(function(e){
        if(this.checked){
            $(':checkbox').each(function(){
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function(){
                this.checked = false;
            });
        }
    });
</script>
@endpush
    
@endsection