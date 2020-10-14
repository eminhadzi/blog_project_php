<?php
class Comments
{
    public function getAllComments($limit = 184467440737095516)
    {
        global $pdo;
        $query = "SELECT users.user_username, news.news_title, news.news_slug, comments.user_id , comments.comment_id , comments.comment_content, comments.comment_time, comments.news_id FROM users, news, comments WHERE comments.news_id = news.news_id AND comments.user_id = users.user_id ORDER BY comments.comment_time DESC LIMIT {$limit}";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $comments = $stmt->fetchAll();

        foreach ($comments as $comment) {
?>
            <div class="d-flex pb-3">
                <a href="<?php echo BASE_URL . 'single_post.php?news-slug=' . $comment['news_slug'] ?>" class="list-group-item list-group-item-action mr-1">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-muted"><?php echo ($comment['news_title']) ?></h5>
                        <small><?php echo ($comment['comment_time']) ?></small>
                    </div>
                    <p id="user_comment"><?php echo ($comment['user_username']) ?> | Commented:</p>
                    <p class=" mb-1 comment"><?php echo ($comment['comment_content']) ?></p>
                </a>


                <a class="btn btn-danger ml-1" href=<?php echo BASE_URL . 'admin/inc/removeComment.php?id=' . $comment['comment_id'] ?> role="button">Delete</a>
            </div>

        <?php
        }
    }

    public function getNewsComments($news_id)
    {
        global $pdo;
        $query = "SELECT users.user_username, comments.comment_id , comments.comment_content, comments.comment_time, comments.news_id FROM users, comments WHERE comments.news_id = {$news_id} AND comments.user_id = users.user_id ORDER BY comments.comment_time DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $comments = $stmt->fetchAll();

        foreach ($comments as $comment) {
        ?>
            <div class="d-flex pb-3">
                <a href="#" class="list-group-item list-group-item-action mr-1">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1 comment"><?php echo ($comment['comment_content']) ?></p>
                        <small><?php echo ($comment['comment_time']) ?></small>
                    </div>
                    <p id="user_comment" class="text-muted"><?php echo ($comment['user_username']) ?> | Commented</p>
                </a>

                <?php
                if (!empty($_SESSION)) {
                    if (in_array($_SESSION['user']['user_username'], [$comment['user_username']]) || in_array($_SESSION['user']['user_role'], ["Admin"])) {
                ?>
                        <a class="btn btn-danger ml-1" href=<?php echo BASE_URL . 'admin/inc/removeComment.php?id=' . $comment['comment_id'] ?> role="button">Delete</a>
                <?php
                    }
                } ?>

            </div>
<?php
        }
    }

    public function insertComment($comment_content, $user_id, $news_id)
    {
        $comment_time = date("Y-m-d H:i:s");

        global $pdo;
        $query = "INSERT INTO comments (comment_content, comment_time, news_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$comment_content, $comment_time, $news_id, $user_id]);
    }
}
