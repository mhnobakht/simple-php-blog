<?php
$category = new Category();

$categoryParents = $category->getParents();
?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.html">Sample Post</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact</a></li>
                <?php
                foreach($categoryParents as $categoryParent):
                    $subcategories = $category->getSubCategories($categoryParent['id']);
                ?>
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle-px-lg-3 py-3 py-lg-4" data-bs-toggle="dropdown">
                            <?php echo $categoryParent['title']; ?>
                        </a>
                        <div class="dropdown-menu">
                            <?php
                            foreach($subcategories as $subcategory):
                            ?>
                            <a href="index.php?filter_id=<?php echo $subcategory['id']; ?>" class="dropdown-item"><?php echo $subcategory['title']; ?></a>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </li>
                </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </div>
</nav>