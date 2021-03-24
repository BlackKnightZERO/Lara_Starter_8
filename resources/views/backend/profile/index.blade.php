@extends('layouts.backend.app')

@push('css')
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
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
            Profile
            </div>
        </div>  
    </div>
</div>  

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('app.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
            <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">
                            Avatar
                            </h5>
                            <div class="form-group">
                                    <label for="avatar">Image</label>
                                    <input type="file" id="avatar" 
                                    class="dropify @error('avatar') is-invalid @enderror" 
                                    data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : '' }}"
                                    name="avatar" 
                                    @isset($user) @else required @endisset>
                                    </input>
                                    @error('avatar')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>  
                    </div>          
                </div>
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">
                            User Info
                            </h5>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ $user->name ?? old('name') }}" 
                                required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ $user->email ?? old('email') }}" 
                                required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>      
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                @isset($user) @else required @endisset  autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>      
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input id="confirm_password" type="password" 
                                class="form-control @error('confirm_password') is-invalid @enderror" 
                                name="password_confirmation" 
                                @isset($user) @else required @endisset autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>      

                            <hr>
                            <button type="submit" class="btn btn-info btn-block"><i class="fas fa-check-circle"></i>
                                Update
                            </button>
                            
                        </div>
                    </div>    
                </div>
            </div>
        </form>
    </div>
</div>

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('.dropify').dropify();
});
</script>
@endpush
    
@endsection