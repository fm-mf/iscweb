<div class="container info-table">
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Country</div>
        <div class="col-lg-9 col-md-6">{{ $exStudent->country->full_name }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Faculty</div>
        <div class="col-lg-9 col-md-6">{{ $exStudent->faculty->faculty }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">School</div>
        <div class="col-lg-9 col-md-6">{{ $exStudent->school ?? 'No school filled' }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Accommodation</div>
        <div class="col-lg-9 col-md-6">{{ $exStudent->accommodation->full_name_eng }}</div>
    </div>
    @if(isset($exStudent->note))
        <div class="row">
            <div class="col-lg-3 col-md-4 label">Internal note</div>
            <div class="col-lg-9 col-md-6">{{ $exStudent->note }}</div>
        </div>
    @endif
    @if(! isset($exStudent->buddy))
        <div class="row">
            <div class="col-lg-3 col-md-4 label">Want Buddy</div>
            <div class="col-lg-9 col-md-6">{{ ($exStudent->want_buddy === 'y')? "Yes" : "No" }}</div>
        </div>
    @endif
        <div class="row">
            <div class="col-lg-3 col-md-4 label">ESN registered</div>
            <div class="col-lg-9 col-md-6">{{ ($exStudent->esn_registered === 'y')? "Yes" : "No" }}</div>
        </div>
    @if(isset($exStudent->esn_card_number))
        <div class="row">
            <div class="col-lg-3 col-md-4 label">ESNcard number</div>
            <div class="col-lg-9 col-md-6">{{ $exStudent->esn_card_number }}</div>
        </div>
    @endif
    @if($exStudent->quarantined)
        <div class="row">
            <div class="col-lg-3 col-md-4 label">In quarantine until</div>
            <div class="col-lg-9 col-md-6">{{ $exStudent->quarantined_until->formatLocalized(__('formatting.full-date')) }}</div>
        </div>
    @endif
</div>
