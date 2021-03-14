@extends('partak.layout.subpage')

@section('subpage')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xl-8">
                <h2 class="mb-4">Import Exchange students</h2>

                @if($errors->fileStructure->any())
                    <div class="alert alert-danger text-left">
                        <h3>Errors in the file structure</h3>
                        <ul class="mb-0">
                            @foreach($errors->fileStructure->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ Form::open([
                    'route' => 'partak.users.import.store',
                    'method' => 'POST',
                    'files' => true,
                    'id' => 'import-form',
                ]) }}

                    <div class="form-group">
                        <label for="import-file-input" class="required">File to import</label>
                        <div class="custom-file">
                            <input
                                type="file"
                                id="import-file-input"
                                name="import_file"
                                class="custom-file-input @if($errors->has('import_file')) is-invalid @endif"
                                accept=".xls,.xlsx,.ods"
                                required="required"
                            />
                            <label for="import-file-input" class="custom-file-label">Choose a file to import…</label>
                            @foreach($errors->get('import_file') as $error)
                                <div class="invalid-feedback">
                                    {{ $error }}
                                </div>
                            @endforeach
                            <small class="form-text text-muted">Select Excel or OpenDocument spreadsheet file</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="heading-row-number" class="required">Heading row number</label>
                        <input
                            type="number"
                            class="form-control @if($errors->has('heading_row_number')) is-invalid @endif"
                            name="heading_row_number"
                            id="heading-row-number"
                            min="1"
                            required="required"
                            value="{{ old('heading_row_number') }}"
                        />
                        @foreach($errors->get('heading_row_number') as $error)
                            <div class="invalid-feedback">
                                {{ $error }}
                            </div>
                        @endforeach
                        <small class="form-text text-muted">Row number of a row containing column headings</small>
                    </div>

                    <div class="form-group">
                        <label for="semester" class="required">Semester for import</label>
                        <select
                            name="semester"
                            id="semester"
                            class="custom-select @if($errors->has('semester')) is-invalid @endif"
                            required="required"
                        >
                            <option
                                value=""
                                disabled="disabled"
                                @if(old('semester') === null)
                                    selected="selected"
                                @endif
                                hidden="hidden"
                            >
                                Choose a semester for import…
                            </option>
                            @foreach($semesters as $semester)
                                <option
                                    value="{{ $semester->id_semester }}"
                                    @if($semester->id_semester == old('semester'))
                                        selected="selected"
                                    @endif
                                >
                                    {{ $semester->name }}
                                </option>
                            @endforeach
                        </select>
                        @foreach($errors->get('semester') as $error)
                            <div class="invalid-feedback">
                                {{ $error }}
                            </div>
                        @endforeach
                        <small class="form-text text-muted">
                            Choose a semester in which the students should be imported to
                        </small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submit-import">
                            <i class="fas fa-file-import"></i> Import
                        </button>

                    </div>

                {{ Form::close() }}

                @if(session('success'))
                    <div class="alert alert-success">
                        <h3>{{ __('import.success_title') }}</h3>
                        <ul>
                            <li>{{ trans_choice('import.success_info_imported', session('success')['imported']) }}</li>
                            <li>{{ trans_choice('import.success_info_in_buddy', session('success')['alreadyInBuddy']) }}</li>
                            <li>{{ trans_choice('import.success_info_in_ex_st', session('success')['alreadyInExchange']) }}</li>
                            <li>{{ trans_choice('import.success_info_not_coming', session('success')['notComing']) }}</li>
                        </ul>
                        <p>{{ trans_choice('import.success_info_total', session('success')['total']) }}</p>
                    </div>
                @endif

                @if(session('output'))
                    <div class="alert alert-info">
                        <h3>
                            <a href="#import-report" data-toggle="collapse">
                                Full report
                            </a>
                        </h3>
                        <ul id="import-report" class="collapse text-monospace">
                            @foreach(session('output')->toArray() as $lineInfo)
                                <li>
                                    <strong>{{ $lineInfo[0] }}</strong>
                                </li>
                                @if(($infoCnt = count($lineInfo)) > 1)
                                    <ul>
                                        @for($i = 1; $i < $infoCnt; $i++)
                                            <li>{{ $lineInfo[$i] }}</li>
                                        @endfor
                                    </ul>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            customFileInputHandler();
            document.getElementById('import-form').addEventListener('submit', onImportSubmit);
        });

        function customFileInputHandler(event) {
            const fileInput = document.getElementById('import-file-input');
            const label = fileInput.nextSibling;
            fileInput.addEventListener('change', onFileInputChange);
        }

        function onFileInputChange(event) {
            const label = event.target.labels[1];
            let labelText = 'Choose a file to import…';
            if (event.target.files.length === 0) {
                label.innerText = 'Choose a file to import…';
                return;
            }
            label.innerText = event.target.files[0].name;
        }

        function onImportSubmit(event) {
            const btnSubmit = document.getElementById('submit-import');
            btnSubmit.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                + ' Importing…';
            btnSubmit.disabled = true;
        }
    </script>
@endsection