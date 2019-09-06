@extends('layouts.buddyprogram.layout')

@section('content')
    <div class="container page">
        @if($errors->count() > 0)
            <div class="row">
                @foreach($errors->all() as $error)
                    <div class="flash col-md-12">{{$error}}</div>
                @endforeach
            </div>
        @endif
        <div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
                <div v-cloak>
                    <h4>Filtrovat studenty:</h4>
                    <div class="filter row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="countries" :show-labels="false" label="full_name" track-by="id_country" placeholder="Země"
                                v-model="filters.countries" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="faculties" :show-labels="false" label="abbreviation" track-by="id_faculty" placeholder="Fakulta"
                                v-model="filters.faculties" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="arrivals" :show-labels="false" label="formatted" track-by="date" placeholder="Příjezd"
                                v-model="filters.arrivals" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="accommodation" :show-labels="false" label="full_name" placeholder="Bydlení"
                                track-by="id_accommodation" v-model="filters.accommodation" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                    </div>
                    <div class="table-loader-container">
                    <div v-show="loading" class="table-loader">
                        <i class="fas fa-circle-notch fa-spin"></i>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th><orderable-column v-model="sortBy" v-on:input="filterChanged" field="name">Jméno</orderable-column></th>
                                <th><orderable-column v-model="sortBy" v-on:input="filterChanged" field="country">Země</orderable-column></th>
                                <th><orderable-column v-model="sortBy" v-on:input="filterChanged" field="school">Škola</orderable-column></th>
                                <th><orderable-column v-model="sortBy" v-on:input="filterChanged" field="faculty">Fakulta</orderable-column></th>
                                <th><orderable-column v-model="sortBy" v-on:input="filterChanged" field="arrival">Příjezd</orderable-column></th>
                                <th><orderable-column v-model="sortBy" v-on:input="filterChanged" field="accomodation">Bydlení</orderable-column></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="student in data">
                                <td><a href="{{url('/muj-buddy/profile/')}}" v-bind:href="'{{url('/muj-buddy/profile')}}/' + student.id_user">@{{ student.person.first_name }} @{{ student.person.last_name }}</a></td>
                                <td>@{{ student.country.full_name }}</td>
                                <td>@{{ student.school }}</td>
                                <td>@{{ student.faculty.abbreviation }}</td>
                                <td><span v-if="student.arrival">@{{ student.arrival['arrivalFormatted'] }}</span></td>
                                <td>@{{ student.accommodation.full_name }}</td>
                            </tr>
                            <tr v-if="!loading && data.length === 0" class="table-empty">
                                <td colspan="100">Nenalezen žádný student</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>

                    <nav aria-label="Page navigation" v-if="data && data.length > 0 && pagesCount > 1">
                        <ul class="pagination">
                            <li>
                                <a href="#" v-show="page > 1" aria-label="Previous" v-on:click="goToPage(page - 1)">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li v-for="n in pagesCount" v-bind:class="{active: page == n}"><a href="#" v-on:click="goToPage(n)">@{{ n }}</a></li>
                            <li>
                                <a href="#" v-show="page < pagesCount" aria-label="Next" v-on:click="goToPage(page + 1)">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
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
    <script src="{{ asset('js/echangestudentslist.js') }}"></script>
@stop

@include('footer')
