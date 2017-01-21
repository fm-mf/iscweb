<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Great news! You have been paired with a Czech buddy</title>
</head>
<body>
<p>Hello there!<br>
We are bringing great news – you have been paired with a Czech student.
Your buddy should contact you soon and  provide you with more details.</p>
<?php
        if (isset($buddy->person->sex) && $buddy->person->sex) {
            $s = $buddy->person->sex == 'M' ? 'his' : 'her';
        } else {
            $s = 'his/her';
        }
?>
<p>If you want to, you can take the initiative and be the first one to start the conversation.<br>
Here is {{ $s }} profile: <br>
{{ $buddy->person->first_name }} {{ $buddy->person->last_name }}, <br>
{{ $buddy->person->user->email }}</p>

Looking forward to seeing you in Prague!
ISC Buddy Team
</body>
</html>