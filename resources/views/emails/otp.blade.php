<!-- resources/views/emails/verify_email_otp.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h1>Your OTP Code</h1>
    <p>Your OTP is: <strong>{{ $otp }}</strong></p>
    <p>Thank you for using our application!</p>
</body>
</html>
