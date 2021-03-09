<div class="container">
    <div class="row row-inner buddy-detail">
        <div class="col-xl-6">
            @include("partak.users.partials.user-info", ['user' => $exStudent->user])
        </div>
        <div class="col-xl-6 mt-2">
            @if(isset($exStudent->buddy))
                @include("partak.users.partials.user-info", [
                    'user' => $exStudent->buddy->user,
                    'buddyStudent' => $exStudent,
                    'edit' => false
                ])
            @else
                <p>{{$exStudent->person->first_name }} doesn't have a buddy! :(</p>
            @endif
        </div>
    </div>
</div>
