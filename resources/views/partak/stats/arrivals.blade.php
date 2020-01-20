@extends('partak.stats.layout')

@section('inner-content')
  <div class="arrivals">
    <p class="alert alert-info">
      <strong>{{ round(($studentsWithFilledProfile * 100) / $arrivingStudents) }} %</strong> of arriving students filled their arrival date.
      <strong>{{ $previousStudents }}</strong> exchange students are staying from previous semester.
    </p>

    <div class="row">
      <div class="col-sm-6">
        <h2>Arrival dates</h2>

        <table>
        @foreach ($arrivals as $arrival)
          <tr>
            <td class="date">{{ $arrival->getArrivalDateFormatted() }}</td>
            <td class="count">{{ $arrival->count }}</td>
            <td class="histogram">
              <div
                class="stats-bar"
                style="width: {{ ($arrival->count / $arrivalsMax) * 150 }}px"
              ></div>
            </td>
          </tr>
        @endforeach
        </table>
      </div>
      <div class="col-sm-6">
        <h2>Transportations</h2>

        <table>
        @foreach ($transports as $transport)
          <tr>
            <td class="date">{{ $transport->transportation }}</td>
            <td class="count">{{ $transport->count }}</td>
            <td class="histogram">
              <div
                class="stats-bar"
                style="width: {{ ($transport->count / $transportsMax) * 150 }}px"
              ></div>
            </td>
          </tr>
        @endforeach
        </table>
      </div>
    </div>
  </div>
@stop