<?php
include "lib/secure.php";
include "lib/connect.php";
include "lib/QueryArticle.php";
include "lib/Article.php";

$title = "";
$body = "";
$title_alert = "";
$body_alert = "";

if (!empty($_POST['title']) && !empty($_POST['body'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $article = new Article();
    $article->setTitle($title);
    $article->setBody($body);
    $article->save();
    header('Location:backend.php');
} elseif (!empty($_POST)) {
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];
    } else {
        $title_alert = "タイトルを入力してください";
    }
    if (!empty($_POST['body'])) {
        $body = $_POST['body'];
    } else {
        $body_alert = "本文を入力してください";
    }
}
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Backend</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            padding-top: 5rem;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .bg-red {
            background-color: #ff6644 !important;
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="./css/blog.css" rel="stylesheet">
</head>
<body>

<?php
include "lib/nav.php";
?>

<main class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>記事の投稿</h1>

            <form action="post.php" method="post">
                <div class="mb-3">
                    <label class="form-label">タイトル</label>
                    <?php
                    if (!empty($title_alert)) {
                        echo "<div class='alert alert-danger'>{$title_alert}</div>";
                    }
                    ?>
                    <input type="text" name="title" class="form-control" value="<?= $title ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">本文</label>
                    <?php
                    if (!empty($body_alert)) {
                        echo "<div class='alert alert-danger'>{$body_alert}</div>";
                    }
                    ?>
                    <textarea name="body" class="form-control" rows="10"><?= $body ?></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">投稿する</button>
                </div>
            </form>

        </div>

    </div><!-- /.row -->

</main><!-- /.container -->

</body>
</html>
