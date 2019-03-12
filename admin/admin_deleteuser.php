<?php 
    require_once('scripts/config.php');
    confirm_logged_in();

    // TODO: pull all users from tbl_user
    // save the result to be an array $users
    $tbl = 'tbl_user';
    $users = getAll($tbl);

    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Time to destroy some lives...</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Detele</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user = $users->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><?php echo $user['user_id'];?></td>
                <td><?php echo $user['user_name'];?></td>
                <td><?php echo $user['user_email'];?></td>
                <td><a href="scripts/caller.php?caller_id=delete&id=<?php echo $user['user_id']; ?>">Delete</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>