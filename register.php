<?php require_once "config.php"; ?>
<?php require_once('inc/registration_login.php') ?>
<?php require_once('inc/head_section.php') ?>


<body>
    <?php
    require_once("inc/navigation.php")
    ?>
    <div class="registration">
        <hr style="height:5rem; visibility:hidden;" />
        <h2>New User Registation</h2>
        <p>Please fill this form to create an account.</p>
        <form action="register.php" method="post">
            <?php include('inc/errors.php')
            ?>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username;
                                                                                ?>">
            </div>
            <div class="form-group">
                <label>E-mail:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email;
                                                                                ?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="reg_user" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
    <hr style="height:5rem; visibility:hidden;" />

    <?php require_once('inc/footer.php') ?>

</body>