<?php require_once("../config.php"); ?>
<?php if (!$_SESSION['AdminIsLogged']) {
    header('Location:' . BASE_URL . 'index.php');
    exit(0);
} ?>
<?php require_once("inc/admin_functions.php"); ?>
<?php require_once('inc/head_section.php') ?>


<title>Admin | Edit Users</title>
</head>

<body>


    <?php require_once("../inc/navigation.php"); ?>

    <div class="sidenav">
        <a href="dashboard.php">Dashboard</a>
        <a href="posts.php">Posts</a>
        <a href="users.php">Users</a>
        <a href="comments.php">Comments</a>
    </div>

    <h2 class="dashboard_subheading">All Users</h2>
    <hr id="header_title" style="visibility:hidden;">
    <?php
    $users = new Users();
    $users->getAllUsers();
    ?>
    <h2 class="dashboard_subheading">Create New User</h2>

    <div class="registration">
        <form action="users.php" method="post">
            <?php include('inc/errors.php') ?>
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
                <label for="user_role">Role:</label>
                <select class="form-control" name="user_role" id="user_role">
                    <option>User</option>
                    <option>Admin</option>
                </select>
            </div>
            <div class="form-group pt-3">
                <input type="submit" class="btn btn-primary" name="reg_user" value="Register">
                <input type="reset" class="btn btn-dark" value="Reset">
            </div>
        </form>
    </div>

    <?php require_once('../inc/footer.php') ?>

</body>