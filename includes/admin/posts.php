<?php
$post = new Post();
$posts = $post->getAll();
?>
<h2>Posts:</h2>
<hr>
<a href="dashboard.php?page=post-create">
    <button class="btn btn-primary">Add Post</button>
</a>
<hr>
<div class="col-sm-12">
    <table class="table">
        <thead>
            <th>Image</th>
            <th>Title</th>
            <th>User</th>
            <th>Categories</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            foreach($posts as $post):
            ?>
            <tr>
                <td>
                    <img style="width: 100px;" src="<?php echo $post['image']; ?>" alt="post image">
                </td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['user']['email']; ?></td>
                <td>
                    <?php
                    foreach($post['categories'] as $category):
                    ?>
                    <span class="badge badge-primary bg-primary"><?php echo $category['title']; ?></span>
                    <?php
                    endforeach;
                    ?>
                </td>
                <td>
                <td>
                    <a href="dashboard.php?page=post-edit&post_id=<?php echo $post['id']; ?>">
                        <button class="btn btn-warning">Edit</button>
                    </a>
                    <a href="dashboard.php?page=post-delete&post_id=<?php echo $post['id']; ?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                </td>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>