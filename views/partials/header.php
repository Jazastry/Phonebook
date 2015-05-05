<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/content/css/styleS.css"/>
        <script src="../../../content/js/lib/jquery/jquery-1.11.0.min.js"></script>
        <script src="../../../content/js/main.js"></script>   
    </head>
    <body>
        <?php include_once 'messages.php'; ?>
        <header>
            <h1>Phone Book</h1>
            <ul>
                <li><a href="/">HOME</a></li>
                <li><a href="/account/login">LOGIN</a></li>
                <li><a href="/account/register">REGISTER</a></li>
            </ul>
        </header>

