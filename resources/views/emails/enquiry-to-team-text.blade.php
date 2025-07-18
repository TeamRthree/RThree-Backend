New Enquiry Received from {{ $enquiry->name }}

Email: {{ $enquiry->email }}
Phone: {{ $enquiry->phone }}

Selected Services:
@foreach($enquiry->selections as $service)
- {{ $service }}
@endforeach

Message:
{{ $enquiry->message }}

Submitted on: {{ now()->format('F j, Y \a\t h:i A') }}

— Team RThree
