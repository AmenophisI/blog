<?php
//includeは指定ファイルを読み込む関数
include 'lib/connect.php';
//エラーメッセージ
$err = null;

if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = new connect();

    //実行したいSQL
    $select = "select * from users where name=:name";
    //第二引数でどのパラメータにどの変数を割り当てるか決める、パラメータは連想配列
    //queryメソッドを実行すると$stmtに結果セットができる
    $stmt = $db->query($select, array(':name' => $_POST['name']));
    //レコード1件を連想配列として取得する
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //password_verify:第一引数のパスワードが第二引数のハッシュ値と等しいかどうかを判定
    if ($result && password_verify($_POST['password'], $result['password'])) {
        //結果が存在し、パスワードも正しい場合
        session_start();
        $_SESSION['id'] = $result['id'];
        header(("Location:backend.php"));
    } else {
        $err = "ログインできませんでした";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
    />

    <style>
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
    </style>

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet"/>
</head>
<body class="text-center">
<main class="form-signin">
    <!--        フォームの送信ボタンを押すことで,login.phpにPOSTメソッドでデータを送信-->
    <form action="login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">ログインする</h1>
        <?php
        if (!is_null($err)) {
            echo '<div class="alert alert-danger">' . $err . '</div>';
        }
        ?>
        <label class="visually-hidden">ユーザ名</label>
        <input
                type="text"
                name="name"
                class="form-control"
                placeholder="ユーザ名"
                required
                autofocus
        />
        <label class="visually-hidden">パスワード</label>
        <input
                type="password"
                name="password"
                class="form-control"
                placeholder="パスワード"
                required
        />
        <button class="w-100 btn btn-lg btn-primary" type="submit">
            ログインする
        </button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
</main>
</body>
</html>
