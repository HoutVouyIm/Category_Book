<?php
    include "db_connect.php";
    
    $id = "";
    if($_SERVER["REQUEST_METHOD"] == 'GET'){
        if(!isset($_GET['book_id'])){
            header('location:/Category_Book/book.php');
            exit();
        }

        $id = $_GET['book_id'];
        $sql = "SELECT * FROM `book_tb` WHERE id=$id ";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        while(!$row){
            header('location:/Category_Book/book.php');
            exit();
        }

        //Find Category
        $sql_category = "SELECT category_tb.category_name, category_tb.id FROM category_tb 
        JOIN category_book_tb ON category_tb.id = category_book_tb.category_id
        WHERE category_book_tb.book_id = '$id'";

        $result_category = $conn->query($sql_category);
        $row_category = $result_category->fetch_assoc();
        // echo($row_category['category_name']);
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
</head>
<body>
    <a href="./book.php">Back</a>
    <h1>Update Book</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title </label>
        <input type="text" name="txt_title" value="<?php echo $row['title']; ?>" id=""><br><br>

        <label>Upload Image</label>
        <input type="file" name="image" accept=".jpg, .jpeg, .png" id=""><br><br>

        <label>Category</label>
        <?php
            $sql1 = "SELECT id, category_name FROM `category_tb`";
            $ca_results = mysqli_query($conn, $sql1);
        ?>

        <select name="category_id">
            <?php foreach($ca_results as $row1) : ?>
                <option value="<?php echo $row1['id']; ?>" <?php echo ($row1['id'] == $row_category['id']) ? 'selected' : ''; ?>>
                    <?php echo $row1['category_name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Descriptions </label>
        <input type="text" name="txt_des" value="<?php echo $row['description']; ?>" id=""><br><br>

        <button type="submit" name="btn_update_book">Update Book</button>
    </form>
</body>
</html>