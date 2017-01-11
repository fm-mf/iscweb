Verification email
Verification link: <a href="{{ url('user/verify/' . $person->user->hash) }}">{{ $person->first_name }}</a>