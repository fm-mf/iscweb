@extends('web.voting.layout')
@section('content')
    <h2>Results</h2>

    <h3>Best Show</h3>
        <ul>
        <?php $i = 1 ?>
        @foreach($bestShowCountries as $votes)
            <li><strong>{{ $i }}. </strong>
                @foreach($votes as $country)
                    @if ($country->full_name)
                        {{ $country->full_name }} ( {{$country->total}} )
                    @else
                        None ( {{ $country->total }} )
                    @endif
                @endforeach
            </li>
            <?php $i++ ?>
        @endforeach
        </ul>

    <h3>Best Food</h3>
    <ul>
        <?php $i = 1 ?>
        @foreach($bestFoodCountries as $votes)
            <li><strong>{{ $i }}. </strong>
                @foreach($votes as $country)
                    @if ($country->full_name)
                        {{ $country->full_name }} ( {{$country->total}} )
                    @else
                        None ( {{ $country->total }} )
                    @endif
                @endforeach
            </li>
            <?php $i++ ?>
        @endforeach
        </ul>
@stop