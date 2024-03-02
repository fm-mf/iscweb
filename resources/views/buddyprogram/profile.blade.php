@extends('layouts.buddyprogram.layout')

@section('content')

    <div class="container page">
        <div class="card-body">
            <h1 class="text-center card-title">@lang('buddy-program.student-profile')</h1>

            <div class="row">
                <div class="col-12 col-md-9 order-md-first order-last">
                    <h2>
                        {{ $exchangeStudent->person->first_name }}
                        <span class="last-name">{{ $exchangeStudent->person->last_name }}</span>
                    </h2>
                    <div class="row">
                        <div class="col">
                            @if($exchangeStudent->degree_student)
                                <span class="badge badge-secondary">Degree student</span><br />
                            @endif
                            @if($exchangeStudent->country)
                                <strong>@lang('buddy-program.country')</strong>:
                                {{ $exchangeStudent->country->full_name }}
                                <br>
                            @endif
                            @if($exchangeStudent->school)
                                <strong>@lang('buddy-program.school')</strong>:
                                {{ $exchangeStudent->school }}
                                <br>
                            @endif
                            @if($exchangeStudent->person->sex)
                                <strong>@lang('buddy-program.sex')</strong>:
                                @if($exchangeStudent->person->sex === 'M')
                                    @lang('buddy-program.sex-m')
                                @else
                                    @lang('buddy-program.sex-f')
                                @endif
                                <br>
                            @endif
                            @if($exchangeStudent->person->age)
                                <strong>@lang('buddy-program.age')</strong>:
                                {{ $exchangeStudent->age_range }}
                                @lang('buddy-program.years-old')
                                <br>
                            @endif
                            @if($exchangeStudent->faculty)
                                <strong>@lang('buddy-program.faculty')</strong>:
                                {{ $exchangeStudent->faculty->faculty }}
                                <br>
                            @endif

                            <strong>@lang('buddy-program.arrival-date')</strong>:
                            @if($exchangeStudent->arrival)
                                {{ $exchangeStudent->arrival->arrivalFormatted }}
                            @else
                                @lang('buddy-program.not-filled-yet')
                            @endif
                            <br>

                            <strong>@lang('buddy-program.arrival-transport')</strong>:
                            @if($exchangeStudent->arrival)
                                {{ $exchangeStudent->arrival->transportation->transportation }}
                            @else
                                @lang('buddy-program.not-filled-yet')
                            @endif
                            <br>

                            <strong>@lang('buddy-program.accommodation')</strong>:
                            {{ $exchangeStudent->accommodation->full_name }}
                            <br>

                            <strong>{{ trans_choice('buddy-program.semester', $exchangeStudent->semesters->count()) }}</strong>:
                            @foreach($exchangeStudent->semesters->sortBy('id_semester') as $semester)
                                {{ $semester->name_localized }}@if(!$loop->last),@endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 ">
                    <div class="avatar-view" title="Profile picture">
                        @isset($exchangeStudent->person->avatar)
                            <img src="{{ asset($avatar) }}" alt="Avatar" id="avatar">
                        @else
                            <i class="fas fa-user-circle fa-9x" id="avatar"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($exchangeStudent->about)
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <h3>@lang('buddy-program.details')</h3>
                        {{ $exchangeStudent->about_html }}
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="flash col-sm-6">{{$error}}</div>
                @endforeach
            @endif
            @if(!$exchangeStudent->hasBuddy() && $canChoose)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#becomeBuddyModal">
                    @if($exchangeStudent->person->sex === 'M')
                        @lang('buddy-program.become-buddy-m')
                    @else
                        @lang('buddy-program.become-buddy-f')
                    @endif
                </button>
                <div class="modal fade" id="becomeBuddyModal" tabindex="-1" role="dialog" aria-labelledby="becomeBuddyModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="becomeBuddyModalTitle">
                                    @if($exchangeStudent->person->sex === 'M')
                                        @lang('buddy-program.become-buddy-confirm-title-m', ['name' => $exchangeStudent->person->first_name])
                                    @else
                                        @lang('buddy-program.become-buddy-confirm-title-f', ['name' => $exchangeStudent->person->first_name])
                                    @endif
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if($exchangeStudent->person->sex === 'M')
                                    @lang('buddy-program.become-buddy-confirm-description-m', ['name' => $exchangeStudent->person->first_name])
                                @else
                                    @lang('buddy-program.become-buddy-confirm-description-f', ['name' => $exchangeStudent->person->first_name])
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    @lang('buddy-program.cancel')
                                </button>

                                <form method="POST" action="{{ route('become-buddy', ['exchangeStudent' => $exchangeStudent->hash_id]) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        @if($exchangeStudent->person->sex === 'M')
                                            @lang('buddy-program.become-buddy-m')
                                        @else
                                            @lang('buddy-program.become-buddy-f')
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($exchangeStudent->id_buddy === auth()->id())
                <div class="show-email">
                    <p>
                        <strong>{{ $exchangeStudent->person->first_name }} {{ $exchangeStudent->person->last_name }}</strong>
                        @lang('buddy-program.is-your-buddy')
                        @if ($exchangeStudent->person->sex === 'M')
                            @lang('buddy-program.you-can-write-him')
                        @else
                            @lang('buddy-program.you-can-write-her')
                        @endif
                    </p>
                    <p class="mb-0">
                        @lang('buddy-program.available-contacts'):
                    </p>
                    <ul class="contacts-list">
                        <li>
                            <i class="fas fa-envelope fa-fw" title="@lang('buddy-program.e-mail')"></i>
                            <a href="mailto:{{ $exchangeStudent->person->user->email }}">
                                {{ $exchangeStudent->person->user->email }}
                            </a>
                        </li>
                        @if ($exchangeStudent->whatsapp)
                            <li>
                                <i class="fab fa-whatsapp fa-fw" title="WhatsApp"></i>
                                <a href="tel:{{ $exchangeStudent->whatsAppFormattedE164 }}">
                                    {{ $exchangeStudent->whatsAppFormattedInternational }}
                                </a>
                            </li>
                        @endif
                        @if ($exchangeStudent->facebook)
                            <li>
                                <i class="fab fa-facebook fa-fw" title="Facebook"></i>
                                <a href="{{ $exchangeStudent->facebook }}" target="_blank" rel="noopener">
                                    {{ $exchangeStudent->facebook }}
                                </a>
                            </li>
                        @endif
                        @if ($exchangeStudent->instagram)
                            <li>
                                <i class="fab fa-instagram fa-fw" title="Instagram"></i>
                                <a href="{{ $exchangeStudent->instagram_link }}" target="_blank" rel="noopener">
                                    {{ "@$exchangeStudent->instagram" }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="show-email">
                    <p>@lang('buddy-program.buddy-limit-reached', [ 'limit' => $limit ])</p>
                </div>
            @endif
        </div>
        @if ($exchangeStudent->id_buddy === auth()->id())
            <div class="card-body">
                <p class="show-info">
                    @lang('buddy-program.buddy-removal-info')
                    <a href="mailto:buddy@esn.cvut.cz">buddy@esn.cvut.cz</a>
                </p>
            </div>
        @endif
    </div>

@stop
