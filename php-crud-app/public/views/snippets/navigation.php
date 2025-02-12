<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/UOBSAlumani/php-crud-app/public/index.php">UOBS Alumni</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/jobs">Jobs</a></li>
            <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/blogs">Blogs</a></li>
            <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/news">News</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/logout">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="/UOBSAlumani/php-crud-app/public/login">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>