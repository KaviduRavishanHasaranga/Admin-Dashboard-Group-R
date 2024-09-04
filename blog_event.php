<?php
include 'assets\components\nevigationbar.php'; 
include 'assets\components\mainside.php';
include 'assets/config/connection.php';
?>

<!-- Blog-Event admin panel UI top-->
<section class="blog-form">   <!--add blog post-->
        <h2>ADD BLOG POST</h2>
        <form id="blogForm" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="blogTitle" required>
            
            <label for="content">Content:</label>
            <textarea id="content" name="blogContent" rows="4" required></textarea>
            
            <button type="submit" name="blogSubmit">Add Post</button>
        </form>
</section>

<section class="blog-form">   <!--add event post-->
        <h2>ADD EVENT POST</h2>
        <form id="eventForm" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="eventTitle" required>
            
            <label for="insertImage">Add Your Images:</label>   <!--Add your images here related to event post-->
            <input type="file" name="choose_img" id="insertImage">

            <label for="content">Content:</label>
            <textarea id="content" name="eventContent" rows="4" required></textarea>
            
            <button type="submit" name="eventSubmit">Add Post</button>
        </form>
</section>
 <!-- Blog-Event admin panel UI bottom-->

<?php
include 'assets\components\footer.php'; 
?>


<?php
    
    if (isset($_POST["blogSubmit"])){   
        $b_title = $_POST["blogTitle"];
        $b_content = $_POST["blogContent"];

        $stmt = $conn->prepare("INSERT INTO blog (title, content) VALUES (?,?)");   //insert user inserted blog post data into database
        $stmt->bind_param("ss", $b_title, $b_content);
        $stmt->execute();
    }

    if (isset($_POST["eventSubmit"])){   
        $e_title = $_POST["eventTitle"];
        $e_content = $_POST["eventContent"];
        $img = null;

        if (isset($_FILES['choose_img']) && $_FILES['choose_img']['error'] == 0){
           // Read the image file and escape special characters
            $img = file_get_contents($_FILES['choose_img']['tmp_name']);
        }
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO events(event_title, event_images, event_content) VALUES(?,?,?)");   
        $stmt->bind_param("sss", $e_title, $img, $e_content);
        $stmt->send_long_data(1, $img); // For handling large blobs
        $stmt->execute();
        $stmt->close();
        
    }

    $conn->close();


?>

