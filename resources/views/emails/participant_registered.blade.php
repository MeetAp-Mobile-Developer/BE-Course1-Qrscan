<!DOCTYPE html>
<html>
<head>
    <title>Participant Registration</title>
</head>
<body>
    <h1>Hello {{ $participantName }},</h1>
    <p>Thank you for registering. Please find your QR Code below:</p>
    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code" />
    <p>Best regards,<br>The Team</p>
</body>
</html>
