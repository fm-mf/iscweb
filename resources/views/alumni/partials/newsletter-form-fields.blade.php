{{ csrf_field() }}
<div class="form-group">
    <label class="required" for="newsletter-title">Titulek</label>
    <input class="form-control @if ($errors->has('title')) is-invalid @endif" type="text" name="title" id="newsletter-title" required="required"
            value="{{ request()->old('title') ?? isset($newsletter) ? $newsletter->title : "" }}" />
    @if ($errors->has('title'))
        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
    @endif
</div>
<div class="form-group">
    <label class="required" for="newsletter-link">Odkaz</label>
    <input class="form-control @if ($errors->has('link')) is-invalid @endif" type="url" name="link" id="newsletter-link" required="required"
            value="{{ request()->old('link') ?? isset($newsletter) ? $newsletter->link : "" }}" />
    @if($errors->has('link'))
        <div class="invalid-feedback">{{ $errors->first('link') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="newsletter-perex">Úvod</label>
    <textarea class="form-control @if ($errors->has('perex')) is-invalid @endif" type="text" name="perex" id="newsletter-perex">{{ request()->old('perex') ?? isset($newsletter) ? $newsletter->perex : "" }}</textarea>
    @if($errors->has('perex'))
        <div class="invalid-feedback">{{ $errors->first('perex') }}</div>
    @endif
</div>
<div class="form-group">
    <label class="required" for="newsletter-date">Datum odeslání</label>
    <input class="form-control @if ($errors->has('date_sent')) is-invalid @endif" type="date" name="date_sent" id="newsletter-date" required="required"
            value="{{ request()->old('date_sent') ?? isset($newsletter) ? $newsletter->date_sent->toDateString() : \Carbon\Carbon::now()->toDateString() }}" />
    @if($errors->has('date_sent'))
        <div class="invalid-feedback">{{ $errors->first('date_sent') }}</div>
    @endif
</div>
