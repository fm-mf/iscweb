<?php $buddy = $user->buddy ?>
<?php $exStudent = $user->exchangeStudent ?>

<div class="d-flex align-items-center mb-2">
    <h2 class="mb-0">{{ $user->person->first_name }} <span class="last-name">{{ $user->person->last_name }}</span></h2>
    @if($buddy)<span class="badge badge-info ml-2">Buddy</span>@endif
    @if($exStudent)<span class="badge badge-success ml-2">Exchange student</span>@endif
    @if($buddy)
    @can('acl', 'buddy.edit')
        <a
            href="{{ url('partak/users/buddies/edit/' . $user->id_user) }}"
            class="btn btn-xs btn-success ml-4"
        >
            <i class="fas fa-pen"></i> Edit
        </a>
    @endcan
    @elseif($exStudent)
        @can('acl', 'exchangeStudents.edit')
            <a
                href="{{ url('partak/users/exchange-students/edit/' . $user->id_user) }}"
                class="btn btn-xs btn-success ml-4"
            >
                <i class="fas fa-pen"></i> Edit
            </a>
        @endcan
    @endif
</div>

<div class="row container mb-0">
    <div class="col-2-sm">
        <img class="img-circle" width="125" src="{{ asset($user->person->avatar()) }}">
    </div>
    <div class="col-10-sm pl-4">
        <?php
            $country = $buddy
                ? $buddy->country
                : ($exStudent
                    ? $exStudent->country
                    : null)
        ?>

        @if($country)
        <div class="info-line">
            <i class="fas fa-globe fa-fw mr-1"></i> {{ $country->full_name }}
        </div>
        @endif
        <div class="info-line">
            <i class="fas fa-envelope fa-fw mr-1"></i> {{ $user->email }}
        </div>
        <div class="info-line">
            <i class="fas fa-phone fa-fw mr-1"></i> @if(isset($buddy->phone)) {{ $buddy->phone }} @else No Phone @endif
        </div>

        @if($exStudent)
            <div class="info-line">
                <i class="fab fa-whatsapp fa-fw mr-1 user-detail-icon"></i> {{ $exStudent->whatsapp ?? 'No WhatsApp' }}
            </div>
            <div class="info-line">
                <i class="fab fa-facebook fa-fw mr-1 user-detail-icon"></i> {{ $exStudent->facebook ?? 'No Facebook' }}<br>
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
                @if($buddy->verified == 'y')
                    <i class="fas fa-check fa-fw mr-1"></i> Verified
                @elseif ($buddy->verified == 'n')
                    <i class="fas fa-hourglass-half fa-fw mr-1"></i> Not verified yet
                @else
                    <i class="fas fa-times fa-fw mr-1"></i> Denied
                @endif
            </div>
        @endif
    </div>
</div>