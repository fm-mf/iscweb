@extends('layouts.buddyprogram.layout')
@section('content')

    <div class="container page">
        <h1 class="text-center">@lang('buddy-program.my-students')</h1>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>@lang('buddy-program.student-name')</th>
                    <th>@lang('buddy-program.nationality')</th>
                    <th>@lang('buddy-program.faculty')</th>
                    <th>@lang('buddy-program.dormitory')</th>
                    <th>@lang('buddy-program.sex')</th>
                </tr>
                </thead>
                <tbody>
                @if($myStudents)
                    @foreach($myStudents as $exchangeStudent)
                        <tr>
                            <td>
                                <a href="{{ route('buddy-profile', ['exchangeStudent' => $exchangeStudent->hash_id]) }}">
                                    {{ $exchangeStudent->person->first_name }}
                                    <span class="last-name">{{ $exchangeStudent->person->last_name }}</span>
                                </a>
                            </td>
                            <td>{{ $exchangeStudent->country->full_name }}</td>
                            <td>{{ $exchangeStudent->faculty->faculty }}</td>
                            <td>{{ $exchangeStudent->accommodation->full_name }}</td>
                            <td>
                                @if($exchangeStudent->person->sex === 'M')
                                    @lang('buddy-program.sex-m')
                                @elseif($exchangeStudent->person->sex === 'F')
                                    @lang('buddy-program.sex-f')
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>
@stop
