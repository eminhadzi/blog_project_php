<?php
$username = "";
$email = "";
$errors = array();

if (isset($_POST['reg_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password1 = trim($_POST['password']);
    $password2 = trim($_POST['confirm_password']);
    $user_role = trim($_POST['user_role']);

    if (empty($username)) {
        array_push($errors, "Username is required.");
    }
    if (empty($email)) {
        array_push($errors, "Email is required.");
    }
    if (empty($password1)) {
        array_push($errors, "Password is required.");
    } elseif (strlen($password1) <= 6) {
        array_push($errors, "Password must have at least 6 characters.");
    }

    if ($password1 != $password2) {
        array_push($errors, "Password does not match.");
    }

    if (empty($errors)) {
        global $pdo;
        $user_check_query = $pdo->prepare("SELECT * FROM users WHERE user_username = ? OR user_email = ? LIMIT 1");
        $user_check_query->execute([$username, $email]);
        $user = $user_check_query->fetch();

        if ($user) {
            if ($user['user_username'] === $username) {
                array_push($errors, "Username already exists.");
            }
            if ($user['user_email'] === $email) {
                array_push($errors, "Email already exists.");
            }
        }

        if (empty($errors)) {
            $password = md5($password1);
            $stmt = $pdo->prepare("INSERT INTO users (user_username, user_email, user_password, user_role) VALUES (?, ?, ?, ?);");
            $res = $stmt->execute([$username, $email, $password, $user_role]);

            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            User created successfully!
          </div>';
            header('location: users.php');
            exit(0);
        }
    }
}

if (isset($_POST['create_post'])) {

    if (!empty($_POST['post_title']) && !empty($_POST['post_excerpt']) && !empty($_POST['post_content'])) {
        $post_title = trim($_POST['post_title']);
        $post_excerpt = $_POST['post_excerpt'];
        $post_content = $_POST['post_content'];
        $post_category = $_POST['post_category'];
        switch ($post_category) {
            case 'Technology':
                $post_category = 1;
                break;
            case 'Politics':
                $post_category = 2;
                break;
            case 'Sport':
                $post_category = 3;
                break;
            case 'Entertainment':
                $post_category = 4;
                break;
        }

        $target_directory = $_SERVER['DOCUMENT_ROOT'] . '/NewsApp/images/';
        $image_count = 0;
        $dir_images = glob($target_directory . "*.{jpg,jpeg}", GLOB_BRACE);
        if ($dir_images) {
            $image_count = count($dir_images) + 1;
        }
        $file_name = $_FILES['post_image']['name'];
        $file_tmp = $_FILES['post_image']['tmp_name'];
        $file_type = $_FILES['post_image']['type'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_truename = 'news' . $image_count . '.' . $file_ext;

        $extensions = array("jpeg", "jpg");

        if (!in_array($file_ext, $extensions)) {
            array_push($errors, "Please choose a valid JPEG file.");
        }

        if (empty($errors) == true) {
            if (move_uploaded_file($file_tmp, $target_directory . $file_truename)) {
                $post = new News();
                $post->createPost($post_title, $post_excerpt, $post_content, $post_category, $image_count);
            } else {
                array_push($errors, "Upload failed!");
            }
        }
    } else {
        array_push($errors, "Please fill all the fields.");
    }
}
