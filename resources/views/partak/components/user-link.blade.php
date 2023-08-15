@if((isset($user->buddy) && Auth::user()->can('acl', 'buddy.view')) ||
    ((isset($user->exchangeStudent) || isset($user->degreeStudent)) && Auth::user()->can('acl', 'exchangeStudents.view')))<a href="{{ ($user->exchangeStudent ?? $user->degreeStudent ?? $user->buddy)->getDetailLink() }}">{{ $user->getFullName(true) }}</a>@else
{{ $user->getFullName(true) }}@endif
