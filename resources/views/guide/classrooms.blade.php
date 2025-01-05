@extends('guide.layouts.subpage')

@section('title', 'Classrooms location')

{{-- Source of the information: https://help.fit.cvut.cz/rooms/index.html --}}

@section('subpage')
    <h2>Classrooms location</h2>
    <p>
        At CTU there is a common pattern for room names as shown in the example below.
    </p>
    <figure class="figure w-100">
        <figcaption class="figure-caption">Room number example</figcaption>
        <img src="/img/guide/rooms-kos.svg" class="figure-img w-50" alt="Room number example" />
        <ol>
            <li>Building code (see the <a href="#tbl-buildings">Table of the building codes</a> below)</li>
            <li>Block within the building (if the building is divided into blocks)</li>
            <li>
                Room number
                <ul>
                    <li>the first digit (or the first two digits) represents the floor in the building</li>
                    <li>prefix ‘s’ means the room is in the basement</li>
                </ul>
            </li>
        </ol>
    </figure>

    <figure class="figure" id="tbl-buildings">
        <figcaption class="figure-caption">Table of the building codes</figcaption>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="align-middle" scope="col">Building code</th>
                <th class="align-middle" scope="col">Description</th>
                <th class="align-middle" scope="col">Address</th>
            </tr>
            </thead>
            <tbody>
            @foreach($buildings as $building)
                <tr>
                    <th class="align-middle" scope="row">{{ $building['code'] }}</th>
                    <td class="align-middle">{{ $building['description'] }}</td>
                    <td class="align-middle user-select-all">{{ $building['address'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </figure>

    <p>
        <strong>Faculty of Nuclear Sciences and Physical Engineering (FJFI / FNSPE)</strong>
        has rooms in several buildings around Prague. For information about its rooms location see the
        <a href="https://rozvrh.fjfi.cvut.cz/buildingsEN" target="_blank" rel="noopener">faculty website</a>.
    </p>

@endsection
