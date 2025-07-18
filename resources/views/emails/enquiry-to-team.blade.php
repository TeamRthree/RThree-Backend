<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Enquiry - RThree Creatives</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; padding: 40px; color: #26346C;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.05);">

        {{-- Logo --}}
        <div style="text-align: center; margin-bottom: 25px;">
            <img src="https://res.cloudinary.com/dlwy94hlr/image/upload/v1751026065/Logo_po5vri.png" alt="RThree Creatives Logo" style="height: 50px;">
        </div>

        {{-- Title --}}
        <h2 style="margin-bottom: 15px;">📥 New Enquiry Received</h2>

        {{-- Contact Info --}}
        <p><strong>Name:</strong> {{ $enquiry->name }}</p>
        <p><strong>Email:</strong> {{ $enquiry->email }}</p>
        <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>

        {{-- Selected Services --}}
        @if(!empty($enquiry->selections))
            <p><strong>Selected Services:</strong></p>
            <ul style="margin: 0 0 20px 15px; padding: 0;">
                @foreach($enquiry->selections as $service)
                    <li>{{ $service }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Message --}}
        <p><strong>Message:</strong></p>
        <p style="background-color: #f2f2f2; padding: 10px 15px; border-radius: 6px;">
            {{ $enquiry->message }}
        </p>

        {{-- Timestamp --}}
        <p style="margin-top: 25px; font-size: 13px; color: #888;">
            Submitted on: {{ now()->format('F j, Y \a\t h:i A') }}
        </p>

    </div>
</body>
</html>
