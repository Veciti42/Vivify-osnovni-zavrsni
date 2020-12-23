<?php
   $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";
    $dbcomments = "comments";
    try {
        $connection = new PDO("mysql:host = $servername; dbname = $dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    try {
        $connection = new PDO("mysql:host = $servername; dbname = $dbcomments", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    $sql = "SELECT * FROM blog.posts WHERE ID = {$_GET['id']}";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $singlePost = $statement->fetch();

    $comment = "SELECT Author, Text, Post_id FROM blog.comments WHERE Post_id = {$_GET['id']}";
    $statement2 = $connection->prepare($comment);
    $statement2->execute();
    $statement2->setFetchMode(PDO::FETCH_ASSOC);
    $Comments = $statement2->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

<?php include('header.php'); ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

 <div class="blog-post">
            <h2 class="blog-post-title"><a href=""><?php echo $singlePost["Title"]?></a></h2>
            <p class="blog-post-meta"><?php echo $singlePost["Created_at"] ?>by <a href="#"><?php echo $singlePost["Author"]?></a></p>

                <p>
                    <?php echo $singlePost["Body"]?>
                </p>
                <ul>
                    <?php foreach ($Comments as $comment) { ?>
                        <li><p><?php echo $comment["Text"]?> by <?php echo $comment["Author"]?></p></li>
                        <hr>
                    <?php } ?>
                </ul>
        </div>
        <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

       <?php include('sidebar.php'); ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include('footer.php'); ?>
</body>
</html>
