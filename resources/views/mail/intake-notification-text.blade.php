{{ $heading }} - MediDENT Multicare Clinic

{{ $intro }}

Request details:
@foreach ($details as $detail)
{{ $detail['label'] }}: {{ $detail['value'] }}
@endforeach

This notification was sent automatically from the MediDENT website.
