<?php require 'header.php'; if (isset($_SESSION['admin'])) { header("Location: home.php"); } else { header("Location: login.php"); } ?>