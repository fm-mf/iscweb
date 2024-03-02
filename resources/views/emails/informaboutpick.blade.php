<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Great news! You have been paired with a Czech buddy</title>
</head>
<body>
    <p>Hi {{ $exStudName }},</p>
    <p>we are bringing you great news – you have been paired with a Czech student.</p>
    <p>Your buddy should contact you soon and provide you with more details.</p>
    <p>If you want to, you can take the initiative and be the first one to start the conversation.</p>
    <p>Here is {{ $s }} profile:<br>
        Name: {{ $buddyName }}<br>
        Email: <a href="mailto:{{ $buddyEmail }}">{{ $buddyEmail }}</a></p>
    <p>Looking forward to seeing you in Prague!<br>
        ESN Buddy Team
    </p>
</body>
</html>
