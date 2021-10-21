<?php
    error_reporting(0);
    require 'config/db.php';

    $post = array();

    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $db->real_escape_string(trim($_GET["id"]));

        if($result = $db->query("SELECT * FROM post where id = {$id}")) {
            $post = $result->fetch_assoc();
        } else {
            die('ERROR');
        }
            

    }

?>
    <?php require 'inc/header.php'; ?>

    <div class="container py-3">
        <?php if(count($post) > 0): ?>
            <div class="row">
                    <div class="col-md-10 mx-auto my-5 p-3">
                        <h1><?php echo $post["title"]; ?></h1>
                        <p><?php echo $post["body"]; ?></p>
                        <p><small>Created at </small><?php echo $post["created_at"]; ?></p>
                    </div>
            </div>
        
        <?php else: ?>
            <h3 class="text-center">There is no posts</h3>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>