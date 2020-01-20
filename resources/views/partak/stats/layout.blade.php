@extends('partak.layout.main')
@section('page')
    @include('partak.layout.menu')

    <div id="stats-app">
        <partak-stats current-semester="{{ $semester }}"></partak-stats>
    </div>
@stop

@section('scripts')
    @parent
    <script src="{{ mix('js/partak-stats.js') }}"></script>
@stop

{{--
@extends('partak.layout.subpage')

@section('content')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu matched-cols">
                <a href="{{ @route('partak.stats.index') }}">Numbers</a>
                <a href="{{ @route('partak.stats.arrivals') }}">Arrivals</a>
                <a href="{{ @route('partak.stats.buddies') }}">Buddies</a>
            </div>
            <div class="col-sm-9 no-padding matched-cols">
                <div class="inner-content" id="protected">
                    @yield('inner-content')
                </div>
            </div>
        </div>
    </div>
@stop
--}}