@extends('layouts.buddyprogram.layout')

@section('content')
<div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <table>
        <thead>
            <tr>
                <th>Jméno</th>
                <th>
                    <select name="countries" class="chosen" data-placeholder="Země" v-model="exchangeStudents.filters.countries" v-on:change="update">
                        <option value="">Všechny</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id_country }}">{{ $country->full_name }}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    School
                </th>
                <th>
                    <select name="faculties" class="chosen" data-placeholder="Fakulty" v-model="exchangeStudents.filters.faculties" v-on:change="update">
                        <option value="">Všechny</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id_faculty }}">{{ $faculty->abbreviation }}</option>
                        @endforeach
                    </select>
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="student in exchangeStudents.all()">
                <td>@{{ student.person.first_name }} @{{ student.person.last_name }}</td>
                <td>@{{ student.country.full_name }}</td>
                <td>@{{ student.school }}</td>
                <td>@{{ student.faculty.abbreviation }}</td>
            </tr>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="#" v-show="exchangeStudents.page > 1" aria-label="Previous" v-on:click="page(exchangeStudents.page - 1)">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li v-for="n in exchangeStudents.pagesCount"><a href="#" v-on:click="page(n)">@{{ n }}</a></li>
            <li>
                <a href="#" v-show="exchangeStudents.page < exchangeStudents.pagesCount" aria-label="Next" v-on:click="page(exchangeStudents.page + 1)">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
@stop

@section('scripts')
    <script src="/js/app.js"></script>
@stop