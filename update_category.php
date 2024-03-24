<?php 
    include "db_connect.php";

    $id = "";
    $ncategory = "";

    if($_SERVER["REQUEST_METHOD"] == 'GET'){
        if(!isset($_GET['categoryId'])){
            header('location:/Category_Book/category.php');
            exit();
        }

        $id = $_GET['categoryId'];
        $sql = "SELECT * FROM `category_tb` WHERE id=$id ";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        while(!$row){
            header('location:/Category_Book/category.php');
            exit();
        }

        $ncategory = $row['category_name'];
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
</head>
<body>
    <a href="./category.php">Back</a>
    <h1>Update Category</h1>
    <form action="" method="POST">
       
        <label>Category Name </label>
        <input type="text" name="txt_category" value="<?php echo $ncategory; ?>" id=""><br>

        <input type="hidden" name="txt_id" value="<?php echo $id; ?>">

        <button type="submit" name="btn_update">Update</button>
    </form>
</body>
<?php
    if(isset($_POST['btn_update'])){
        $id = $_POST['txt_id'];
        $ncategory = $_POST['txt_category'];

        $update = "UPDATE category_tb SET category_name = '$ncategory' WHERE id='$id' ";
        $data = $conn->query($update);

        if($data){
            echo "Update Sucessfully";
            header('location:/Category_Book/category.php');
            exit();
        }else{
            echo "Sorry You Can Not Update!!";
        }
    }
?>
</html>