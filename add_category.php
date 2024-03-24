<?php
    include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
    <a href="./category.php">Back</a>
    <h1>Add Category</h1>
    <form action="" method="POST">

        <label> Category Name </label>
        <input type="text" name="txt_category" id=""><br><br>

        <button type="submit" name="submit">Add</button>

    </form>
</body>
<?php
    if(isset($_POST['submit'])){
        $ncategory = $_POST['txt_category'];

        $insert = "INSERT INTO `category_tb` (`category_name`) VALUES ('$ncategory') ";
        $query = $conn->query($insert);

        if($query){
            echo "Add Category Successfully";
            header('location:/Category_Book/category.php');
        }
    }
?>
</html>