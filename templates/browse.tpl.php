<?php function drawBrowse() { ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/browse.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Price</button>
            <div id="myDropdown" class="dropdown-content">
              Less than 500€ <br>
              500€ - 5000€<br>
              More than 5000€
            </div>
        </div>
        <section class="wall">
            <div class="trending">
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad1"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad2"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad3"></a>
            </div>
            <p class="pop first ad1">Vintage car</p>
            <p class="pop first ad2">Modern bike</p>
            <p class="pop first ad3">Popcorn</p>
            <div class="trending">
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad4"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad5"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad6"></a>
            </div>
            <p class="pop second ad4">Pocket watch with wheels</p>
            <p class="pop second ad5">Duck 1</p>
            <p class="pop second ad6">Duck 2</p>
            <div class="trending">
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad7"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad8"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad"></a>
            </div>
            <p class="pop third ad7">Pocket watch with wheels</p>
            <p class="pop third ad8">Duck 1</p>
            <p class="pop third ad9">Duck 2</p>
        </section>
        <script>
            function myFunction() {
              document.getElementById("myDropdown").classList.toggle("show");
            }
            window.onclick = function(event) {
              if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
            }
            </script>
    </body>
</html>
<?php } ?>