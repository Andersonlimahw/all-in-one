<?php
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("falha na conexão...");
} 
$select_db = mysqli_select_db($con, 'all-in-one');
if (!$select_db) {
    die("banco não existe...");
} 

