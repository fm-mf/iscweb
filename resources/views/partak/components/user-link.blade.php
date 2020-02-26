@if((isset($user->buddy) && Auth::user()->can('acl', 'buddy.view')) ||
    (isset($user->exchangeStudent) && Auth::user()->can('acl', 'exchangeStudents.view')))<a href="{{ ($user->exchangeStudent ?? $user->buddy)->getDetailLink() }}">{{ $user->getFullName(true) }}</a>@else
{{ $user->getFullName(true) }}@endif