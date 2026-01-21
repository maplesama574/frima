# Frima

Laravel活用のフリマサイト

## ディレクトリ構成（主要なもの）

- `src/`        アプリケーションのソースコード（Controllers, Models, etc.）
- `public/`     公開用のファイル（CSS, JS, 画像など）
- `resources/`  ビューやテンプレート、フロント用リソース
- `routes/`     Web ルート定義
- `docker-compose.yml`  Docker 環境設定

## 環境構築
git clone git@github.com:maplesama574/frima.git frima
(password:Maplesyrup)
cd frima

docker-compose up -d --build

docker-compose exec php bash
cd /var/www
composer install
exit

cd src
cp .env.testing .env
cd ..
code .
.envに独自に生成したstripeキーを記載する。

docker-compose exec php bash
php artisan key:generate

cd /var/www
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
念のため
php artisan config:clear
php artisan cache:clear
php artisan view:clear

php artisan migrate
php artisan db:seed
php artisan storage:link

## 使用技術（実行環境）

バックエンド
PHP
Laravel

フロントエンド
Blade
HTML/CSS

インフラ・その他
MySQL
Docker(DockerCompose)
Nginx
Stripe

## URL

- トップページ： http://localhost/
- 会員登録： http://localhost/register
- ログイン： http://localhost/login
- 商品一覧： http://localhost/items
- 商品詳細： http://localhost/items/{id}
- 商品出品： http://localhost/sell
- マイページ： http://localhost/mypage
