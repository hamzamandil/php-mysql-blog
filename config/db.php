<?php 

    $db = new mysqli('localhost', 'root', '123456', 'myblog');

    if($db->connect_errno) {
        die('Connection Failed.');
    }