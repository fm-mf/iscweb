@extends('partak.layout.subpage')

@section('subpage')
@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-xl-7">
                <h2 class="mb-4">Generate ESNcard labels</h2>
                {{ Form::open(['route' => 'partak.esn-card-labels.store', 'files' => true, 'id' => 'esn_card_labels_form']) }}
                    <div class="form-group">
                        @php
                            $isInvalid = $errors->has('list_of_students') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::label('list_of_students', 'Excel file with list of students', ['class' => 'required']) }}
                        <div class="custom-file">
                            {{ Form::file('list_of_students', ['required' => 'required', 'class' => 'custom-file-input' . $isInvalid, 'accept' => '.xls,.xlsx,.ods']) }}
                            {{ Form::label('list_of_students', 'Select a file with list of students…', ['class' => 'custom-file-label']) }}
                            @error('list_of_students')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Select Excel or OpenDocument spreadsheet file</small>
                        </div>
                    </div>
                    <div class="form-group">
                        @php
                            $isInvalid = $errors->has('heading_row_number') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::label('heading_row_number', 'Heading row number', ['class' => 'required']) }}
                        {{ Form::number('heading_row_number', 2, ['required' => 'required', 'class' => 'form-control' . $isInvalid, 'min' => 1]) }}
                        @error('heading_row_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Row number of a row containing column headings</small>
                    </div>
                    <div class="form-group">
                        @php
                            $isInvalid = $errors->has('university_name') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::label('university_name', 'University name', ['class' => 'required']) }}
                        {{ Form::text('university_name', 'Czech Technical University in Prague', ['required' => 'required', 'class' => 'form-control' . $isInvalid]) }}
                        @error('university_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        @php
                            $isInvalid = $errors->has('section_name') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::label('section_name', 'Section name', ['class' => 'required']) }}
                        {{ Form::text('section_name', 'ESN CTU in Prague', ['required' => 'required', 'class' => 'form-control' . $isInvalid]) }}
                        @error('section_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        @php
                            $isInvalid = $errors->has('valid_from') ? ' is-invalid' : '';
                        @endphp
                        {{ Form::label('valid_from', 'ESNcard valid from', ['class' => 'required']) }}
                        {{ Form::date('valid_from', Settings::welcomePacksFrom()->toDateString(), ['required' => 'required', 'class' => 'form-control' . $isInvalid]) }}
                        @error('valid_from')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::button('Generate ESNcard labels', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submit_generate']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            document.getElementById('list_of_students')
                .addEventListener('change', onFileInputChange)
            document.getElementById('esn_card_labels_form')
                .addEventListener('submit', onImportSubmit);
        });

        function onFileInputChange(event) {
            const label = event.target.labels[1];
            if (event.target.files.length === 0) {
                label.innerText = 'Select a file with list of students…';
                return;
            }
            label.innerText = event.target.files[0].name;
        }

        function onImportSubmit(event) {
            const btnSubmit = document.getElementById('submit_generate');
            btnSubmit.disabled = true;
            btnSubmit.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                + ' Generating…';
        }
    </script>
@endsection
