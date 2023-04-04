<?php
$category = new Category();
$parents = $category->getParents();

if(isset($_POST['category_create_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);
    
    $category->create($data);
}
?>
<h2>Create new Category:</h2>

<div class="col-sm-12">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?page=category-create"); ?>">
        <input type="hidden" name="frm[csrf_token]" value="<?php echo CsrfToken::generate(); ?>">
        <div class="form-group form-floating mb-3">
            <input type="text" name="frm[title]" id="title" class="form-control" placeholder="Enter Title">
            <label for="title">Title</label>
        </div>
        <div class="form-group form-floating mb-3">
            <select name="frm[parent_id]" id="parent_id" class="form-select">
                <option value="">Without parent</option>
                <?php
                foreach($parents as $parent):
                ?>
                <option value="<?php echo $parent['id']; ?>"><?php echo $parent['title']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <label for="parent_id">Parent</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="submit" value="Create" name="category_create_btn" class="btn btn-primary">
        </div>
    </form>
</div>