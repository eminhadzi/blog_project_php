<?php
class Users
{
    public function getAllUsers()
    {
        global $pdo;
        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll();
?>
        <div class="dashboard_users">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) {
                    ?>

                        <tr>
                            <th scope="row"><?php echo $user['user_id']; ?></th>
                            <td><?php echo $user['user_username']; ?></td>
                            <td><?php echo $user['user_email']; ?></td>
                            <td><?php echo $user['user_role']; ?></td>
                            <td><span><a href=<?php echo BASE_URL . 'admin/inc/removeResult.php?id=' . $user['user_id'] ?>><img src=<?php echo BASE_URL . 'images/remove-x.png' ?> alt="Remove" class="remove-img"></a></span></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
<?php
    }
}
