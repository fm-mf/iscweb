@if ($readonly)
    @foreach($trip->answers($id_user) as $data)
        {{ Form::bsText("void[{$data->id_question}]", $data->question->label, '', $data->getDisplayValue(), ['readonly' => '']) }}
    @endforeach
@else
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
                    {{ Form::label($name, $question->label, ['class' => $question->required ? 'required' : '']) }}
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
@endif
