<?php
if(isset($_POST['create_user_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);
    
    $user = new User();
    $user->create($data);
}

?>
<h2>Create new user:</h2>

<div class="col-sm-12">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?page=user-create"); ?>">
    <input type="hidden" name="frm[csrf_token]" value="<?php echo CsrfToken::generate(); ?>">
        <div class="form-group form-floating mb-3">
            <input type="text" name="frm[firstname]" id="firstname" placeholder="Enter firstname" class="form-control">
            <label for="firstname">Firstname</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" name="frm[lastname]" id="lastname" placeholder="Enter lastname" class="form-control">
            <label for="lastname">lastname</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="email" name="frm[email]" id="email" placeholder="Enter email" class="form-control">
            <label for="email">email</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="password" name="frm[password]" id="password" placeholder="Enter password" class="form-control">
            <label for="password">password</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="frm['is_active']" id="is_active">
            <label for="is_active" class="form-check-label">Active</label>
        </div>
        <div class="form-group form-floating mb-3">
           <input type="submit" name="create_user_btn" value="Create" class="btn btn-primary">
        </div>
    </form>
</div>