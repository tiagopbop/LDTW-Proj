<?php
require_once(__DIR__ . '/../database/connection.php');

// Function to draw messages
function drawMessages($db, $currentUser) {
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
            /* CSS for mouse cursor */
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
                // Fetch list of users the current user has chats with
                $stmt = $db->prepare('SELECT DISTINCT U.UserId, U.userName FROM User U INNER JOIN Chat C ON (U.UserId = C.BuyerId OR U.UserId = C.SellerId) WHERE (C.BuyerId = :current_user OR C.SellerId = :current_user) AND U.UserId != :current_user');
                $stmt->bindParam(':current_user', $currentUser, PDO::PARAM_INT);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);



                // Display profiles of users
                foreach ($users as $user) {
                    echo '<div class="profile" data-user-id="' . htmlspecialchars($user['UserId']) . '">';
                    echo '<img class="pfp" src="../docs/placeholder.jpg" alt="Profile Picture">';
                    echo '<span class="people">' . htmlspecialchars($user['userName']) . '</span>';
                    echo '</div>';
                }
                ?>
            </section>
            <section class="chats" data-chat-id="" data-recipient-id="">
            </section>
            <input type="text" class="write" placeholder="Message">
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Event listener for profile click
                $('.profile').on('click', function() {
                    var UserId = $(this).data('user-id');
                    
                    // Fetch chat ID between current user and selected user
                    $.ajax({
                        type: 'POST',
                        url: '../database/fetch_messages.php',
                        data: { currentUser: <?php echo $currentUser; ?>, UserId: UserId },
                        success: function(messagesResponse) {
                            $('.chats').html(messagesResponse);
                            $('.chats').data('chat-id', messagesResponse.ChatId);  // Assuming fetch_messages.php returns ChatId
                            $('.chats').data('recipient-id', UserId);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                // Event listener for sending messages
                $('.write').keypress(function(e) {
                    if (e.which === 13) {
                        var message = $(this).val().trim();
                        if (message !== '') {




                            var UserId = $('.chats').data('recipient-id');
                            
                            // Send the message to the server
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
                                        // Update the chat interface with the new message
                                        $('.chats').append('<div class="message">' + message + '</div>');
                                        $('.chats').scrollTop($('.chats')[0].scrollHeight);
                                        $('.write').val(''); // Clear the input field
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

// Call the drawMessages function with the current user ID
?>
