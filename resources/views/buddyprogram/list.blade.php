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
                    <div class="filter form-row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="countries" :show-labels="false" label="full_name" track-by="id_country" placeholder="@lang('buddy-program.country')"
                                v-model="filters.countries" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="faculties" :show-labels="false" label="abbreviation" track-by="id_faculty" placeholder="@lang('buddy-program.faculty')"
                                v-model="filters.faculties" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="arrivals" :show-labels="false" label="formatted" track-by="date" placeholder="@lang('buddy-program.arrival')"
                                v-model="filters.arrivals" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <multiselect :options="accommodation" :show-labels="false" label="full_name" placeholder="@lang('buddy-program.accommodation')"
                                track-by="id_accommodation" v-model="filters.accommodation" :multiple="true" v-on:input="filterChanged"></multiselect>
                        </div>
                    </div>
                    <div class="table-loader-container">
                    <div v-show="loading" class="table-loader">
                        <i class="fas fa-circle-notch fa-spin"></i>
                    </div>

                    <div class="list-table">
                        <div class="div-tr div-header">
                            <div class="div-cell name">
                                <orderable-column v-model="sortBy" v-on:input="filterChanged" field="name">@lang('buddy-program.student-name')</orderable-column>
                            </div>
                            <div class="div-cell country">
                                <orderable-column v-model="sortBy" v-on:input="filterChanged" field="country">@lang('buddy-program.country')</orderable-column>
                            </div>
                            <div class="div-cell school">
                                <orderable-column v-model="sortBy" v-on:input="filterChanged" field="school">@lang('buddy-program.school')</orderable-column>
                            </div>
                            <div class="div-cell faculty">
                                <orderable-column v-model="sortBy" v-on:input="filterChanged" field="faculty">@lang('buddy-program.faculty')</orderable-column>
                            </div>
                            <div class="div-cell arrival">
                                <orderable-column v-model="sortBy" v-on:input="filterChanged" field="arrival">@lang('buddy-program.arrival')</orderable-column>
                            </div>
                            <div class="div-cell accommodation">
                                <orderable-column v-model="sortBy" v-on:input="filterChanged" field="accommodation">@lang('buddy-program.accommodation')</orderable-column>
                            </div>
                        </div>
                        <div class="div-body">
                            <div class="div-tr" v-for="student in data">
                                <div class="div-cell name">
                                    <a href="" v-bind:href="'{{ url('/muj-buddy/profile') }}/' + student.id">
                                        @{{ student.first_name }}
                                        <span class="last-name">@{{ student.last_name }}</span>
                                    </a>
                                </div>
                                <div class="div-cell country">
                                    <span class="country-flag">@{{ getFlagEmoji(student.country) }}</span>
                                    @{{ student.country }}
                                </div>
                                <div class="div-cell school">@{{ student.school }}</div>
                                <div class="div-cell faculty">@{{ student.faculty }}</div>
                                <div class="div-cell arrival">
                                    <span v-if="student.arrival">@{{ student.arrival}}</span>
                                    <span v-else>@lang('buddy-program.arrival-not-filled')</span>
                                </div>
                                <div class="div-cell accommodation">@{{ student.accommodation }}</div>
                            </div>
                            <div class="div-tr table-empty" v-if="!loading && data.length === 0">
                                <div class="div-cell">@lang('buddy-program.no-student-found')</div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <nav aria-label="Page navigation" v-if="data && data.length > 0 && pagesCount > 1">
                        <ul class="pagination">
                            <li v-if="page > 1">
                                <a href="#" aria-label="@lang('buddy-program.previous')" v-on:click="goToPage(page - 1)">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                            <li v-for="n in pagesCount" v-bind:class="{active: page === n}"><a href="#" v-on:click="goToPage(n)">@{{ n }}</a></li>
                            <li v-if="page < pagesCount">
                                <a href="#" v-show="page < pagesCount" aria-label="@lang('buddy-program.next')" v-on:click="goToPage(page + 1)">
                                    <span aria-hidden="true">»</span>
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
    <script src="{{ mix('js/exchange-students-list.js') }}"></script>
@stop

@include('footer')
