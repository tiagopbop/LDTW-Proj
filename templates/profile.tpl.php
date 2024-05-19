<?php function drawProfile($user) { ?>
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
    <span class="data name"><?php echo htmlspecialchars($user->named); ?></span> 
        <span class="data username"><?php echo htmlspecialchars($user->userName); ?></span> 
        <span class="data email"><?php echo htmlspecialchars($user->email); ?></span> 
            <a href="../pages/changeProfile.php"><span class="change">Change user info </span></a>
            
        <form method="POST" action="../pages/logout.php" style="display:inline;">
            <button class="logout" type="submit" class="logout">Logout</button>
        </form>
    </section>
</body>
</html>
<?php } ?>
