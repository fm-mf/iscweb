<div class="container">
    <div class="row row-inner buddy-detail">
        <div class="col-sm-12">
            <h2>Exchange student</h2>
        </div>
        <div class="col-sm-6">
            <h3 class="hline"><span>Details</span></h3>
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($exStudent->person->avatar()) }}">
            <h3>{{ $exStudent->person->getFullName() }}</h3>
            @can('acl', 'exchangeStudents.edit')<a href="{{ url('partak/users/exchange-students/edit/' . $exStudent->id_user) }}" class="btn btn-xs btn-success edit-button"><span class="glyphicon glyphicon-pencil up"></span> Edit</a> <br>@endcan
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $exStudent->person->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> {{ $exStudent->phone ?? 'No Phone' }}<br>
            @if($exStudent->esn_registered === 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"  style="color: #449D44"></span> ESN Registered
            @else <span class="glyphicon glyphicon-remove buddy-detail-icon" style="color: #C9302C"></span> Not ESN Registered
            @endif
        </div>
        <div class="col-sm-6">
            <h3 class="hline"><span>{{$exStudent->person->first_name }}'s buddy details</span></h3>
            @if(isset($exStudent->buddy))
                <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($exStudent->buddy->person->avatar()) }}">
                <h3>{{ $exStudent->buddy->person->getFullName() }}</h3>
                @can('acl', 'buddy.edit')
                    @if($buddyRemovable)
                        <protectedbutton  url="{{ url('partak/users/buddies/'. $exStudent->buddy->id_user .'/remove/' .$exStudent->id_user) }}"
                                          protection-text="Remove buddy {{ $exStudent->buddy->person->getFullName() }}?"
                                          button-style="btn-danger"><span class="glyphicon glyphicon-remove up"></span> Remove</protectedbutton><br>
                    @endif
                @endcan
                <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $exStudent->buddy->email }} <br>
                <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> {{ $exStudent->buddy->phone ?? 'No Phone' }}<br>
                @if($exStudent->buddy->verified == 'y') <span class="glyphicon glyphicon-ok buddy-detail-icon"></span> Verified
                @elseif ($exStudent->buddy->verified == 'n') <span class="glyphicon glyphicon-time buddy-detail-icon"></span> Not verified yet
                @else <span class="glyphicon glyphicon-remove buddy-detail-icon"></span> Denied
                @endif
            @else
                <p>{{$exStudent->person->first_name }} doesn't have a buddy! :(</p>
            @endif
        </div>

    </div>
</div>