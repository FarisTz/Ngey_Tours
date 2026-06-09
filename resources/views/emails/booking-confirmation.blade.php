<x-mail::message>
# Introduction

<h2>Booking Confirmation</h2>

<p>Dear {{ $booking->Full_name }},</p>

<p>Your booking has been received successfully.</p>

<p>Thank you.</p>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
