<?php function drawProfile() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/profile.css" rel="stylesheet">
    <title>BlazeDrive</title>
    <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
</head>
<body>
    <section class="wall">
    <img class="pfp" src="../docs/pfp_placeholder.png" alt="pfp">
            <span class="data name">Julius César</span>
            <span class="change nm">Edit name</span>
            <span class="data username">GatinhoNeon123</span>
            <span class="change usr">Edit username</span>
            <span class="data email">email_exemplo@arroba.com</span>
            <span class="change eml">Edit email</span>
            <span class="data password">Wuant123</span>
            <span class="change psswrd">Edit password</span>
        <form method="POST" action="../pages/logout.php" style="display:inline;">
            <button class="logout" type="submit" class="logout">Logout</button>
        </form>
    </section>
</body>
</html>
<?php } ?>
