<?php 
    session_start();

    require 'config/db.php';

    $errMsg = '';

    if(isset($_POST)) {
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $prepare = $db->prepare("SELECT * FROM user WHERE username = ?");

            $prepare->bind_param('s', $username);

            $prepare->execute();

            $prepare->bind_result($id, $user, $pass);

            $prepare->fetch();

            if($user === $username) {
                $errMsg = "Username Not Available. Try Again.";
            } else {
                $prepare = $db->prepare("INSERT INTO user(username, password) VALUES(?, ?)");

                $prepare->bind_param('ss', $username, $password);

                if($prepare->execute()) {
                    header('Location: /myblog/login.php');
                }
            }
        }
    }

?>
    <?php require 'inc/header.php'; ?>

        <div class="container form-wrapper my-5">
            
            <form action="" method="POST" class="login p-5 shadow rounded">
                <?php if($errMsg !== ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errMsg; ?>
                    </div>
                <?php endif; ?>
                <h3 class="text-center mb-2">Sign Up</h3>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>