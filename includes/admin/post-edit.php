<?php
if(!isset($_GET['post_id'])) {
    Semej::set('danger', 'error', 'Missing Post id');
    header('Location: dashboard.php?page=posts');
}

$id = Sanitizer::sanitize($_GET['post_id']);
$_post = new Post();
$post = $_post->edit($id);

$category = new Category();
$subCategories = $category->getSubCategories();

if(isset($_POST['update_post_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['frm'];
    $file = $_FILES['file'];
    $post_id = $id;

    $post = new Post();
    $post->update($id, $data, $file);

    // $_file = new File();
    // $image = $_file->upload($file);
}
?>
<h2>Create New Post:</h2>
<img src="<?php echo $post['image']; ?>" alt="post image" style="width: 200px" class="m-2 rounded">
<div class="col-sm-12">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?page=post-edit&post_id=").$post['id']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="frm[csrf_token]" value="<?php echo CsrfToken::generate(); ?>">
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $post['title']; ?>" type="text" name="frm[title]" id="title" placeholder="Enter title" class="form-control">
            <label for="firstname">title</label>
        </div>
        <div class="form-group form-floating mb-3">
            <textarea name="frm[description]" id="description" cols="30" rows="10" class="form-control"><?php echo $post['description']; ?></textarea>
            <label for="description">description</label>
        </div>
        <div class="form-group mb-3">
            <label for="categories">Categories:</label>
            <select name="frm[categories][]" id="categories" class="form-control" multiple size="3">
                <?php
                foreach($subCategories as $subCategory):
                ?>
                <option
                
                <?php
                if(in_array($subCategory, $post['categories'])) {
                    echo "selected";
                }
                ?>
                value="<?php echo $subCategory['id']; ?>"><?php echo $subCategory['title']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group form-floating mb-3">
            <input name="file" type="file" id="formFile" class="form-control">
            <label for="formFile" class="form-label"></label>
        </div>
        
        <div class="form-group form-floating mb-3">
           <input type="submit" name="update_post_btn" value="Update" class="btn btn-primary">
        </div>
    </form>
</div>