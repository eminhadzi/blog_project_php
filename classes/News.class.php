<?php
class News
{
    private function newsCard($imgId, $title, $slug, $excerpt)
    {
?>
        <a href="<?php echo BASE_URL . 'single_post.php?news-slug=' . $slug ?>" class="single-card">
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="<?php echo BASE_URL . 'images/news' . $imgId . '.jpg' ?>" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo ($title); ?></h3>
                        <p class="card-text"><?php echo ($excerpt); ?><br></p>
                    </div>
                </div>
            </div>
        </a>
    <?php
    }


    public function displayAllNews()
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM news ORDER BY news_id DESC");
        while ($result = $query->fetch()) {
            $imgId = $result['news_image_id'];
            $title = $result['news_title'];
            $slug = $result['news_slug'];
            $excerpt = $result['news_excerpt'];
            (new News)->newsCard($imgId, $title, $slug, $excerpt);
        }
    }

    public function getCategory($category_id)
    {
        global $pdo;
        $query = $pdo->query("SELECT category_name FROM categories WHERE category_id = {$category_id}");
        while ($result = $query->fetch()) {
            $category_name = $result['category_name'];
        }
        return $category_name;
    }

    public function displayCategoryNews($category_id)
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM news WHERE category_id = {$category_id} ORDER BY news_id DESC");
        while ($result = $query->fetch()) {
            $imgId = $result['news_image_id'];
            $title = $result['news_title'];
            $slug = $result['news_slug'];
            $excerpt = $result['news_excerpt'];
            (new News)->newsCard($imgId, $title, $slug, $excerpt);
        }
    }

    public function getSinglePost($slug)
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM news WHERE news_slug = '$slug'");
        $result = $query->fetch();
        return $result;
    }

    public function dashboardGetLatestPost()
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM news ORDER BY news_id DESC LIMIT 1");
        $result = $query->fetch();
    ?>
        <a href="<?php echo BASE_URL . 'single_post.php?news-slug=' . $result['news_slug'] ?>" <div class="card mx-auto" style="max-height: 600px; max-width: 80%">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?php echo BASE_URL . 'images/news' . $result['news_image_id'] . '.jpg' ?>" class="card-img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($result['news_title']); ?></h5>
                        <p class="card-text"><?php echo ($result['news_excerpt']); ?></p>
                        <p class="card-text"><small class="text-muted">Updated <?php echo ($result['news_date']); ?></small></p>
                    </div>
                </div>
            </div>
            </div>
        </a>
        <?php
    }

    public function displayNewsList()
    {
        global $pdo;
        $query = $pdo->query("SELECT * FROM news ORDER BY news_id DESC");
        while ($result = $query->fetch()) {
            $imgId = $result['news_image_id'];
            $title = $result['news_title'];
            $slug = $result['news_slug'];
            $excerpt = $result['news_excerpt'];

        ?>
            <div class="d-flex pb-3">
                <a href="<?php echo BASE_URL . 'single_post.php?news-slug=' . $slug ?>">
                    <div class="media mb-3 mt-2">
                        <img src="<?php echo BASE_URL . 'images/news' . $imgId . '.jpg' ?>" class="align-self-center mr-3" style="width: 7%;">
                        <div class="media-body">
                            <h5 class="mt-0"><?php echo ($title); ?></h5>
                            <p style="color: #343a40;"><?php echo ($excerpt); ?></p>
                        </div>
                    </div>
                </a>
                <a class="btn btn-danger ml-1" href=<?php echo BASE_URL . 'admin/inc/removeNews.php?id=' . $result['news_id'] ?> role="button">Delete</a>
            </div>
<?php

        }
    }

    public function createPost($post_title, $post_excerpt, $post_content, $post_category, $post_image)
    {
        $news_date = date("Y-m-d H:i:s");
        $string_title = strtolower($post_title);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string_title);

        global $pdo;
        $query = "INSERT INTO news (news_image_id, news_content, category_id, news_title, news_slug, news_excerpt, news_date) VALUES (?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$post_image, $post_content, $post_category, $post_title, $slug, $post_excerpt, $news_date]);
    }
}
