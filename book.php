<?php
    include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <style>
        td img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <a href="./add_book.php">Add Book</a>
    </br></br>
    <h1>Book Information</h1>
    <table border = 1 cellspacing = 0 cellpadding = 10>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Image</th>
            <th>Description</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
            $i = 1;
            $rows =  mysqli_query($conn, "SELECT * FROM `book_tb` ORDER BY id DESC ");
        ?>

        <?php foreach($rows as $row) : ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><img src="img/<?php echo $row['image']; ?>" alt="" /></td>
                <td><?php echo $row['description'] ?></td>
                <td>
                    <a href="update_book.php?book_id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete_book.php?book_id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>