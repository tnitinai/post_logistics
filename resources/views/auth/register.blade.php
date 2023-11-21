@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img style="max-height: 100vh" src="{{asset('img/postman1.jpeg')}}" />
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="id" placeholder="{{ __('หมายเลขพนักงาน') }}" value="{{ old('id') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="fname" placeholder="{{ __('Name') }}" value="{{ old('fname') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="lname" placeholder="{{ __('Last Name') }}" value="{{ old('lname') }}" required>
                                    </div>

                                    <div class="form-group">
                                        {{-- <input type="text" class="form-control form-control-user" name="role_id" placeholder="{{ __('หน้าที่') }}" value="{{ old('role_id') }}" required> --}}
                                        <label for="role_id" class="form-label">หน้าที่</label>
                                        <select class="form-control" id="role_id" name='role_id' required>
                                            <option>-------------</option>
                                            @foreach ($roles as $role)
                                                <option value={{ $role->role_id }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="post_office_id" class="form-label">สถานที่ทำงาน</label>
                                        <select class="form-control" id="post_office_id" name='post_office_id' required>
                                            <option>-------------</option>
                                            @foreach ($postalCodes as $postalCode)
                                                <option value={{ $postalCode->postal_code }}>{{ $postalCode->postal_location }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">
                                        {{ __('Already have an account? Login!') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
