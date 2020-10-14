<?php
require_once "config.php";

$news = new News;

?>

<?php require_once('inc/head_section.php') ?>

<body>

    <!-- Navigation -->
    <?php
    require_once("inc/navigation.php")
    ?>

    <!-- Subheader -->
    <?php require_once("inc/subheader.php"); ?>

    <div id="wrap">
        <!-- Container -->
        <div id="container">

            <!-- Recent News -->
            <div id="recent_news">
                <div class="title mt-5 text-center">

                    <h2><?php echo ($news->getCategory($_GET['id'])) ?></h2>

                </div>
                <div class="row row-cols-1 row-cols-md-3 mt-5 px-4">

                    <?php

                    if ($_GET['id'] != "") {
                        $news->displayCategoryNews($_GET['id']);
                    } else {
                        header('Location: index.php');
                    }
                    ?>

                </div>
            </div>

        </div>


    </div>
    <?php require_once('inc/footer.php') ?>
</body>