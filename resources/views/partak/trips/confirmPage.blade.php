@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('removeSuccess') }}
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row-inner buddy-detail">
            <h2>&quot;{{ $trip->event->name }}&quot; participant detail</h2>
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($part->avatar()) }}">
            <h3>{{ $part->getFullName()}}</h3>
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $part->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> {{ $part->exchangeStudent->phone ?? $part->buddy->phone ?? 'No Phone' }}<br>
        </div>
    </div>
    <div class="container">
        <div class="row row-inner" id="form">
            <div class="col-md-7">
                {{ Form::model($part, ['url' => '/partak/trips/detail/'. $trip->id_trip .'/add/'. $part->id_user, 'method' => 'patch', 'id' => 'roles']) }}
                {{ Form::bsText('medical_issues', 'Medical Issues','', $part->medical_issues) }}

                {{ Form::bsSelect('diet', 'Diet', $diets, $part->diet, ['placeholder' => 'No diet'])  }}

                @foreach ($trip->questions as $question)
                    <?php $name = "custom[{$question->id_question}]"; ?>
                    <?php $data = $question->getDecodedData(); ?>

                    @switch ($question->type)
                        @case('text')
                        @case('number')
                            {{
                                Form::bsText(
                                    $name,
                                    $question->label,
                                    $question->required ? 'required' : '',
                                    null,
                                    [],
                                    $question->description
                                )
                            }}
                            @break
                        
                        @case('select')
                            <div class="form-group">
                                {{ Form::label($name, $question->label, ['class' => 'control-label ' . $question->required ? 'required' : '']) }}
                                @if ($errors->has($name))
                                    <p class="error-block alert-danger">{{ $errors->first($name) }}</p>
                                @endif
                                <p class="info-block">{{ $question->description }}</p>
                                
                                @foreach ($question->getOptions() as $option)
                                    <label class="custom-question {{ @$option->image ? 'with-image' : '' }}">
                                        @if (@$option->image)
                                            <div class="q-img">
                                                <img src="/events/{{ $option->image }}" title="{{ $option->label }}" alt="{{ $option->label }}" />
                                            </div>
                                        @endif
                                        <div class="q-input">
                                            <input type="{{ @$data->multi ? 'checkbox' : 'radio' }}" name="{{ $name }}{{ @$data->multi ? '[]' : '' }}" value="{{ $option->value }}" />
                                            {{ $option->label }}
                                        </div>
                                    </label>
                                @endforeach

                            </div>
                            @break
                    @endswitch
                @endforeach

                {{ Form::label('paid', 'Paid', ['class' => 'control-label required']) }}
                {{ Form::number('paid', $trip->price, ['class' => 'form-control']) }}

                {{ Form::bsTextarea('comment', 'Comment') }}

                {{ Form::bsSubmit('Add Participant') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
