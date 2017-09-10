@extends('layouts.guide.layout')

@section('title', 'First steps &ndash; ')

@section('content') {{-- TODO --}}
<div class="row">
    <h1>Basic information for you</h1>
    <h2>CHECKLIST FOR AN INTERNATIONAL STUDENT</h2>
    After your arrival:
    <p>
    <ul>
        <li>get accommodated at your dorm</li>
        <li>get the Welcome pack - in the ISC Point - from {{ $wcFrom }}</li>
        <li>get ISC membership before {{ $owFrom }} - required to register for Orientation Week trips. Come to the ISC Point in Masarykova dorm, room R304</li>
        <li>get your public transportation card</li>
        <li>get your student ID</li>
        <li>register for Czech insurance, if you have an EHIC card (blue health insurance card)</li>
        <li>attend the Orientation Week ({{ $owFromTo }})</li>
        <li>get to know the city</li>
        <li>get to know your Buddy and Czech people</li>
        <li>enjoy your classes and your stay!</li>
    </ul>
    <b>note for private students</b>: Please visit your faculty coordinator for registration and documents
    needed for public transportation pass and other student cards.

</div>


<div class="row">
    <h2>WHAT IS IN YOUR WELCOME PACK?</h2>
    <p>The welcome pack includes: dorm regulations, Survival Guide, program of the Orientation Week, study record book, USE-IT
        map of Prague, map of CTU campuses, list of trips in the orientation week, public transportation pass forms
        (white form with a red stripe, little yellow form)</p>
    <small><b>Note for private students</b>: You will get your study record book and the forms for your public
        transportation pass from your faculty coordinator.</small>
</div>
@stop