<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome email</title>
</head>
<body>
    <h1> welcome to our application</h1>
    <p>Dear {{$name}},</p>
    <p>thank you for your intrest</p>
    <p>regards</p>
    <h4>{{env('APP_NAME')}}  Team</h4>

    
</body>
</html>