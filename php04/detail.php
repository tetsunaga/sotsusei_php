<?php
session_start();

$id = $_GET['id']; //?id~**を受け取る
require_once('funcs.php');
loginCheck();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_an_table WHERE id=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>製品名：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
                <label>型式：<input type="text" name="model_id" value="<?= $row["model_id"] ?>"></label><br>
                
                <label>数量：<input type="text" name="quantity" value="<?= $row["quantity"] ?>"></label><br>
                
                <label>金額：<input type="text" name="amount" value="<?= $row["amount"] ?>"></label><br>
                <label>備考<textArea name="naiyou" rows="4" cols="40"><?= $row["naiyou"] ?></textArea></label><br>
                <input type="submit" value="送信">
                <input type="hidden" name="id" value="<?= $id ?>">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->
</body>

</html>
