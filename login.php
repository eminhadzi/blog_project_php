<?php require_once "config.php"; ?>
<?php require_once('inc/registration_login.php') ?>
<?php require_once('inc/head_section.php') ?>

<body>
    <?php
    require_once("inc/navigation.php")
    ?>
    <div class="login">
        <hr style="height:5rem; visibility:hidden;" />
        <h2>Sign In</h2>
        <p>Please fill this form to sign in.</p>
        <form action="login.php" method="post">
            <?php include('inc/errors.php') ?>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username;
                                                                                ?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="login_btn" value="Submit">
            </div>
            <p>Not yet a member? <a href="register.php">Sign up</a></p>
        </form>
    </div>
    <hr style="height:5rem; visibility:hidden;" />

    <?php require_once('inc/footer.php') ?>

</body>