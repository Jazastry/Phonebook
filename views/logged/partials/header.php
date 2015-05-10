<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../content/css/styleS.css"/>
        <script src="../../../content/js/lib/jquery/jquery-1.11.0.min.js"></script>
        <script src="../../../content/js/main.js"></script>   
    </head>
    <body>
        <?php include_once 'messages.php'; ?>
        <header>
            <h1>Phone Book</h1>
            <div class="rightSide">
                <li><h4><?php echo 'Hello ' . htmlspecialchars($this->user['username']) . '!'?></h4></li>                    
            </div>
            <ul>
                <li><a href="/logged/home">HOME</a></li>
                <li><a href="/logged/phones">PHONES</a></li>
                <li><a href="/logged/groups">GROUPS</a></li>         
                <li><a href="/account/logout">LOGOUT</a></li>
            </ul>
        </header>