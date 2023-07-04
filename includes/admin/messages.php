<?php
$message = new Contact();
$messages = $message->getAll();

// var_dump($messages);
?>
<h2>Messages:</h2>
<hr>
<div class="col-sm-12">
    <table class="table">
        <thead>
            <th>Email</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            foreach($messages as $message):
            ?>
            <tr>
                <td class="<?php echo ($message['is_read'] == 0) ? 'text-danger' : 'text-success'; ?>"><?php echo $message['email']; ?></td>
                <td>
                    <a href="dashboard.php?page=message-show&message_id=<?php echo $message['id']; ?>">
                        <button class="btn btn-warning">Show</button>
                    </a>
                    <a href="dashboard.php?page=message-delete&message_id=<?php echo $message['id']; ?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>