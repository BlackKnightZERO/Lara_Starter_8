@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Page Management
            </div>
        </div>
        <div class="page-title-actions">
            @can('app.pages.create', App\Models\Page::class)
            <a href="{{ route('app.pages.create') }}" 
                title="Create Page" 
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
                        <th class="text-center">Title</th>
                        <th class="text-center">Url</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Last Modified</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            {{$page->title }}
                        </td>
                        <td class="text-center">
                          <a href="#">{{ $page->slug }}</a>
                        </td>
                        <td class="text-center">
                            @if ($page->status)
                                <div class="badge badge-success">Active</div>
                            @else
                                <div class="badge badge-warning">Inactive</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $page->updated_at->diffForHumans() }}</td>
                        <td class="text-center">               
                            @can('app.pages.edit', App\Models\Page::class)
                                <a href="{{ route('app.pages.edit', $page->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('app.pages.destroy', App\Models\Page::class)
                                <button type="button" class="btn btn-danger btn-sm"
                                onclick="deleteData({{ $page->id }})"
                                ><i class="fas fa-times"></i></button>
                                <form id="delete-form-{{ $page->id }}" method="POST" action="{{ route('app.pages.destroy', $page->id) }}" style="display:none;">
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