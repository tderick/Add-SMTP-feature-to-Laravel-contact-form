<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>
    <h2>You received a message on your site</h2>
    <ul>
        <li><strong>Name</strong> : {{ $contact['name'] }}</li>
        <li><strong>Email</strong> : {{ $contact['email'] }}</li>
        <li><strong>Message</strong> : {{ $contact['message'] }}</li>
    </ul>
</body>

</html>
