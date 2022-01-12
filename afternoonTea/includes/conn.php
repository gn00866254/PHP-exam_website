<?php
  $server_name = 'localhost';
  $username = 'root';
  $password = '';
  $db_name = 'exam';

  $conn = new mysqli($server_name, $username, $password, $db_name);

  if ($conn->connect_error) {
    die('資料庫連線錯誤：' . $conn->connect_error);
  }  

?>