<?php
    include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data Category</title>
</head>
<body>

    <a href="./add_category.php">Add</a>
    </br></br>
    <h1>Category Form</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $sql = "SELECT * FROM category_tb";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[category_name]</td>
                            <td>
                                <a href='update_category.php?categoryId=$row[id]'>Edit</a>
                                <a href='delete_category.php?categoryId=$row[id]'>Delete</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</body>
</html>