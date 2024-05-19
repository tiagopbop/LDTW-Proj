<?php function drawMessages() { ?>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/messages.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <section class="wall">
            <div class="liney"></div>
            <section class="profiles">
                <img class="pfp" src="../docs/placeholder.jpg" alt="Pfp1">
                <span class="people">Àlvaro Pinto</span>
                <br>
                <img class="pfp" src="../docs/placeholder.jpg" alt="Pfp2">
                <span class="people">Jessica Priscilla</span>
            </section>
            <section class="chats">
            </section>
            <input type="text" class="write" placeholder="Message">
        </section>
    </body>
</html>
<?php } ?>
