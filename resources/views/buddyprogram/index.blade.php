@extends('layouts.buddyprogram.layout')

@section('content')
<div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <table>
        <thead>
            <tr>
                <th>Jméno</th>
                <th>
                    <multiselect :options="countries" :show-labels="false" label="full_name" track-by="id_country" v-model="exchangeStudents.filters.countries" :multiple="true" v-on:input="update"></multiselect>
                </th>
                <th>
                    Skola
                </th>
                <th>
                    <multiselect :options="faculties" :show-labels="false" label="abbreviation" track-by="id_faculty" v-model="exchangeStudents.filters.faculties" :multiple="true" v-on:input="update"></multiselect>

                </th>
                <th>
                    <multiselect :options="arrivals" :show-labels="false" v-model="exchangeStudents.filters.arrivals" :multiple="true" v-on:input="update"></multiselect>

                </th>
                <th>
                    <select name="accommodation" class="chosen" data-placeholder="Koleje" v-model="exchangeStudents.filters.accommodation" v-on:change="update">
                        <option value="">Všechny</option>
                        @foreach($accommodations as $accommodation)
                            <option value="{{ $accommodation->id_accommodation }}">{{ $accommodation->full_name }}</option>
                        @endforeach
                    </select>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="student in exchangeStudents.all()">
                <td>@{{ student.person.first_name }} @{{ student.person.last_name }}</td>
                <td>@{{ student.country.full_name }}</td>
                <td>@{{ student.school }}</td>
                <td>@{{ student.faculty.abbreviation }}</td>
                <td><span v-if="student.arrival">@{{ student.arrival['arrival'] }}</span></td>
                <td>@{{ student.accommodation.full_name }}</td>

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
    @parent
    <script src="https://cdn.jsdelivr.net/vue.multiselect/2.0/vue-multiselect.min.js"></script>
    <script src="/js/app.js"></script>
@stop

@include('footer')