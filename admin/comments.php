<?php require_once("../config.php"); ?>
<?php if (!$_SESSION['AdminIsLogged']) {
    header('Location:' . BASE_URL . 'index.php');
    exit(0);
} ?>
<?php require_once("inc/admin_functions.php"); ?>
<?php require_once('inc/head_section.php') ?>


<title>Admin | Edit Comments</title>
</head>

<body>

    <?php require_once("../inc/navigation.php"); ?>

    <div class="sidenav">
        <a href="dashboard.php">Dashboard</a>
        <a href="posts.php">Posts</a>
        <a href="users.php">Users</a>
        <a href="comments.php">Comments</a>
    </div>

    <div class="dashboard_comments">
        <div class="list-group">
            <h2 class="dashboard_subheading" id="comments_anchor">All Comments</h2>
            <?php $comments = new Comments();
            $comments->getAllComments(); ?>
        </div>
    </div>
    <hr style="height:20rem; visibility:hidden;" />
    <?php require_once('../inc/footer.php') ?>

</body>