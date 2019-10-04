<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>First PHP Page</h1>
<?php
$conn = pg_connect(getenv("DATABASE_URL"));
$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
$sql = "select studentname, course from RegisteCourse";
$stmt = $pdo->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
?>
<ul>
	<?php
	foreach ($resultSet as $row){
	echo "<li>" . $row["studentname"] . '--'. $row["course"]. "</li>";
	}
	?>
</ul>
</body>
</html>