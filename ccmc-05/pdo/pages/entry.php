<?php
//ket noi class
require_once("../database.php");
$pdo = connectDatabase();
//lay du lieu tu sql
$sql = "select * from areas";
//jikko lenh kay du lieu
$pstmt = $pdo->prepare($sql);
$pstmt->execute();
//la ket qua
$rs = $pstmt->fetchAll();
//dung ket noi voi database
disconnectDatabase($pdo);
//xac nhan ket qua
//echo"<pre>";
//var_dump($rs);
//echo"/pre>";
//exit(0);

//gan ket qua vao chuoi
require_once("../classes.php");

$areas = [];
foreach ($rs as $record){
    $id = intval($record["id"]);
    $name = $record["name"];
    $area = new Area($id,$name);
    $areas[] = $area;
}
?>




<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<title>PDOを使ってみる</title>
	</head>
	<body>
		<h1>PDOを使ってみる</h1>
		<h2>地域を選択する</h2>
		<form action="restaurants.php" method="get">
		<select name="area">
			<option value="0">-- 選択してください --</option>
			<?php foreach ($areas as $area) { ?>
			<option value="<?= $area->getId() ?>"><?= $area->getName() ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="選択" />
		</form>
	</body>
</html>
