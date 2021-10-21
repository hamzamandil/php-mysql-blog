<?php 
    require 'config/db.php';

    $posts = array();

    if($result = $db->query("SELECT P.*, U.username FROM post P inner join user U on P.user_id = U.id")) {
        if($result->num_rows > 0) {
            $posts = $result->fetch_all(MYSQLI_ASSOC);
        }
    }
?>
    <?php require 'inc/header.php'; ?>

    <div class="container py-3">
        <?php if(count($posts) > 0): ?>
            <?php foreach($posts as $post): ?>
                <div class="row">
                    <div class="col-sm-8 mx-auto">
                        <div class="card my-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $post["title"]; ?></h5>
                                <p class="card-text">Created At <?php echo $post["created_at"]; ?></p>
                                <p><span style="opacity: 0.7;">Posted By </span><?php echo $post["username"]; ?></p>
                                <a href="post.php?id=<?php echo $post["id"]; ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h3 class="text-center">There is no posts</h3>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>