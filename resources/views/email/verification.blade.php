<!DOCTYPE html>
<html lang="en">
<body>
    <div>
        <p>Dear User {{ $user->username }} </p>
        <p>Your account has been created.Please click here to verify</p>
        <a href="{{ route('token', [$user->remember_token]) }}">
            {{ route('verify', $user->remember_token) }}
        </a>
        <p>Thanks!</p>
    </div>
</body>
</html>