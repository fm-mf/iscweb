@extends('partak.layout.subpage')

@section('content')

    <div class="container content">
        <div class="row">
            <div class="col-sm-3">
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
            <div class="col-sm-9">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="row" id="search">
                                <autocomplete url="{{ url('api/autocomplete/exchange-students') }}"
                                              :fields="[{title: 'Name', columns: ['person.first_name']}, {title: 'Email', columns: ['person.user.email']}]"
                                              :topline="['person.first_name', 'person.last_name']"
                                              :subline="['person.user.email']"
                                >
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-lg dropdown-toggle btn-primary"
                                                aria-haspopup="true" aria-expanded="false">Search</button>
                                    </div>
                                </autocomplete>
                            </div>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>

            </div>


        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script src="{{asset('js/search.js')}}"></script>
    @stop