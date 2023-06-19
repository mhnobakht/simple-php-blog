<?php
require_once 'autoload.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');die;
}

$id = $_GET['id'];

$_post = new Post();

$post = $_post->edit($id);

$_user = new User();

$user = $_user->getUser($post['user_id']);


?>

<!DOCTYPE html>
<html lang="en">
    <?php 
    include_once 'header.php';
    ?>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">About</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.html">Sample Post</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('<?php echo $post['image']; ?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $post['title']; ?></h1>
                            <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> -->
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $user['firstname'].' '.$user['lastname']; ?></a>
                                on 
                                <?php
                            echo date("F j\, Y", strtotime($post['created_at']));
                            ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>
                            <?php echo $post['description']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
        <?php
        include_once 'footer.php';
        ?>
    </body>
</html>
