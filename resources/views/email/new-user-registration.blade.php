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
</body>
</html>
