@extends('partak.stats.layout')

@section('inner-content')
  <div class="buddies">
    <table class="table table-bordered">
      @foreach ($buddies as $buddy)
      <tr>
        <td>
          <a href="{{ url("/partak/users/buddies/{$buddy->id_user}") }}">{{ $buddy->person->last_name }}, {{ $buddy->person->first_name }}</a>
        </td>
        <td>{{ $buddy->exchange_students_count }}</td>
      </tr>
      @endforeach
    </table>
  </div>
@stop