@extends('layouts.buddyprogram.layout')

@section('content')
    <div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
        <div v-cloak>
        <table>
            <thead>
            <tr>
                <th>Jméno</th>
                <th>
                    <multiselect :options="countries" :show-labels="false" label="full_name" track-by="id_country" placeholder="Země"
                                 v-model="exchangeStudents.filters.countries" :multiple="true" v-on:input="update"></multiselect>
                </th>
                <th>
                    Škola
                </th>
                <th>
                    <multiselect :options="faculties" :show-labels="false" label="abbreviation" track-by="id_faculty" placeholder="Fakulta"
                                 v-model="exchangeStudents.filters.faculties" :multiple="true" v-on:input="update"></multiselect>

                </th>
                <th>
                    <!--<multiselect :options="arrivals" :show-labels="false" v-model="exchangeStudents.filters.arrivals" placeholder="Příjezd"
                                 :multiple="true" v-on:input="update"></multiselect>-->
                    Příjezd

                </th>
                <th>
                    <multiselect :options="accommodation" :show-labels="false" label="full_name" placeholder="Bydlení"
                                 track-by="id_accommodation" v-model="exchangeStudents.filters.accommodation" :multiple="true" v-on:input="update"></multiselect>

                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in exchangeStudents.all()">
                <td><a href="{{url('/muj-buddy/profile/')}}" v-bind:href="'{{url('/muj-buddy/profile')}}/' + student.id_user">@{{ student.person.first_name }} @{{ student.person.last_name }}</a></td>
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
                <li v-for="n in exchangeStudents.pagesCount" v-bind:class="{active: exchangeStudents.page == n}"><a href="#" v-on:click="page(n)">@{{ n }}</a></li>
                <li>
                    <a href="#" v-show="exchangeStudents.page < exchangeStudents.pagesCount" aria-label="Next" v-on:click="page(exchangeStudents.page + 1)">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </div>
@stop

@section('stylesheets')
    @parent
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
@stop

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/vue.multiselect/2.0/vue-multiselect.min.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
@stop

@include('footer')