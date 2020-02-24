<div class="container">
    <div class="row row-inner buddy-detail">
        <div class="col-sm-6">
            @include("partak.users.userInfo", ['user' => $exStudent->user])
        </div>
        <div class="col-sm-6">
            @if(isset($exStudent->buddy))
                @include("partak.users.userInfo", ['user' => $exStudent->buddy->user()])
            @else
                <p>{{$exStudent->person->first_name }} doesn't have a buddy! :(</p>
            @endif
        </div>
    </div>
</div>
