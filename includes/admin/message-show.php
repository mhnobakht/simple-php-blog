<?php
if(!isset($_GET['message_id'])) {
    Semej::set('danger', 'error', 'Missing message id');
    header('Location: dashboard.php?page=messages');
}

$id = Sanitizer::sanitize($_GET['message_id']);
$_message = new Contact();
$message = $_message->show($id);

// var_dump($message);
?>
<h2>Show Message:</h2>

<div class="col-sm-12">
    <form>
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $message['name']; ?>" type="text" id="name" class="form-control" placeholder="Enter Title" readonly>
            <label for="name">Name</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $message['email']; ?>" type="text" id="email" class="form-control" placeholder="Enter Title" readonly>
            <label for="email">email</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $message['phone']; ?>" type="text" id="phone" class="form-control" placeholder="Enter Title" readonly>
            <label for="phone">phone</label>
        </div>
        <div class="form-group form-floating mb-3">
            <textarea name="message" id="message" cols="30" rows="10" class="form-control" readonly><?php echo $message['message']; ?></textarea>
            <label for="message">message</label>
        </div>
    </form>
</div>