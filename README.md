2.dockerの設定
 dockerのコンテナを作成
 docker-compose -f docker-compose.yml up -d --build
 ・horoscopeのコンテナの中に入る
 docker exec -it horoscope bash
 ・コンテナの中で以下を実行する
 php artisan key:generate
 php artisan migrate
 php artisan db:seed
 chmod +x /var/www/Modules/Horoscope/Http/Actions/Predict/sweph/ephe/swetest
 exit
3: client
  cd horoscope/Modules/Horoscope
  composer install
  npm install
  npm run build
4: admin
  cd horoscope
  composer install
  npm install
  npm run build
-----------以上-----------
◯ link
・http://localhost:8080/user/login（client）
・http://localhost:8080/admin/login (admin)


・現在のレスポンス受取URLは以下のようになっています。変更する場合は、製本直送様に直接ご連絡ください。
※確認環境↓
レスポンス受取URL：https://stg-horoscorp-uranai.4sis.site/api/bookbinding_result
テスト注文の際はリクエストパラメータでtestmode 1,を指定して送信（toggle_test_shippingsテーブルで制御しています）
※本番環境↓
結果レスポンスの受け取りURL：https://mypage.hoshinomai.jp/api/bookbinding_result
テスト注文の際はリクエストパラメータでtestmode 0,を指定して送信（toggle_test_shippingsテーブルで制御しています）

```