@extends('web.layouts.layout')
@section('page')
<div class="statistics">
    <h1>Statistika Buddy Programu</h1>
    <h2>Letní semestr 2019/2020</h2>
    <p>V únoru 2019 přijede studovat na ČVUT <strong>{{ $students }}</strong> {{ trans_choice('stats.exchange_student', $students) }} z <strong>{{ $countriesCount }}</strong> zemí.</p>
    <p><strong>{{  $studentsWithFilledProfile }}</strong> z nich již vyplnilo registrační formulář do Buddy programu a projevilo tak zájem o buddíka.</p>
    <p><strong>{{ $studentsWithBuddy }}</strong> {{ trans_choice('stats.exchange_student', $studentsWithBuddy) }} už má svého Buddíka.</p>
    <p>Ovšem, i přesto že projevili zájem, <strong>{{ $studentsWithFilledProfileWithoutBuddy }}</strong> {{ trans_choice('stats.exchange_student', $studentsWithFilledProfileWithoutBuddy) }} na Buddíka stále čeká!</p>
</div>


<h2 style="text-align: center; margin-bottom:25px;">Odkud k nám zahraniční studenti přijíždějí</h2>

<div class="container" style="margin: auto; width: 33%;">
    <table class="table table-striped">
        @foreach ($countriesStats as $country)
            @if($country->exchange_student_count > 0)
            <tr>
                <td>{{  $country->full_name }}</td>
                <td>{{ $country->exchange_student_count }}</td>
            </tr>
            @endif
        @endforeach
    </table>
</div>
@stop
