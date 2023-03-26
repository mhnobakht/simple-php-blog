<?php
$user = new User();
$users = $user->getAll();
?>
<h2>Users</h2>
<hr>
<a href="dashboard.php?page=user-create"><button class="btn btn-primary">Create</button></a>
<hr>

<div class="col-sm-12">
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            foreach($users as $user):
            ?>
            <tr>
                <td><?php echo $user['firstname'].' '.$user['lastname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td>
                    <a href="dashboard.php?page=user-edit&user_id=<?php echo $user['id']; ?>"><button class="btn btn-warning">Edit</button></a>
                    <a href="dashboard.php?page=user-delete&user_id=<?php echo $user['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>