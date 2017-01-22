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
                            <div class="input-group form-group-lg">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Všechna pole</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <input type="text" class="form-control " aria-label="...">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-lg dropdown-toggle btn-primary"
                                            aria-haspopup="true" aria-expanded="false">Search</button>
                                </div>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>

            </div>


        </div>
    </div>




@stop