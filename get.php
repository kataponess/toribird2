<?php
require_once('getVideos.php');
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

  <div class="container">

    <header class="header">
      <header class="header-inner">
        <div class="logo"><a href="<?=__FILE__?>">ToriBird2</a></div>
      </header>
    </header>

    <form method="GET">
      <div>
        検索: <input type="search" id="q" name="q" placeholder="Enter Search Term">
      </div>
        <div>
          結果（最大数）: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="10">
      </div>
          <input type="submit" value="Search">
      </form>

        </div>

</body>
</html>
