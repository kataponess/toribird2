<?php
try {
    $dsn = 'mysql:dbname=apitest;host=localhost;charset=utf8mb4';
    $username = 'root';
    $password = '';
    $driver_options=[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO($dsn, $username, $password, $driver_options);

    $rows = $pdo->query('SELECT * FROM youtubeapi')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit($e->getMessage());
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$stmt = $pdo -> prepare('INSERT INTO youtubeapi (name) VALUES (:name)');
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':value', 1, PDO::PARAM_INT);
$name = 'one';
$stmt->execute();

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <script src=""></script>
  <title>ToriBird2</title>
</head>
<body>

  <ul>
    <?php foreach ($rows as $row): ?>
    <li>
      <?=h($row['id'])?>
    </li>
    <li>
      <?=h($row['name'])?>
    </li>
    <?php endforeach; ?>
  </ul>

</body>
</html>
