<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/content/css/styleS.css"/>
    </head>
    <body>
        <header>
            <a href="/"><img src="/content/images/logo1.jpg"/></a>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/account/login">Login</a></li>
                <li><a href="/account/register">Register</a></li>
                <li><a href="/phones">Phones</a></li>
                <li><a href="/phones/create">Create Record</a></li>
                <li><a href="/account/logout">Logout</a></li>
            </ul>
        </header>

