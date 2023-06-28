<?php
require_once 'autoload.php';

$filter_id = null;

if(isset($_GET['filter_id'])) {
    $filter_id = $_GET['filter_id'];
}

$post = new Post();
$posts = $post->getAll($filter_id);

// var_dump($test['user']);die;

?>
<!DOCTYPE html>
<html lang="en">
    <?php 
    include_once 'header.php';
    ?>
    <body>
        <?php
        include_once 'nav.php';
        ?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php
                    foreach($posts as $post):
                    ?>
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.php?id=<?php echo $post['id']; ?>">
                            <h2 class="post-title"><?php echo $post['title']; ?></h2>
                            <h3 class="post-subtitle"><?php echo mb_strimwidth($post['description'], 0, 50, '...'); ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">
                                <?php
                                echo $post['user']['firstname'].' '.$post['user']['lastname'];
                                ?>
                            </a>
                            <!-- on September 24, 2022 -->
                            on 
                            <?php
                            echo date("F j\, Y", strtotime($post['created_at']));
                            ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <?php
                    endforeach;
                    ?>
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php
        include_once 'footer.php';
        ?>
    </body>
</html>
