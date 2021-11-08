<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to new World</title>
</head>
<body class="antialiased">
    <div>
        Hi i'm {{$user->name}}
    </div>
    <div>
        <a href="{{url('/api/email/verify',[$user->id,$user->email_verification_token])}}"> CLick to Verify</a>
    </div>
    <br>
    <div>
        <a href="{{url('/api/email/verify',[$user->id,$user->email_verification_token])}}">{{url('/email/verify',[$user->id,$user->email_verification_token])}}</a>
    </div>
</body>
</html>
