@extends('partak.stats.layout')

@section('inner-content')
  <div class="stats-filter">
    {!! Form::open(['action' => 'Partak\StatsController@index', 'method' => 'get']) !!}
    <div class="form-group">
      {{ Form::bsSelect('semester', 'Semester', $semesters, $semester, ['onchange' => 'this.form.submit()']) }}
    </div>
    {!! Form::close() !!}
  </div>

  <div class="stats clearfix">
    <div class="stat">
      <div class="s-label">Total buddies</div>
      <div class="s-value">{{ count($buddiesCounts) }}</div>
      <div class="s-note">buddies with >0 students this semester</div>
    </div>

    <div class="stat">
      <div class="s-label">Most students per buddy</div>
      <div class="s-value">{{ $buddiesCounts[0]->exchange_students_count }}</div>
      <div class="s-note">{{ $buddiesCounts[0]->person->last_name }}, {{ $buddiesCounts[0]->person->first_name }}</div>
    </div>

    <div class="stat">
      <div class="s-label">Avg students per buddy</div>
      <div class="s-value">{{ round($avgBuddiesPerBuddy*10)/10 }}</div>
      <div class="s-note"></div>
    </div>
  </div>

  <div class="stats clearfix">
    <div class="stat">
      <div class="s-label">Arriving students</div>
      <div class="s-value">{{ $arrivingStudents }}</div>
    </div>

    <div class="stat">
      <div class="s-label">Students with a buddy</div>
      <div class="s-value">{{ $studentsWithBuddy }}</div>
      <div class="s-note">{{ round(($studentsWithBuddy * 100) / $studentsWithFilledProfile) }} % of students with filled profile</div>
    </div>

    <div class="stat">
      <div class="s-label">Students with filled profile</div>
      <div class="s-value">{{ $studentsWithFilledProfile }}</div>
      <div class="s-note">{{ round(($studentsWithFilledProfile * 100) / $arrivingStudents) }} % of arriving students</div>
    </div>

  </div>

  <div class="stats clearfix">
    <div class="stat">
      <div class="s-label">Students from previous semester</div>
      <div class="s-value">{{ $studentsFromPreviousSemester }}</div>
      <div class="s-note">staying here for more than one semester</div>
    </div>

    <div class="stat">
      <div class="s-label">Buddies active in last 6 months</div>
      <div class="s-value">{{ $activeBuddies }}</div>
      <div class="s-note">by last login time</div>
    </div>
  </div>
@stop