<?php
    include "db_connect.php";
    if(isset($_GET['book_id'])){
        $id = $_GET['book_id'];

        //Delete Book From Table category_book_tb
        $sql = "DELETE FROM `category_book_tb` WHERE book_id='$id'";
        $conn->query($sql);

        // Retrieve the image filename from the database
        $sql1 = "SELECT image FROM `book_tb` WHERE id='$id'";
        $result = $conn->query($sql1);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imageFilename = $row['image'];

            // Delete the image file from the directory
            $imagePath = 'img/' . $imageFilename;
            if(file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
        }

        //Delete Book From Table Book_tb
        $sql2 = "DELETE FROM `book_tb` WHERE id='$id' ";
        $result = $conn->query($sql2);
    }
    header('location:/Category_Book/book.php');
    exit();
?>