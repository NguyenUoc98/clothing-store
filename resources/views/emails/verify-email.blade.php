<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <p>Click the link below to verify your email:</p>
    <a href="{{ url('/verify-email?token=' . $token) }}">Verify Email</a>
    <p>This link will expire in 30 minutes.</p>
</body>
</html>
