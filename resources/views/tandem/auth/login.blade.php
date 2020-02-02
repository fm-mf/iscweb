@extends('tandem.layouts.layout')

@section('title', 'Login – Tandem Database')

@section('page')
    <section>
        <div class="container">
            @if(session('registrationSuccessful'))
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        <p class="alert alert-success">
                            Your registration completed successfully. You may now continue with log in.
                        </p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <h1>Login to Tandem Database</h1>
                </div>
            </div>
            @if($errors->any())
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                    <form action="{{ route('tandem.login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="required" for="input-email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="input-email" value="{{ old('email') }}" required="required" />
                        </div>
                        <div class="form-group">
                            <label class="required" for="input-password">Password</label>
                            <input type="password" class="form-control" name="password" id="input-password" required="required" />
                        </div>
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
