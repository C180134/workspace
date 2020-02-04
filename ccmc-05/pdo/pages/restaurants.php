<?php
require_once("../database.php");
require_once("../classes.php");
$area = -1;
if (isset($_REQUEST["area"])) {
    $area =intval($_REQUEST["area"]);
}
//database connect
$pdo = connectDatabase();
// sql set
$sql = "select * from restaurants where area = ?";
//sql run
$pstmt = $pdo->prepare($sql);
$pstmt->bindValue(1,$area);
$pstmt->execute();
//結果
$rs = $pstmt->fetchAll();
disconnectDatabase($pdo);
//list
$restaurants = [];
foreach ($rs as $record){
    $id = intval($record["id"]);
    $name = $record["name"];
    $detail = $record["detail"];
    $image = $record["image"];
    $restaurant = new Restaurant($id,$name,$detail,$image,$area);
    $restaurants[] = $restaurant;
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
		<h2>選択された地域のレストラン一覧</h2>
		<table border="1">
			<tr>
				<th>レストランID</th>
				<th>レストラン名</th>
				<th>詳細</th>
				<th>画像ファイル名</th>
				<th>地域ID</th>
			</tr>
			<?php foreach ($restaurants as $area) { ?>
			<tr>
				<td><?= $area->getId() ?></td>
				<td><?= $area->getName() ?></td>
				<td><?= $area->getDetail() ?></td>
				<td><?= $area->getImage() ?></td>
				<td><?= $area->getArea() ?></td>
			</tr>
			<?php } ?>
		</table>
	</body>
</html>