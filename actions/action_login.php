<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = user::getUserWithPassword($db, $_POST['email'], $_POST['username'], $_POST['password']);

  if ($customer) {
    $session->setId($user->userId);
    $session->setUsername($user->userName);
    $session->setRole($user->is_admin)
    $session->addMessage('success', 'Login successful!');
  } else {
    $session->addMessage('error', 'Wrong password!');
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>