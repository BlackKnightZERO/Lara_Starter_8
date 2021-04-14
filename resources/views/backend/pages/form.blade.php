@extends('layouts.backend.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<style>
    .dropify-wrapper .dropify-message p{
        font-size: initial;
    }
</style>
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
            @isset($page) 
                Update 
            @else 
                Add 
            @endisset 
                Pages
            </div>
        </div>
        <div class="page-title-actions">
            @can('app.pages.index', App\Models\Page::class)
            <a href="{{ route('app.pages.index') }}" title="Create Role" data-placement="bottom" class="btn btn-shadow mr-3 btn btn-secondary">
                <i class="fas fa-arrow-circle-left"></i>&nbsp;List
            </a>
            @endcan
        </div>    
    </div>
</div>  

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ isset($page) ? route('app.pages.update', $page->id) : route('app.pages.store') }}" enctype="multipart/form-data">
            @csrf
            @isset($page)
                @method('PUT')
            @endisset 
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">
                            page Info
                            </h5>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input id="title" type="text" 
                                class="form-control @error('title') is-invalid @enderror" 
                                name="title" value="{{ $page->title ?? old('title') }}" 
                                required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                            <label for="excerpt">Short Description</label>
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                name="password_confirmation">{{ $page->excerpt ?? old('excerpt')  }}</textarea>
                                @error('excerpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                            <label for="body">Main Description</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" 
                                name="password_confirmation">{{ $page->body ?? old('body')  }}</textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                 

                            <hr>
                            <button type="submit" class="btn btn-info btn-block"><i class="fas fa-check-circle"></i>
                            @isset($page) 
                                Update 
                            @else 
                                Create 
                            @endisset 
                            </button>
                            
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">
                            Image & Status
                            </h5>
                            <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" 
                                    class="dropify @error('image') is-invalid @enderror" 
                                    data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : '' }}"
                                    name="image" 
                                    @isset($page) @else required @endisset>
                                    </input>
                                    @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" 
                                    class="custom-control-input" 
                                    id="status" name="status"
                                    @isset($page)
                                        {{ $page->status == true ? 'checked' : '' }}
                                    @endisset    
                                    >
                                    <label class="custom-control-label" for="status">Status</label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>  
                    </div>  

                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">
                            Meta Informations
                            </h5>
                            <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                name="password_confirmation">{{ $page->meta_description ?? old('meta_description')  }}</textarea>
                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                                <textarea class="form-control @error('meta_keywords') is-invalid @enderror" 
                                name="password_confirmation">{{ $page->meta_keywords ?? old('meta_keywords')  }}</textarea>
                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                    </div>         
                </div>
            </div>
        </form>
    </div>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.dropify').dropify();
});
</script>
@endpush
    
@endsection