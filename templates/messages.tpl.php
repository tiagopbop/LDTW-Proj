<?php
require_once(__DIR__ . '/../database/connection.php');

function checkChatExistence($db, $user1Id, $user2Id) {
    $stmt = $db->prepare("SELECT * FROM Chat WHERE (BuyerId = :user1Id AND SellerId = :user2Id) OR (BuyerId = :user2Id AND SellerId = :user1Id)");
    $stmt->bindParam(':user1Id', $user1Id, PDO::PARAM_INT);
    $stmt->bindParam(':user2Id', $user2Id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}

function createChat($db, $user1Id, $user2Id) {
    $stmt = $db->prepare("INSERT INTO Chat (BuyerId, SellerId) VALUES (:user1Id, :user2Id)");
    $stmt->bindParam(':user1Id', $user1Id, PDO::PARAM_INT);
    $stmt->bindParam(':user2Id', $user2Id, PDO::PARAM_INT);
    return $stmt->execute();
}

function drawMessages($db, $currentUser, $vehicleUser = null) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['currentUser']) && isset($_POST['vehicleUser'])) {
            $currentUser = (int) $_POST['currentUser'];
            $vehicleUser = (int) $_POST['vehicleUser'];
            
            if (!checkChatExistence($db, $currentUser, $vehicleUser)) {
                createChat($db, $currentUser, $vehicleUser);
            }}}
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/messages.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
        <style>
            .profile {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <section class="wall">
            <div class="liney"></div>
            <section class="profiles">
                <?php
                $stmt = $db->prepare('SELECT DISTINCT U.UserId, U.named FROM User U INNER JOIN Chat C ON (U.UserId = C.BuyerId OR U.UserId = C.SellerId) WHERE (C.BuyerId = :current_user OR C.SellerId = :current_user) AND U.UserId != :current_user');
                $stmt->bindParam(':current_user', $currentUser, PDO::PARAM_INT);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    echo '<div class="profile" data-user-id="' . htmlspecialchars($user['UserId']) . '">';
                    echo '<img class="pfp" src="../docs/placeholder.jpg" alt="Profile Picture">';
                    echo '<span class="people">' . htmlspecialchars($user['named']) . '</span>';
                    echo '</div>';
                }
                ?>
            </section>
            <section class="chats" data-chat-id="" data-recipient-id=""></section>
            <input type="text" class="write" placeholder="Message">
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.profile').on('click', function() {
                    var UserId = $(this).data('user-id');
                    $('.write').show();

                    $.ajax({
                        type: 'POST',
                        url: '../database/fetch_messages.php',
                        data: { currentUser: <?php echo $currentUser; ?>, UserId: UserId },
                        success: function(messagesResponse) {
                            $('.chats').html(messagesResponse);
                            $('.chats').data('chat-id', messagesResponse.ChatId);
                            $('.chats').data('recipient-id', UserId);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                $('.write').keypress(function(e) {
                    if (e.which === 13) {
                        var message = $(this).val().trim();
                        if (message !== '') {
                            var UserId = $('.chats').data('recipient-id');

                            $.ajax({
                                type: 'POST',
                                url: '../database/send_message.php',
                                data: {
                                    currentUser: <?php echo $currentUser; ?>,
                                    UserId: UserId,
                                    message: message
                                },
                                success: function(response) {
                                    var jsonResponse = JSON.parse(response);
                                    if (jsonResponse.success) {
                                        $('.chats').append('<div class="message">' + message + '</div>');
                                        $('.chats').scrollTop($('.chats')[0].scrollHeight);
                                        $('.write').val('');
                                    } else {
                                        console.error(jsonResponse.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    }
                });
            });
        </script>
    </body>
    </html>
    <?php
}

?>
