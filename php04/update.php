<?php

//1. POSTデータ取得
$name   = $_POST['name'];
$model_id  = $_POST['model_id'];
$naiyou = $_POST['naiyou'];
$quantity = $_POST['quantity'];
$amount  = $_POST['amount'];
$id = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_an_table SET name=:name,model_id=:model_id,quantity=:quantity,amount=:amount,naiyou=:naiyou WHERE id=:id');
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':model_id',  $model_id,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':quantity',    $quantity,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':amount',    $amount,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('select.php');
}
