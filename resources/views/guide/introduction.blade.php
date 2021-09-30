@extends('guide.layouts.subpage')

@section('subtitle', 'Introduction')

@section('subpage')
    <h2>Introduction</h2>
    <p>
        <span>Dear international students,</span>
        We are the <strong>International Student Club at the Czech Technical University
        in Prague</strong> ({{ $shortName }}) and our history dates to 1999, when ISC was
        established just by two students. Our members are mostly Czech students and
        we are all volunteers. We want to help international students especially at the
        beginning of the semester by the Buddy Program. We also want to make your exchange
        in Prague the most exciting. That’s why we organize activities such as trips,
        languages courses and much more. We have prepared this Survival Guide where you can find
        useful information concerning all the topics for surviving in the Czech Republic.
    </p>
    <p>
        If you need help or advice, ask your Czech Buddy or come to the ISC, and we will try
        to help! If you have some questions that are not covered in this Survival Guide,
        you can ask via email at <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>.
        We can assure you that ISC is doing everything to improve the care for international
        students. All information about the {{ $fullName }} is available on
        <a href="{{ route('web.lang-select') }}" target="_blank">our website</a> or at
        <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">our Facebook page</a>.
    </p>
    <p>
        <img
            src="{{ asset('img/guide/ow-group-photo.jpg') }}"
            alt="Group photo of international students from Orientation week"
            title="Group photo of international students from Orientation week"
        />
    </p>
@stop
