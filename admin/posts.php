<?php require_once("../config.php"); ?>
<?php if (!$_SESSION['AdminIsLogged']) {
    header('Location:' . BASE_URL . 'index.php');
    exit(0);
} ?>
<?php require_once("inc/admin_functions.php"); ?>
<?php require_once('inc/head_section.php') ?>


<title>Admin | Edit Posts</title>
</head>

<body>

    <?php require_once("../inc/navigation.php"); ?>

    <div class="sidenav">
        <a href="dashboard.php">Dashboard</a>
        <a href="posts.php">Posts</a>
        <a href="users.php">Users</a>
        <a href="comments.php">Comments</a>
    </div>
    <div class="container" style="margin-top:20px;">
        <?php include('inc/errors.php') ?></div>
    <div class="registration">
        <hr style="height:1rem; visibility:hidden;" />
        <h2 class="dashboard_subheading">Create new post</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Post Title:</label>
                <input type="text" name="post_title" class="form-control" placeholder="Enter a post title...">
            </div>
            <div class="form-group">
                <label>Post Excerpt:</label>
                <textarea name="post_excerpt" class="form-control" placeholder="Enter a maximum of 200 words..." maxlength="200" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Post Content:</label>
                <textarea name="post_content" class="form-control" placeholder="Enter the content of your post..." rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Post Category:</label>
                <select class="form-control" name="post_category" id="post_category">
                    <option>Technology</option>
                    <option>Politics</option>
                    <option>Sport</option>
                    <option>Entertainment</option>
                </select>
            </div>
            <div class="form-group">
                <label>Post Image:</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="post_image" name="post_image">
                    <label class="custom-file-label" for="post_image">Choose a post image...</label>
                </div>
            </div>
            <div class="form-group pt-2 float-right">
                <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
                <input type="reset" class="btn btn-dark" value="Reset">
            </div>
        </form>

    </div>
    <hr>
    <h2 class="dashboard_subheading" id="news_list">News List</h2>
    <div class="list-post-container">
        <hr style="height:2rem; visibility:hidden;" />
        <?php $news = new News();
        $news->displayNewsList(); ?>
    </div>
    <hr style="height:20rem; visibility:hidden;" />
    <?php require_once('../inc/footer.php') ?>



    <script>
        //DISPLAY FILENAME WHEN UPLOADED

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

</body>