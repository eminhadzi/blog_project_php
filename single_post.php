<?php require_once('config.php') ?>
<?php

if (isset($_GET['news-slug'])) {
    $post = new News();
    $post = $post->getSinglePost($_GET['news-slug']);
}
?>
<?php require_once('inc/head_section.php') ?>

<body>
    <?php require_once('inc/navigation.php') ?>
    <?php require_once('inc/subheader.php') ?>
    <div id="wrap">
        <div id="post-container">

            <div id="post-img" class="text-center">
                <img src="images/news<?php echo ($post['news_image_id']) ?>.jpg" alt="Post Image" class="singlepost-img img-fluid mt-4">
                <hr>
            </div>

            <div class="title mt-5">
                <h1><?php echo ($post['news_title']); ?></h1>
            </div>

            <div class="excerpt pr-5">
                <p><?php echo ($post['news_excerpt']) ?></p>
            </div>
            <div class="body">
                <p><?php echo nl2br($post['news_content']) ?></p>
            </div>
            <div class="post-created">
                <p>Published: <?php echo ($post['news_date']) ?></p>
            </div>
        </div>

        <?php
        if (isset($_SESSION['user'])) {
            $url = 'single_post.php?news-slug=' . $_GET['news-slug'];
        ?>
            <form action="<?php echo ($url) ?>" method="POST">
                <div class="form-group mx-auto comment_area">
                    <label for="commentArea">
                        <h4>Leave your comment: </h4>
                    </label>
                    <textarea class="form-control" id="commentArea" name="commentArea" rows="3" maxlength="250"></textarea>
                    <input class="btn btn-primary pt-2 mt-2 btn-block" name="submit_comment" type="submit" value="Submit">
                </div>
            </form>
        <?php
        } else {
        ?>
            <div class="alert alert-light text-center" role="alert">
                Please <a href="login.php">login</a> or <a href="register.php">register</a> to leave a comment.
            </div>
        <?php
        }
        ?>

        <div class="dashboard_comments">
            <div class="list-group">
                <h2 class="dashboard_subheading">All Comments:</h2>
                <?php
                $comments = new Comments();
                if (isset($_POST['submit_comment'])) {
                    $comment_content = trim($_POST['commentArea']);
                    $user_id = $_SESSION['user']['user_id'];
                    $news_id = $post['news_id'];
                    $comments->insertComment($comment_content, $user_id, $news_id);
                }
                $comments->getNewsComments($post['news_id']);
                ?>
            </div>
        </div>
    </div>
    <?php require_once('inc/footer.php') ?>
</body>