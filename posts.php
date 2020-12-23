<?php
    foreach ($posts as $post) { ?>
        <div class="blog-post">
            <h2 class="blog-post-title"><a href="singlePost.php?id=<?php echo($post['ID']) ?>"><?php echo $post["Title"]?></a></h2>
            <p class="blog-post-meta"><?php echo $post["Created_at"] ?>by <a href="#"><?php echo $post["Author"]?></a></p>

                <p>
                    <?php echo $post["Body"]?>
                </p>
        </div>
    <?php } ?>



