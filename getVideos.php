<?php
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}
require_once __DIR__ . '/vendor/autoload.php';

if (isset($_GET['q']) && isset($_GET['maxResults'])) {
    $DEVELOPER_KEY = 'AIzaSyBsPed4gkxFR2Pe8-35NDuxBvrFfTDMqnk';
    $videoArray = [];

    $client = new Google_Client();
    $client->setDeveloperKey($DEVELOPER_KEY);

    $youtube = new Google_Service_YouTube($client);
    $htmlBody = '';
    try {
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'], //検索文字列
      'maxResults' => $_GET['maxResults'], //表示数
      'type' => 'video', //video, channel, playlist
      'regionCode' => 'JP',
      'order' => 'relevance', // 表示順、date – 新しい順
                              //rating – 評価の高い順
                              //relevance – 関連性が高い順。デフォルト
                              //title – アルファベット順
                              //videoCount – アップロード動画の番号順（降順）
                              //viewCount – 再生回数の多い順
    ));

        $channels = '';
        $playlists = '';

        foreach ($searchResponse['items'] as $key => $searchResult) {
            $videoArray[$key]['title'] = $searchResult['snippet']['title'];
            $videoArray[$key]['videoId'] = $searchResult['id']['videoId'];
            $videoArray[$key]['description'] = $searchResult['snippet']['description'];
        }

        // -------------------------- PDO データベース --------------------------
        try {
            $dsn = 'mysql:dbname=apitest;host=localhost;charset=utf8mb4';
            $username = 'root';
            $password = '';
            $driver_options=[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            $pdo = new PDO($dsn, $username, $password, $driver_options);

            $pdo->query('ALTER TABLE videodb AUTO_INCREMENT = 1');

            foreach ($videoArray as $key => $valueArray) {
                $stmt = $pdo -> prepare('REPLACE INTO videodb (title, videoid, description) VALUES (:title, :videoid, :description)');
                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':videoid', $videoid, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $title = $valueArray['title'];
                $videoid = $valueArray['videoId'];
                $description = $valueArray['description'];
                $stmt->execute();
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }

        // ---------------------------------------------------------------------
    } catch (Google_Service_Exception $e) {
        $htmlBody .= sprintf(
            '<p>A service error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage())
        );
    } catch (Google_Exception $e) {
        $htmlBody .= sprintf(
            '<p>An client error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage())
        );
    }
}
