<?php
function showHeader($title) {
    ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo htmlspecialchars($title) ?></title>
    </head>
    <body>
        <h1><?php echo htmlspecialchars($title) ?></h1>
            <?php
        }

        function showFooter () {
            ?>
    </body>
</html>
    <?php
}

function showError($message) {
    echo "<h2>Error</h2>";
    echo nl2br(htmlspecialchars($message));
    exit();
}

try {
    $config = parse_ini_file("C:\\xampp\\php\\apps\\phppdo.ini");
    $conn = new PDO($config['db.conn'], $config['db.user'], $config['db.pass']);
} catch(PDOException $e) {
    showError("Sorry, an error has occurred. Please try your request later\n" . $e->getMessage());
}
?>
