<div class="form-group">
{{ Form::button((isset($icon) && $icon ? "<i class='fas fa-${icon} mr-1'></i> " : '') . $text, ['class' => 'btn btn-primary btn-submit', 'type' => 'submit']) }}
</div>