<?php
$username = "";
$email = "";
$errors = array();

if (isset($_POST['reg_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password1 = trim($_POST['password']);
    $password2 = trim($_POST['confirm_password']);

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
            $stmt = $pdo->prepare("INSERT INTO users (user_username, user_email, user_password) VALUES (?, ?, ?);");
            $res = $stmt->execute([$username, $email, $password]);

            $reg_user_id = $pdo->lastInsertId();

            $_SESSION['user'] = getUserById($reg_user_id);

            if (in_array($_SESSION['user']['user_role'], ["Admin"])) {
                $_SESSION['message'] = "You are logged in!";
                $_SESSION['AdminIsLogged'] = true;
                header('Location: ' . BASE_URL . 'admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "You are logged in!";
                header('Location:' . BASE_URL . 'index.php');
                exit(0);
            }
        }
    }
}

if (isset($_POST['login_btn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username required.");
    }
    if (empty($password)) {
        array_push($errors, "Password required.");
    }
    if (empty($errors)) {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE user_username = :username AND user_password = :password";
        $stat = $pdo->prepare($sql);
        $stat->bindParam(":username", $username, PDO::PARAM_STR);
        $stat->bindParam(":password", $password, PDO::PARAM_STR);
        $stat->execute();
        $result = $stat->fetch();

        if ($result) {
            $reg_user_id = $result['user_id'];
            $_SESSION['user'] = getUserById($reg_user_id);

            if (in_array($_SESSION['user']['user_role'], ["Admin"])) {
                $_SESSION['message'] = "You are logged in!";
                $_SESSION['AdminIsLogged'] = true;
                header('Location: ' . BASE_URL . 'admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "You are logged in!";
                header('Location:' . BASE_URL . 'index.php');
                exit(0);
            }
        } else {
            array_push($errors, 'Wrong Credentials.');
        }
    }
}

function getUserById($id)
{
    global $pdo;
    $query = $pdo->query("SELECT * FROM users WHERE user_id=$id LIMIT 1");
    $user = $query->fetch();
    return $user;
}
