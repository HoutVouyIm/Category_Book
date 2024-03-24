<?php
    include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
</head>
<body>
    <a href="./book.php">Back</a>
    <h1>Add Information Book</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Title </label>
        <input type="text" name="txt_title" id=""><br><br>

        <label>Upload Image</label>
        <input type="file" name="image" accept=".jpg, .jpeg, .png" id=""><br><br>

        <label>Category</label>
        <?php
            $sql = "SELECT id, category_name FROM `category_tb`";
            $ca_results = mysqli_query($conn, $sql);
        ?>

        <select name="category_id">
            <?php foreach($ca_results as $row) : ?>
                
                    <option value="<?php echo $row['id']; ?>" name="">
                        <?php echo $row['category_name']; ?>
                    </option>
                
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Descriptions </label>
        <input type="text" name="txt_des" id=""><br><br>

        <button type="submit" name="btn_add_book">Add Book</button>
    </form>
</body>
<?php
    if(isset($_POST['btn_add_book'])){
        $title = $_POST['txt_title'];
        $des = $_POST['txt_des'];
        if($_FILES["image"]["error"] === 4){
            echo "
                <script> alert('Image Does Not Exist'); </script>
            ";
        }else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName  = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg','jpeg','png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if(!in_array($imageExtension, $validImageExtension)){
                echo "
                    <script> alert('Invalid Image Extension'); </script>
                ";
            }else if($fileSize > 1000000){
                echo "
                    <script> alert('Image Size Is Too Large'); </script>
                ";
            }else{
                $newImageName = uniqid();
                $newImageName .='.'.$imageExtension;

                move_uploaded_file($tmpName, 'img/'. $newImageName);
                $query = "INSERT INTO `book_tb` (`title`, `image`, `description`) VALUES('$title','$newImageName','$des')";
                mysqli_query($conn, $query);

                // Retrieve the last inserted book ID
                $book_id = mysqli_insert_id($conn);

                // Now $lastInsertedId contains the ID of the last inserted record
                // echo "Last inserted ID: ".$book_id;

                // Retrieve the category ID from the form submission
                $category_id = $_POST['category_id'];

                // echo "Category Id : ".$category_id;
                //Insert into Category_Book_tb 
                $query2 = "INSERT INTO `category_book_tb` (`category_id`,`book_id`) VALUES('$category_id','$book_id') ";
                mysqli_query($conn,$query2);

                echo "
                    <script> 
                        alert('Successfully Added'); 
                        document.location.href = 'book.php';
                    </script>
                ";
            }
        }
    }
?>
</html>