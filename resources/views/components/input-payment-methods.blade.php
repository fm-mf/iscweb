<div class="form-group">
    {{ Form::label('payment_method', 'Payment method', ['class' => 'required d-block']) }}
    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
        @foreach($paymentMethods as $paymentMethod)
            <label class="btn btn-outline-info">
                <input type="radio" name="payment_method" id="payment_method-{{ $paymentMethod->value }}" value="{{ $paymentMethod->value }}" required="required">
                <i class="{{ $paymentMethod->icon() }}"></i> {{ $paymentMethod->name }}
            </label>
        @endforeach
    </div>
    <small class="form-text text-muted">Select payment method</small>
</div>
