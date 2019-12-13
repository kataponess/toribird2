<?php
require_once('takeoutVideos.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <title>ToriBird2</title>
</head>
<body>

  <div class="container">

    <header class="header">
      <header class="header-inner">
        <div class="logo"><a href="<?=__FILE__?>"><img src="imgs/ToriBird-logo-white.png" alt="ToriBird Logo"></a></div>
      </header>
    </header>

    <seciton class="body">
      <section class="main">
        <?php if (isset($page_Number)): ?>
        <div class="pagination">
          <?=$total_number?>
          <?=$page_Number?>
        </div>
        <?php endif;?>

        <?php if (isset($htmlBody)): ?>
        <?php foreach ($htmlBody as $key => $value): ?>
        <?=$value?>
        <?php endforeach;?>
        <?php endif;?>

        <?php if (isset($page_Number)): ?>
        <div class="pagination">
          <?=$total_number?>
          <?=$page_Number?>
        </div>
        <?php endif;?>
      </section>

      <section class="sidebar">sidebar
      </section>

    </seciton>

    <footer class="footer">
      <small class="small">© 2019 ToriBird</small>
    </footer>

  </div>

  <script src="main.js"></script>
</body>
</html>
