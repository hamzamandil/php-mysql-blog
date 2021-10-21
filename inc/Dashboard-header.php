
    <div class="d-flex align-items-start justify-content-start">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="min-height: 100vh; width: 280px;">
        <a href="/myblog/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">MyBlog</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="/myblog/user/Dashboard.php" class="nav-link text-white">
            All Posts
            </a>
        </li>
        <li>
            <a href="/myblog/user/add-post.php" class="nav-link text-white">
            Add Post
            </a>
        </li>
        <li>
            <a href="/myblog/user/logout.php" class="nav-link text-white">
            Log out
            </a>
        </li>
        </ul>
        <hr>
        
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>

        </div>