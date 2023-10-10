<div class="row">
    <div class="col-sm-8">
        {{ Form::bsText('name', 'Name', 'required', $product->name) }}
    </div>

    <div class="col-sm-8">
        {{ Form::bsNumber('price', 'Price', 'required', $product->price, ['min' => 0]) }}
    </div>

    <div class="col-sm-9">
        {{ Form::bsFile('image', 'Image', $product->id_product ? '' : 'required', ['accept' => 'image/jpeg, image/png']) }}
    </div>

    <div class="col-sm-3 d-flex justify-content-center align-items-center">
        <img id="product-preview" class="image-preview" src="{{ $product->image_url }}" data-src="{{ $product->image_url }}" style="display: {{ $product->hasImage() ? 'block' : 'none' }};" alt="" />
    </div>
</div>

{{ Form::bsTextarea('description', 'Description', 'required', null, ['class' => 'form-control wysiwyg-editor']) }}

<div class="col-sm-8">
    <input type="hidden" name="sold_out" value="0" />
    {{ Form::bsCheckbox('sold_out', 'Sold out', null, true) }}
</div>

@section('scripts')
    @parent

    <script src="{{ mix('/js/text-editor.js') }}" defer="defer"></script>
    <script>
        function handleImageChange(event) {
            const coverPreview = document.getElementById('product-preview');
            if (event.target.files.length === 0) {
                coverPreview.src = coverPreview.getAttribute('data-src');
                if (coverPreview.src === '') {
                    coverPreview.style.display = 'none';
                }
                return;
            }
            const fileReader = new FileReader();
            fileReader.onload = function (event) {
                coverPreview.src = event.target.result;
                coverPreview.style.display = 'block';
            }
            fileReader.readAsDataURL(event.target.files[0]);
        }

        window.addEventListener('DOMContentLoaded', function (event) {
            document.getElementById('image').addEventListener('change', handleImageChange);
        });
    </script>
@stop
