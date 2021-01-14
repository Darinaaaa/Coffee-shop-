<?php
error_reporting(0);
if (isset($_COOKIE["hash"]) && isset($_COOKIE["id"])) {
    if ($_COOKIE["id"] === "1" || $_COOKIE["id"] === 1) {
        include 'admin_header.php';
    }
}