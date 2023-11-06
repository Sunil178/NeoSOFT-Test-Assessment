<!DOCTYPE html>
<html>
<body>
    <p>Thank you for registering!</p>
    <p>Please click the following link to confirm your registration:</p>
    <a href="{{ route('confirm-registration', ['token' => $token]) }}">Confirm Registration</a>
</body>
</html>
