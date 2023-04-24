<?php

if(isset($_POST['create_post_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['frm'];
    $file = $_FILES['file'];

    $_file = new File();
    $image = $_file->upload($file);

    var_dump($image);
}

?>
<h2>Create New Post:</h2>
<div class="col-sm-12">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?page=post-create"); ?>" enctype="multipart/form-data">
    <input type="hidden" name="frm[csrf_token]" value="<?php echo CsrfToken::generate(); ?>">
        <div class="form-group form-floating mb-3">
            <input type="text" name="frm[title]" id="title" placeholder="Enter title" class="form-control">
            <label for="firstname">title</label>
        </div>
        <div class="form-group form-floating mb-3">
            <textarea name="frm[description]" id="description" cols="30" rows="10" class="form-control"></textarea>
            <label for="description">description</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input name="file" type="file" id="formFile" class="form-control">
            <label for="formFile" class="form-label"></label>
        </div>
        
        <div class="form-group form-floating mb-3">
           <input type="submit" name="create_post_btn" value="Create" class="btn btn-primary">
        </div>
    </form>
</div>