Hello {{ $enquiry->name }},

Thanks for reaching out to RThree Creatives.
We’ve received your enquiry and our team will get back to you shortly.

------------------------------
Your Message:
{{ $enquiry->message }}

Selected Services: {{ implode(', ', $enquiry->selections ?? []) }}
------------------------------

Regards,  
Team RThree  
www.rthree.in
