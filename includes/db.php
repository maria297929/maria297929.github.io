<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "mondaypanic";
$charset="utf8mb4";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}
?>