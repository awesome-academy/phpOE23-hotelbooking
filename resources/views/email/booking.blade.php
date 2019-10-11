<h2>{{ trans('booking.email_sub') }}</h2>
<h3><i>({{ trans('booking.confirm') }})</i></h3>
<h4>{{ trans('booking.customer_info') }}</h4>
<ul>
    <li>{{ $user->name }}</li>
    <li>({{ $user->country->phone_code }}) {{ $user->phone }}</li>
</ul>
<h4>{{ trans('booking.booking_card') }}
<ul>
    <li>{{ $bookingCard->hotel->name }}, {{ $bookingCard->hotel->city->name }}</li>
    <li>
        {{ trans('booking.you_choose') }} <br>
    <ul>
        @foreach ($bookingCard->bookingCardDetails as $detail)
            <li>{{ $detail->roomType }}: {{ $detail->quantity }}</li>
        @endforeach
    </ul>
    </li>
    <li>
    {   { trans('booking.payment')) }}: {{ $bookingCard->bookingCardStatus->amount }} {{ $bookingCard->bookingCardStatus->currency->symbol }}
    </li>
</ul>
<strong>{{ trans('booking.thank_you' )}}</strong>
