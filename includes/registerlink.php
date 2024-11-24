<?php

      $email=$_GET["email"];
      $db->update_user_authenticated($email);
?>