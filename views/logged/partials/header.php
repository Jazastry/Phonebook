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
            <ul>
                <li><a href="/logged/home">HOME</a></li>
                <li><a href="/logged/phones">PHONES</a></li>
                <li><a href="/logged/groups">GROUPS</a></li>
                <li><a href="/logged/phones/create">ADD NEW PHONE</a></li>
                <div class="rightSide">
                    <li><h4><?php echo 'Hello ' . $this->user['username'] . '!'?></h4></li>
                    <li><a href="/account/logout">LOGOUT</a></li>
                </div>
            </ul>
        </header>
        <style><?php include './phonebook/content/css/styleS.css'; ?></style>