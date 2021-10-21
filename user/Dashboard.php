<?php 
    session_start();

    $posts = array();

    if(isset($_SESSION["username"])) {
        $id = $_SESSION["id"];

        require '../config/db.php';

        if($result = $db->query("SELECT * FROM post WHERE user_id = {$id}")){
            if($result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                $posts = $rows;
            }
        } else {
            die('ERROR: '.$db->error);
        }

        if(isset($_POST['delete'])) {
            $delete_id = $_POST['delete_id'];

            if($db->query("DELETE FROM post WHERE id = {$delete_id}")) {
                echo "<script>alert('Post deleted with success');</script>";
                header('Location: /myblog/user/Dashboard.php');
            } else {
                die('ERROR: '.$db->error);
            }

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
            <h2 class="text-center pb-3">All Posts</h2>
            <?php if(count($posts) > 0): ?>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>created at</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post): ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['created_at']; ?></td>
                        <td><a href="/myblog/user/edit-post.php?id=<?php echo $post['id'] ?>" class="btn btn-success">Edit</a></td>
                        <td><form action="" method="POST"><input type="hidden" name="delete_id" value="<?php echo $post['id'] ?>"><input type="submit" value="Delete" name="delete" class="btn btn-danger"></form></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>You dont have posts</p>
            <?php endif; ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>