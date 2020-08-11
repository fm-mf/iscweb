@extends('czech.layouts.layout')

@section('page')
    <section class="statistics">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Statistika Buddy Programu</h1>
                    <h2>{{ $season }} semestr {{ $schoolYear }}</h2>
                    <p>
                        V {{ $month }} {{ $currYear }} přijede studovat na ČVUT <strong>{{ $students }}</strong>
                        {{ trans_choice('stats.exchange_student', $students) }}
                        z <strong>{{ $countriesCount }}</strong> zemí.
                    </p>
                    <p>
                        <strong>{{ $studentsWithFilledProfile }}</strong> z nich již vyplnilo
                        registrační formulář do Buddy programu a projevilo tak zájem o buddíka.
                    </p>
                    <p>
                        <strong>{{ $studentsWithBuddy }}</strong>
                        {{ trans_choice('stats.exchange_student', $studentsWithBuddy) }}
                        už má svého Buddíka.
                    </p>
                    <p>
                        Ovšem, i přesto že projevili zájem, <strong>{{ $studentsWithFilledProfileWithoutBuddy }}</strong>
                        {{ trans_choice('stats.exchange_student', $studentsWithFilledProfileWithoutBuddy) }} na Buddíka stále čeká!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>Odkud k nám zahraniční studenti přijíždějí</h2>
                </div>
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <table class="table table-striped">
                        @foreach ($countriesStats as $country)
                            @if($country->exchange_student_count > 0)
                                <tr>
                                    <th>{{  $country->full_name }}</th>
                                    <td>{{ $country->exchange_student_count }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
