<?php
//1. POSTデータ取得
$name   = $_POST['name'];
$model_id  = $_POST['model_id'];
$naiyou = $_POST['naiyou'];
$quantity    = $_POST['quantity']; 
$amount    = $_POST['amount']; //追加されています

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table(name,model_id,quantity,amount,naiyou,indate)VALUES(:name,:model_id,:quantity,:amount,:naiyou,sysdate())');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':model_id', $model_id, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':amount', $amount, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
