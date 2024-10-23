<?php $buddy = $user->buddy ?>
<?php $exStudent = $user->exchangeStudent ?? $user->degreeStudent ?>

@if(!isset($noTitle) || !$noTitle)
@if(isset($buddyStudent))
    <div class="text-muted">His/Her buddy</div>
@endif
<div class="d-flex align-items-center mb-2">
    <h3 class="mb-0">{{ $user->person->first_name }} <span class="last-name">{{ $user->person->last_name }}</span></h3>
    @if(!isset($edit) || $edit)
        @if($buddy)
        @can('acl', 'buddy.edit')
            <a
                href="{{ route('partak.users.buddies.edit', ['buddy' => $buddy]) }}"
                class="btn btn-sm btn-success ml-4"
            >
                <i class="fas fa-pen"></i> Edit
            </a>
        @endcan
        @elseif($exStudent)
            @can('acl', 'exchangeStudents.edit')
                <a
                    href="{{ url('partak/users/exchange-students/edit/' . $user->id_user) }}"
                    class="btn btn-sm btn-success ml-3"
                >
                    <i class="fas fa-pen"></i> Edit
                </a>

                {{ Form::open(['url' => 'partak/users/exchange-students/promote/'. $exStudent->id_user, 'method' => 'post']) }}
                <protected-submit-button
                    url="{{ url('partak/users/exchange-students/promote/' . $user->id_user) }}"
                    protection-title="Promote exchange student"
                    protection-text="Are you sure you want to promote {{ $user->person->getFullName() }} to be a Buddy?"
                    classes="btn btn-sm btn-info ml-3"
                    modal-id="protectionModalPromoteToBuddy"
                    :form-group="false"
                >
                    <i class="fas fa-user-astronaut"></i> Promote to Buddy
                </protected-submit-button>
                {{ Form::close() }}
            @endcan
        @endif
    @else
        @if($buddy)
        @can('acl', 'buddy.view')
            <a
                href="{{ route('partak.users.buddies.show', ['buddy' => $user->id_user]) }}"
                class="btn btn-sm btn-primary ml-4"
            >
                <i class="fas fa-address-card"></i> Detail
            </a>
        @endcan
        @elseif($exStudent)
            @can('acl', 'exchangeStudents.view')
                <a
                    href="{{ url('partak/users/exchange-students/' . $user->id_user) }}"
                    class="btn btn-sm btn-primary ml-3"
                >
                    <i class="fas fa-address-card"></i> Detail
                </a>
            @endcan
        @endif
    @endif
</div>
@endif

<div class="row container mb-0">
    <div class="col-2-sm">
        <img class="rounded-circle" width="125" src="{{ asset($user->person->avatar()) }}">
    </div>
    <div class="col-10-sm pl-4">
        <?php
            $country = $buddy
                ? $buddy->country
                : ($exStudent
                    ? $exStudent->country
                    : null)
        ?>

        @if(isset($noTitle) && $noTitle)
        <div class="info-line">
            <h4>{{ $user->person->first_name }} <span class="last-name">{{ $user->person->last_name }}</span></h4>
        </div>
        @endif

        @if(isset($buddy) && $buddy->degree_buddy)
            <span class="badge badge-secondary">Degree buddy</span>
        @endif

        @if(isset($exStudent) && $exStudent->degree_student)
            <span class="badge badge-secondary">Degree student</span>
        @endif

        @if($country)
        <div class="info-line">
            <i class="fas fa-globe-europe fa-fw mr-1"></i> {{ $country->full_name }}
        </div>
        @endif
        <div class="info-line">
            <i class="fas fa-envelope fa-fw mr-1"></i> {{ $user->email }}
        </div>
        <div class="info-line">
            <i class="fas fa-phone fa-fw mr-1"></i>
            @if(isset($buddy->phone))
                {{ $buddy->phone }}
            @elseif(isset($exStudent->phone))
                {{ $exStudent->phone }}
            @else
                No Phone
            @endif
        </div>

        @if($exStudent)
            <div class="info-line">
                <i class="fab fa-whatsapp fa-fw mr-1 user-detail-icon"></i> {{ $exStudent->whatsapp ?? 'No WhatsApp' }}
            </div>
            <div class="info-line">
                <i class="fab fa-facebook fa-fw mr-1 user-detail-icon"></i> @if($exStudent->facebook)
                    <a href="{{ $exStudent->facebook }}"  target="_blank">{{ $exStudent->facebook_trimmed }}</a>
                @else
                    No Facebook
                @endif
            </div>
            <div class="info-line">
                <i class="fab fa-instagram fa-fw mr-1 user-detail-icon"></i> @if($exStudent->instagram)
                    <a href="{{ $exStudent->instagram_link }}" target="_blank">{{ "@$exStudent->instagram" }}</a>
                @else
                    No Instagram
                @endif
            </div>
            <div class="info-line">
                <i class="fas fa-university fa-fw mr-1 user-detail-icon"></i>
                @for ($i = 0; $i < count($exStudent->semesters); $i++)
                    @php
                            $sem = $exStudent->semesters[$i]->semester;
                            $semester = ucfirst(substr($sem, 0, -4)) . " " . substr($sem, -4);
                    @endphp
                    {{
                        $i === count($exStudent->semesters) - 1
                            ? $semester
                            : $semester . ", "
                    }}
                @endfor
            </div>
            <div class="info-line">
                @if($exStudent->esn_registered === 'y')
                <i class="fas fa-check fa-fw mr-1" style="color: #449D44"></i> ESN Registered
                @else
                <i class="fas fa-times fa-fw mr-1" style="color: #C9302C"></i> Not ESN Registered
                @endif
            </div>
        @endif

        @if($buddy)
            <div class="info-line">
                <i class="fas fa-fw fa-user-clock mr-1"></i> <span title="{{ $buddy->registered_on }}">{{ $buddy->registered_ago }}</span>
            </div>
            <div class="info-line">
                @if($buddy->verified == 'y')
                    <i class="fas fa-check fa-fw mr-1" style="color: #449D44"></i> Verified
                @elseif ($buddy->verified == 'n')
                    <i class="fas fa-hourglass-half fa-fw mr-1"></i> Not verified yet
                @else
                    <i class="fas fa-times fa-fw mr-1"></i> Denied
                @endif
            </div>
        @endif

        @if(isset($buddyStudent))
            @include('partak.users.partials._remove-buddy-button', ['exStudent' => $buddyStudent, 'classes' => 'mt-2'])
        @endif
    </div>
</div>
