@extends('layouts.app')
@extends('layouts.base')
@include('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #9A9A9A; font-family: impact; font-size: 15px;">
                <div class="card-header" style="font-family: impact; font-size: 30px;" >{{ __('ANIMAL CARE REGISTRATION') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> 
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" style="font-size:15px;" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" style="font-size:15px;" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" style="font-size:15px;" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="addressline" class="col-md-4 col-form-label text-md-end">{{ __('Addressline') }}</label>

                            <div class="col-md-6">
                                <input id="addressline" style="font-size:15px;" type="text" class="form-control @error('addressline') is-invalid @enderror" name="addressline" value="{{ old('addressline') }}" required autocomplete="addressline" autofocus>

                                @error('addressline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Town') }}</label>

                            <div class="col-md-6">
                                <input id="town" type="text" style="font-size:15px;" class="form-control @error('town') is-invalid @enderror" name="town" value="{{ old('town') }}" required autocomplete="town" autofocus>

                                @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="zipcode" class="col-md-4 col-form-label text-md-end">{{ __('Zipcode') }}</label>

                            <div class="col-md-6">
                                <input id="zipcode" style="font-size:15px;" type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>

                                @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" style="font-size:15px;" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label for="roles" class="col-md-4 col-form-label text-md-end">{{ __('Roles') }}</label>

                            <div class="col-md-6">
                                <input id="roles" type="text" class="form-control @error('roles') is-invalid @enderror" name="roles" value="{{ old('roles') }}" required autocomplete="roles" autofocus>

                                @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                    <div class="row mb-3">
                            <label for="roles" id="roles" class="col-md-4 col-form-label text-md-end">{{ __('Roles') }}</label>
                            <div class="col-md-6">
                        <div class="input-group">
                          <label for="Employee" name="emps" id="emps" value ="1">Employee</label>{{ Form::radio('P_Role', 'Employee', false, ['class' => 'radio']) }}
                          <label for="Customer" name="cust" id="cust" value="0">Customer</label>{{ Form::radio('P_Role', 'Customer', false, ['class' => 'radio']) }}
                          <label for="Administrator" name="admin" id="admin" value="1">Administrator</label>{{ Form::radio('P_Role', 'Administrator', false, ['class' => 'radio']) }}
                         </div>
                        </div>  
                    </div>


                    <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" style="font-size:15px;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" style="font-size:15px;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" style="font-size:15px;" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                      <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                            <input type="file" class="form-control" id="image" name="image" >
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                      </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="font-family: impact; font-size: 15px;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection