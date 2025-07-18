<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thank You from RThree Creatives</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; padding: 40px; color: #26346C;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.05);">

        {{-- Logo --}}
        <div style="text-align: center; margin-bottom: 25px;">
            <img src="https://res.cloudinary.com/dlwy94hlr/image/upload/v1751026065/Logo_po5vri.png" alt="RThree Creatives Logo" style="height: 50px;">
        </div>

        {{-- Greeting --}}
        <h2 style="margin-bottom: 10px;">Hello {{ $enquiry->name }},</h2>

        {{-- Intro --}}
        <p style="font-size: 16px;">Thanks for reaching out to <strong>RThree Creatives</strong>.</p>
        <p style="font-size: 16px;">We’ve received your enquiry and our team will get back to you shortly.</p>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #e0e0e0;">

        {{-- Message Content --}}
        <p><strong>Your Message:</strong></p>
        <p style="background-color: #f2f2f2; padding: 10px 15px; border-radius: 6px;">{{ $enquiry->message }}</p>

        <p style="margin-top: 20px;"><strong>Selected Services:</strong> {{ implode(', ', $enquiry->selections ?? []) }}</p>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #e0e0e0;">

        {{-- Footer --}}
        <p style="margin-top: 30px;">Regards,<br><strong>Team RThree</strong></p>
        <p style="font-size: 13px; color: #888; margin-top: 30px;">
            RThree Creatives<br>
            www.rthree.in
        </p>
    </div>
</body>
</html>
