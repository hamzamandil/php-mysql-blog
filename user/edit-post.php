<?php 
    session_start();
    
    require '../config/db.php';

    $msgErr = '';
    $post = array();

    if(isset($_SESSION["username"])) {
        if(isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = trim($_GET["id"]);

             if($result = $db->query("SELECT * FROM post WHERE id = {$id}")){
                if($result->num_rows) {
                    $row = $result->fetch_assoc();
                    $post = $row;
                }
            } else {
                die('ERROR: '.$db->error);
            }
            if(isset($_POST)) {
                if(!empty($_POST['title']) && !empty($_POST['body'])) {
                    $title = trim($_POST['title']);
                    $body = trim($_POST['body']);
                    //$id = $_SESSION["id"];
                    
            
                    $result = $db->prepare("UPDATE post SET title = ?, body = ? WHERE id = ?");
                    $result->bind_param('ssi', $title, $body, $id);

                
    
                    if($result->execute()) {
                        header('Location: /myblog/user/Dashboard.php');
                    } else {
                        $msgErr = "Error: Please Try Again.";
                    }
                }
            }
        } else {
            header('Location: /myblog/user/Dashboard.php');
        }
    


    } else {
        header('Location: /myblog/login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myBlog | Dashboard</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/zephyr/bootstrap.css">
    <link rel="stylesheet" href="http://localhost/myblog/styles/main.css">
</head>
<body>

    <?php include '../inc/Dashboard-header.php' ?>

        <div class="container pt-5">
            <h2 class="text-center pb-3">Edit Post</h2>
            <?php if($msgErr !== ''): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $msgErr; ?>
                </div>
            <?php endif; ?>
            <?php if(count($post) !== 0): ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post["title"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" placeholder="Post Body..." id="body" style="height: 100px" name="body"><?php echo $post["body"]; ?></textarea>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            <?php else: ?>
                <h3>No Post Found with this id</h3>
            <?php endif; ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>