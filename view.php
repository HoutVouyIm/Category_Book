<?php
    include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <style>
        .container{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <?php
                $sql = "SELECT * FROM `category_tb`";
                $ca_results = mysqli_query($conn, $sql);
            ?>
            <h3>
                <?php foreach($ca_results as $row) : ?>
                    <a href="?category_id=<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></a>
                    <br/>
                <?php endforeach; ?>
            </h3>
           
        </div>

        
        <div>
            <h1>Books</h1>

            <ul>
                <?php
                if (isset($_GET['category_id'])) {
                    $category_id = $_GET['category_id'];
                    $sql_books = "SELECT book_tb.title FROM book_tb 
                    JOIN category_book_tb ON book_tb.id = category_book_tb.book_id 
                    WHERE category_book_tb.category_id = '$category_id'";
                    $result_books = mysqli_query($conn, $sql_books);
                    while ($row_book = mysqli_fetch_assoc($result_books)) {
                        echo "<li>{$row_book['title']}</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>