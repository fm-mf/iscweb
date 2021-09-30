{{ Form::open(['route' => ['partak.users.buddies.approval.update', ['buddy' => $buddy]], 'method' => 'PATCH', 'class' => 'd-inline-block']) }}
    <input type="hidden" name="verified" value="y" />
    <protected-submit-button
        protection-title="Buddy approval"
        protection-text="Are you sure you wan to approve Buddy ‘{{ $buddy->person->full_name }}’?"
        proceed-text="Approve"
        classes="btn-success btn-sm {{ $classes ?? '' }}"
        proceed-classes="btn-success"
        modal-id="approve-buddy-{{ $buddy->id_user }}"
        :form-group="false"
    >
        <i class="fas fa-check"></i> Approve
    </protected-submit-button>
{{ Form::close() }}

{{ Form::open(['route' => ['partak.users.buddies.approval.update', ['buddy' => $buddy]], 'method' => 'PATCH', 'class' => 'd-inline-block']) }}
    <input type="hidden" name="verified" value="d" />
    <protected-submit-button
        protection-title="Buddy denial"
        protection-text="Are you sure you wan to deny Buddy ‘{{ $buddy->person->full_name }}’?"
        proceed-text="Deny"
        classes="btn-danger btn-sm {{ $classes ?? '' }}"
        proceed-classes="btn-danger"
        modal-id="deny-buddy-{{ $buddy->id_user }}"
        :form-group="false"
    >
        <i class="fas fa-times"></i> Deny
    </protected-submit-button>
{{ Form::close() }}
