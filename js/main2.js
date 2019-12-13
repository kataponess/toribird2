$(function () {
  $.ajax({
    type: 'get',//リクエスト方法
    url: 'https://www.googleapis.com/youtube/v3/channels',//リクエストURL
    dataType: 'json',//取得するデータの形式
    data: {//リクエスト内容に応じたパラメータ
      //取得したい情報をセット(必須)※複数の場合はカンマ区切り
      part: 'id,snippet,brandingSettings,contentDetails,invideoPromotion,statistics,topicDetails',
      //チャンネルIDをセット※複数の場合はカンマ区切り
      id: 'UCYCwDl5Cu_QnS-Hm76TnU5Q',
      //使用するAPIキー
      key: 'AIzaSyBsPed4gkxFR2Pe8-35NDuxBvrFfTDMqnk'
    }
  }).done(function () {
    // 成功時の動作を記述
    var jsonData = JSON.stringify(response, null, "\t");
    $('#hoge').text(jsonData);
  }).fail(function () {
    // 失敗時の動作を記述
    $('#hoge').text('失敗しました');
  });
});
