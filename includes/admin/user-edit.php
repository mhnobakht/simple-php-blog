<?php
if(!isset($_GET['user_id'])) {
    Semej::set('danger', 'error', 'Missing user id');
    header('Location: dashboard.php?page=users');
}

$_user = new User();
$id = Sanitizer::sanitize($_GET['user_id']);
$user = $_user->Edit($id);
$user = $user[0];

if(isset($_POST['update_user_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);
    $id = $user['id'];
    $userclass = new User();
    $userclass->update($id, $data);
}

?>
<h2>Edit user:</h2>

<div class="col-sm-12">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?page=user-edit&user_id=".$user['id']); ?>">
    <input type="hidden" name="frm[csrf_token]" value="<?php echo CsrfToken::generate(); ?>">
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $user['firstname']; ?>" type="text" name="frm[firstname]" id="firstname" placeholder="Enter firstname" class="form-control">
            <label for="firstname">Firstname</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $user['lastname']; ?>"  type="text" name="frm[lastname]" id="lastname" placeholder="Enter lastname" class="form-control">
            <label for="lastname">lastname</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input  value="<?php echo $user['email']; ?>" type="email" name="frm[email]" id="email" placeholder="Enter email" class="form-control">
            <label for="email">email</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="password" name="frm[password]" id="password" placeholder="Enter password" class="form-control">
            <label for="password">password</label>
        </div>
        <div class="form-check mb-3">
            <input <?php echo ($user['is_active'] == 1) ? 'checked' : ''; ?> class="form-check-input" type="checkbox" name="frm['is_active']" id="is_active">
            <label for="is_active" class="form-check-label">Active</label>
        </div>
        <div class="form-group form-floating mb-3">
           <input type="submit" name="update_user_btn" value="Update" class="btn btn-primary">
        </div>
    </form>
</div>