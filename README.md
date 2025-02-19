# Rese（リーズ）  
飲食店予約サービス  
![スクリーンショット 2024-11-14 040658](https://github.com/user-attachments/assets/56413852-7d5c-4daa-8a13-2dbbe3ced97f)  
  
## 作成した目的  
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたいため  
  
## アプリケーションURL  
http://54.238.207.220/  
  
## 機能一覧  
*会員登録  
*ログイン機能  
*ログアウト機能  
*ユーザー情報取得  
*ユーザー飲食店お気に入り一覧取得  
*ユーザー飲食店予約情報取得  
*飲食店一覧取得  
*飲食店詳細取得  
*飲食店お気に入り追加  
*飲食店お気に入り削除  
*飲食店予約情報追加  
*飲食店予約情報削除  
*飲食店予約情報変更  
*事前決済  
*飲食店レビュー追加  
*エリアで検索する  
*ジャンルで検索する  
*店名で検索する  
*店舗代表者登録  
*店舗代表者登録情報更新  
*店舗代表者の管理店舗一覧取得  
*ユーザーへメール送信  
*店舗代表者の名前、管理店舗で検索する
*店舗情報の更新  
*飲食店予約情報一覧取得  
  
## 使用技術（実行環境）  
Laravel Framework 11.21.0  
  
## テーブル設計  
![スクリーンショット 2024-11-14 051302](https://github.com/user-attachments/assets/a8857380-67d3-4fbf-b967-1c1a8331cf88)  
  
## ER図  
![スクリーンショット 2024-11-14 050633](https://github.com/user-attachments/assets/589ba947-5632-404a-9fe6-aec7cceb01ea)  

## 環境構築  
**Dockerビルド**  
1.`git clone https://github.com/ayuka-maruyama/rese_2024.git`  
2.Docker Desktopアプリを立ち上げる  
3.`docker-compose up -d --build`  
  
**Laravel環境構築**  
1.`docker-compose exec php bash`でPHPコンテナへログイン  
2.`composer install`  
3.「.env.example」ファイルを「.env」ファイルに命名を変更。新しく.envファイルを作成  
4.「.env」に以下の環境変数を追加  
```text
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass  
  
STRIPE_KEY=公開可能キーを入力  
STRIPE_SECRET=シークレットキーを入力  
STRIPE_WEBHOOK_SECRET=制限付きのキーのトークンを入力  
CASHIER_CURRENCY=ja_JP  
CASHIER_CURRENCY_LOCALE=ja_JP  
CASHIER_LOGGER=daily  
  
MAIL_MAILER=smtp  
MAIL_HOST=mailhog  
MAIL_PORT=1025  
MAIL_USERNAME=null  
MAIL_PASSWORD=null  
MAIL_ENCRYPTION=null  
MAIL_FROM_ADDRESS="info@example.com"  
MAIL_FROM_NAME="${APP_NAME}"  
  
```
  
5.アプリケーションキーの作成  
``` bash
php artisan key:generate
```  
  
6.マイグレーション、シーダーの実行  
``` bash
php artisan migrate --seed
```  
  
## その他  
管理者ユーザー  
メールアドレス admin@example.com  
パスワード password  
  
店舗代表者ユーザー  
メールアドレス owner1@example.com  
パスワード password  
  
テストユーザー  
メールアドレス test@example.com  
パスワード password  
  
新規口コミ投稿機能は、来店予約日時を過ぎた後から投稿が可能  