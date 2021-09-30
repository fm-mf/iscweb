@can('acl', 'buddy.remove')
    {{ Form::open([
        'route' => ['partak.users.buddies.exchange-students.destroy', ['buddy' => $buddy, 'exchange_student' => $exStudent]],
        'method' => 'DELETE',
        'class' => 'd-inline-block ml-1'
    ]) }}
        <protected-submit-button
            protection-title="Remove {{ $exStudent->person->first_name }}’s Buddy?"
            protection-text="Do you really want to remove Buddy ‘{{ $buddy->person->full_name }}’ from Exchange student ‘{{ $exStudent->person->full_name }}’?"
            proceed-text="Remove"
            classes="btn-danger btn-sm {{ $classes ?? '' }}"
            proceed-classes="btn-danger"
            modal-id="remove-buddy-{{ $exStudent->id_user }}"
            :form-group="false"
        >
            <i class="fas fa-times"></i> Remove
        </protected-submit-button>
    {{ Form::close() }}
@endcan
