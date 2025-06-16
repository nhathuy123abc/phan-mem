<?php
// logout.php

// Khởi động nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();

header("Location: /New%20folder/");
exit;
