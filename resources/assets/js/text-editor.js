var editor_config = {
  path_absolute: "{{ URL::asset('/') }}/",
  selector: 'textarea',
  plugins: [
    'advlist autolink lists link',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime table contextmenu directionality',
    'paste textpattern'
  ],
  toolbar:
    'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
};

// eslint-disable-next-line no-undef
tinymce.init(editor_config);
