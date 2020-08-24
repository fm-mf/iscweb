@extends('tandem.layouts.layout')

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-11 col-xl-10 mx-auto">
                    <h1>@lang('tandem.index.heading')</h1>
                    @if($showAll)
                        <p>
                            @lang('tandem.list.all-users-info')
                            @lang('tandem.list.list-instructions')
                        </p>
                        <p>
                            <a class="btn btn-outline-primary" href="{{ route('tandem.main') }}">
                                @lang('tandem.list.show-only-potential-partners')
                            </a>
                        </p>
                        @component('tandem.components.tandem-users-list', ['tandemUsers' => $otherActiveUsers])
                        @endcomponent
                    @elseif($potentialPartners->isEmpty())
                        <p>
                            @lang('tandem.list.no-potential-partners-info-1')
                            @lang('tandem.list.all-users-info')
                            @lang('tandem.list.no-potential-partners-info-2')
                        </p>
                        @component('tandem.components.tandem-users-list', ['tandemUsers' => $otherActiveUsers])
                        @endcomponent
                    @else
                        <p>
                            @lang('tandem.list.potential-partners-info')
                            @lang('tandem.list.list-instructions')
                        </p>
                        <p>
                            <a class="btn btn-outline-primary" href="{{ route('tandem.main', ['showAll']) }}">
                                @lang('tandem.list.show-all-users')
                            </a>
                        </p>
                        @component('tandem.components.tandem-users-list', ['tandemUsers' => $potentialPartners])
                        @endcomponent
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
