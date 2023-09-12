## 商品管理システム

### 環境構築手順

* Gitクローン
* .env.example をコピーして .env を作成
* MySQLのデータベース作成（名前：item_management）
* Macの場合 .env の DB_PASSWORD を root に修正（Windowsは修正不要）
```
DB_PASSWORD=root
```
* APP_KEY生成
```
$ php artisan key:generate
```
* Composerインストール
```
$ composer install
```
* フロント環境構築
```
$ npm ci
$ npm run dev
```
* マイグレーション
```
$ php artisan migrate
```
