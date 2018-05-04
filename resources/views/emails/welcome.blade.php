<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Welcome to IPN Digital, @if(isset($user->companies)) {{ $user->companies->CO_Name }} @else {{ $user->people->PE_Name." ".$user->people->PE_LastName }} @endif
    </h1>
    <p>This mail was sent to you because you registered in our page with the following email: {{ $user->email }}</p>
    <p>If you want to login and see what you can do with us please visit <a href="www.ipndigital.com/login">www.ipndigital.com/login</a></p>
    <p>Thank you so much for registering with us and hope to see you soon!</p>
</body>
</html>