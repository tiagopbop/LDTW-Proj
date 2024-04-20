<?php

  function getDatabaseConnection() {
    return new PDO('sqlite:database/store.db');
  }

?>