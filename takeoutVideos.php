<?php
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}
require_once __DIR__ . '/vendor/autoload.php';



// if (isset($_GET['q']) && isset($_GET['maxResults'])) {

// ---------- データベースから取り出し ----------
try {
    $dsn = 'mysql:dbname=apitest;host=localhost;charset=utf8mb4';
    $username = 'root';
    $password = '';
    $driver_options=[
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
    $pdo = new PDO($dsn, $username, $password, $driver_options);

    $searchResponse = $pdo->query('SELECT * FROM videodb')->fetchAll(PDO::FETCH_ASSOC);

    // $rows->execute();

// echo '<pre>';
// var_dump($rows);
// echo '</pre>';
} catch (PDOException $e) {
    exit($e->getMessage());
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
// ----------------------------------------

// ---------- 出力データ成型 ----------
$videoArray = [];
foreach ($searchResponse as $searchResult) {
    $videoArray[] = sprintf(
        '<div class="video-outer">
        <div class="title">タイトル:%s</div>
        <div class="video"><iframe width="560" height="315" src="https://www.youtube.com/embed/%s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
        <div class="description">概要:%s</div>
        </div>',
        h($searchResult['title']),
        h($searchResult['videoid']),
        h($searchResult['description']),
    );
}
// ----------------------------------------

// ---------- ページネーション ----------
    define('MAX', '3');
    $htmlBody = '';
    $page_Number = '';
    $total_number = '';

    $videoArray_num = count($videoArray);
    $max_page = ceil($videoArray_num / MAX);

    if (!isset($_GET['page_id'])) {
        $now = 1;
    } else {
        $now = $_GET['page_id'];
    }

    $start_no = ($now - 1) * MAX;

    $htmlBody = array_slice($videoArray, $start_no, MAX, true);

    // foreach ($disp_data as $value) {
    //     $htmlBody .= $value;
    // }
    // echo '<pre>';
    // var_dump($htmlBody);
    // echo '</pre>';

    $total_number .= '<div class="totalNumber">全件数'.$videoArray_num.'件</div>'; // 全データ数の表示です。

    $address = '<a href="./index.php?page_id=';
    if ($now > 1) { // リンクをつけるかの判定
        $page_Number .= '<div class="pageNumber">'.$address.($now - 1).'")>前へ</a>'.'　';
    } else {
        $page_Number .= '<div class="pageNumber">前へ'.'　';
    }

    for ($i = 1; $i <= $max_page; $i++) {
        if ($i == $now) {
            $page_Number .= $now. '　';
        } else {
            $page_Number .= $address.$i. '")>'.$i.'</a>'.'　';
        }
    }

    if ($now < $max_page) { // リンクをつけるかの判定
        $page_Number .= $address.($now + 1).'")>次へ</a></div>'.'　';
    } else {
        $page_Number .= '次へ</div>';
    }

// ----------------------------------------

// }
