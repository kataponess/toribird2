<?php
$videoArray = [];
$searchResponse = [
    'items' => [
      ['title' => 'セキセイインコ', 'videoid' => '111', 'description' => 'aaa'],
    ['title' => 'オカメインコ', 'videoid' => '222', 'description' => 'bbb'],
    ['title' => 'サザナミインコ', 'videoid' => '333', 'description' => 'ccc'],
    ]
];


foreach ($searchResponse['items'] as $key => $searchResult) {
    $videoArray[$key]['title'] = $searchResult['title'];
    $videoArray[$key]['videoId'] = $searchResult['videoId'];
    $videoArray[$key]['description'] = $searchResult['description'];
    echo '<pre>';
    var_dump($searchResult);
    echo '</pre>';
}

echo '<br><br><br>';
    echo '<pre>';
    var_dump($videoArray);
    echo '</pre>';

    echo '<br><br><br>';
    echo '<pre>';
    var_dump($videoArray[0]);
    echo '</pre>';
