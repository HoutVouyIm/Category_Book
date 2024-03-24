<?php
    include "db_connect.php";

    if(isset($_GET['categoryId'])){
        $id = $_GET['categoryId'];
        $sql = "DELETE FROM `category_tb` WHERE id='$id'";
        $result = $conn->query($sql);
    }
    header('location:/Category_Book/category.php');
    exit();
?>