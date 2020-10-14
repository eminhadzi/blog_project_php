<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href=<?php echo (BASE_URL . 'index.php') ?>>
        <img src=<?php echo BASE_URL . 'images/dn_logo.png' ?> width="150" height="70" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href=<?php echo (BASE_URL . 'index.php') ?>>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=<?php echo (BASE_URL . 'category_page.php?id=1') ?>>Technology</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=<?php echo (BASE_URL . 'category_page.php?id=2') ?>>Politics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=<?php echo (BASE_URL . 'category_page.php?id=3') ?>>Sport</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=<?php echo (BASE_URL . 'category_page.php?id=4') ?>>Entertainment</a>
            </li>
        </ul>

        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        ?>
            <span class="navbar-text pr-3">Welcome <?php echo $_SESSION['user']['user_username'] ?> |
                <?php if (!empty($_SESSION['message'])) {
                    echo ($_SESSION['message']);
                } ?>
            </span>

            <?php if (in_array($_SESSION['user']['user_role'], ["Admin"])) {

            ?>
                <form class="form-inline my-2 pr-1 my-lg-0">
                    <a class="btn btn-primary" href=<?php echo (BASE_URL . 'admin/dashboard.php') ?> role="button">Dashboard</a>
                </form>
            <?php } ?>

            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-light" href=<?php echo (BASE_URL . 'logout.php') ?> role="button">Logout</a>
            </form>
        <?php } else { ?>
            <form class="form-inline my-2 pr-1 my-lg-0">
                <a class="btn btn-light" href=<?php echo (BASE_URL . 'login.php') ?> role="button">Login</a>
            </form>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-light" href=<?php echo (BASE_URL . 'register.php') ?> role="button">Register</a>
            </form>

        <?php } ?>
    </div>
</nav>