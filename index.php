<?php
require_once "config.php";
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
                <div class="title mt-4 text-center">
                    <h2>Recent News</h2>
                </div>
                <div class="row row-cols-1 row-cols-md-3 mt-5 px-4">

                    <?php
                    $news = new News;
                    $news->displayAllNews();
                    ?>

                </div>
            </div>

        </div>


    </div>
    <?php require_once('inc/footer.php') ?>
</body>