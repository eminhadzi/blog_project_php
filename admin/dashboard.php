<?php require_once("../config.php"); ?>
<?php if (!$_SESSION['AdminIsLogged']) {
    header('Location:' . BASE_URL . 'index.php');
    exit(0);
} ?>
<?php require_once('inc/head_section.php') ?>

<title>Admin | Dashboard</title>
</head>

<body>
    <?php require_once("../inc/navigation.php"); ?>

    <div class="dashboard_container">
        <h1>Hello <span style="color: #007bff;"> <?php if (isset($_SESSION['user'])) echo ($_SESSION['user']['user_username']) ?></span>, <br> Welcome to your Dashboard</h1>
        <hr>

        <h2 class="dashboard_subheading">Manage <span style="color: #007bff;">DailyNews</span> Website</h2>
        <div id="dashboard_cards">
            <div class="row  justify-content-center">
                <div class="col-sm-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Manage News</h5>
                            <p class="card-text">Manage and publish your news.</p>
                            <a href="posts.php" class="btn btn-primary">Posts</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Manage Comments</h5>
                            <p class="card-text">Manage comments of the news article.</p>
                            <a href="comments.php" class="btn btn-primary">Comments</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text">Manage users and administrators of the page.</p>
                            <a href="users.php" class="btn btn-primary">Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="dashboard_subheading">Latest News</h2>

        <?php
        $post = new News();
        $post->dashboardGetLatestPost();
        ?>

        <h2 class="dashboard_subheading">Latest Comments</h2>

        <div class="dashboard_comments">
            <div class="list-group">
                <?php $comments = new Comments();
                $comments->getAllComments(3) ?>
            </div>
        </div>


    </div>

    <?php require_once('../inc/footer.php') ?>

</body>