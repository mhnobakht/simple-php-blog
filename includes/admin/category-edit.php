<?php
if(!isset($_GET['category_id'])) {
    Semej::set('danger', 'error', 'Missing category id');
    header('Location: dashboard.php?page=categories');
}

$id = Sanitizer::sanitize($_GET['category_id']);
$_category = new Category();
$category = $_category->edit($id);
$parents = $_category->getParents();


if(isset($_POST['category_edit_btn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);

    $_category->update($id, $data);
}

?>
<h2>Edit Category:</h2>

<div class="col-sm-12">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?page=category-edit&category_id=".$id); ?>">
        <input type="hidden" name="frm[csrf_token]" value="<?php echo CsrfToken::generate(); ?>">
        <div class="form-group form-floating mb-3">
            <input value="<?php echo $category['title']; ?>" type="text" name="frm[title]" id="title" class="form-control" placeholder="Enter Title">
            <label for="title">Title</label>
        </div>
        <div class="form-group form-floating mb-3">
            <select name="frm[parent_id]" id="parent_id" class="form-select">
                <option value="0">Without parent</option>
                <?php
                foreach($parents as $parent):
                ?>
                <option <?php echo ($parent['id'] == $category['parent_id']) ? 'selected' : '';  ?> value="<?php echo $parent['id']; ?>"><?php echo $parent['title']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <label for="parent_id">Parent</label>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="submit" value="Create" name="category_edit_btn" class="btn btn-primary">
        </div>
    </form>
</div>