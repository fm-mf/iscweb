@extends('tandem.layouts.layout')

@section('page')
    <section>
        <div class="container">
            @if(session('logoutSuccessful'))
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        <p class="alert alert-success">
                            @lang('tandem.auth.logout-successful')
                        </p>
                    </div>
                </div>
            @endif
            @if(session('accountDeleteSuccessful'))
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                        <p class="alert alert-success">
                            @lang('tandem.my-profile.delete-successful')
                        </p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <h1>@lang('tandem.index.heading')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-11 col-sm-9 col-md-8 col-xl-7 mx-auto">
                    <p>@lang('tandem.index.desc-p1')</p>
                    <p>@lang('tandem.index.desc-p2')</p>
                    <p>@lang('tandem.index.desc-p3')</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto mx-auto">
                    @guest('tandem')
                        <div class="form-group">
                            <p class="text-uppercase">@lang('tandem.index.already-registered')</p>
                            <a class="btn btn-primary" href="{{ route('tandem.login') }}">
                                <span class="fas fa-sign-in-alt"></span> @lang('tandem.index.log-in')
                            </a>
                        </div>
                        <div class="form-group">
                            <p class="text-uppercase">@lang('tandem.index.new-here')</p>
                            <a class="btn btn-primary" href="{{ route('tandem.register') }}">
                                <span class="fas fa-user-plus"></span> @lang('tandem.index.register')
                            </a>
                        </div>
                    @else
                        <div class="form-group">
                            <p class="text-uppercase">
                                @lang('tandem.index.already-logged-in')
                            </p>
                            <a class="btn btn-primary" href="{{ route('tandem.main') }}">
                                @lang('tandem.index.continue')
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto mx-auto">
                    <p>@lang('tandem.index.any-questions-contact-us')</p>
                    <p>
                        <strong>
                            <span class="fas fa-envelope"></span> @lang('tandem.auth.e-mail'):
                        </strong>
                        <a href="mailto:languages@esn.cvut.cz">languages@esn.cvut.cz</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
