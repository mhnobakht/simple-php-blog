<?php
$category = new Category();
$categories = $category->getAll();
?>
<h2>Categories:</h2>
<hr>
<a href="dashboard.php?page=category-create">
    <button class="btn btn-primary">Create Category</button>
</a>
<hr>
<div class="col-sm-12">
    <table class="table">
        <thead>
            <th>Title</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            foreach($categories as $category):
            ?>
            <tr>
                <td><?php echo $category['title']; ?></td>
                <td>
                    <a href="dashboard.php?page=category-edit&category_id=<?php echo $category['id']; ?>">
                        <button class="btn btn-warning">Edit</button>
                    </a>
                    <a href="dashboard.php?page=category-delete&category_id=<?php echo $category['id']; ?>">
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