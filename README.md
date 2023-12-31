# Atte
勤怠管理を目的として作成したアプリケーションです。<br>
![stamp-ex](https://github.com/matsudayuki8140/attendance/assets/129087994/90f6408b-cc99-4556-badc-40f0e33d8730)
<br>
## 作成した目的
社員の勤務時間と休憩時間を正確に把握し、人事評価に反映する目的で作成しました。<br>
<br>
## アプリケーションURL
http://54.238.219.14<br>
ログインには会員登録が必要です。入力する情報は名前、メールアドレス、パスワードの３つです。<br>
会員登録を完了するにはメールアドレスの認証が必要です。登録したメールアドレスに認証メールが送信されるので、記載されたリンクをクリックすることで会員登録を完了することができます。<br>
### メール認証について
このアプリでは、メールサーバーとしてMailhogを使用しています。認証メールは http://54.238.219.14:8025 から確認できます。<br>
#### メール認証済みテスト用アカウント
name：テスト太郎<br>
email：tarou@example.com<br>
password：password<br>
<br>
## 機能一覧
### 会員登録
Laravel breezeの機能を使用しています。先述の通り、名前、メールアドレス、パスワードの３つの情報とメールアドレスの認証が必要です。<br>
メールアドレスを認証するため
には、登録したメールアドレス宛てに送信されたメールに記載されているリンクをクリックしてください。<br>
![register](https://github.com/matsudayuki8140/attendance/assets/129087994/5d06a2df-f8ca-4e6d-9f54-6eb4289201af)
![verify](https://github.com/matsudayuki8140/attendance/assets/129087994/01e98923-9e4f-4a29-997b-85425c455071)

### ログイン
Laravel breezeの機能を使用しています。ログインにはメールアドレスとパスワードの入力が必要です。
![login](https://github.com/matsudayuki8140/attendance/assets/129087994/93419a74-5cbd-422e-9f56-f443ba380f33)
### 打刻ページ
![stamp-ex](https://github.com/matsudayuki8140/attendance/assets/129087994/90f6408b-cc99-4556-badc-40f0e33d8730)
#### 勤務開始時刻の記録
ログイン後最初に表示されるページです。<br>
「勤務開始」ボタンをクリックすることで新たに勤怠レコードを作成し、現在時刻を勤務開始時刻として記録します。<br>
この機能は、会員登録完了直後、または「勤務終了」ボタンをクリックした後でなければ使用することができません。<br>
#### 勤務終了時刻の記録
「勤務終了」ボタンをクリックすることで、現在時刻を勤務終了時刻として記録します。ただし、現在時刻が勤務開始した日から日付を跨いでいた場合、次の処理を実行します。<br>
・勤務終了した日の０時を勤務終了時刻として記録する。<br>
・新たな勤怠レコードを作成し、勤務終了した日の０時を勤務開始時刻、現在時刻を勤務終了時刻として記録する。<br>
この機能は、「勤務開始」ボタン　または「休憩終了」ボタンをクリックした後でなければ使用することができません。<br>
#### 休憩開始時刻の記録
「休憩開始」ボタンをクリックすることで新たに休憩レコードを作成し、現在時刻を休憩開始時刻として記録します。<br>
一度の勤務につき、休憩は何度でも取ることができます。<br>
この機能は、「勤務開始」ボタン　または「休憩終了」ボタンをクリックした後でなければ使用することができません。<br>
#### 休憩終了時刻の記録
「休憩終了」ボタンをクリックすることで、現在時刻を休憩終了時刻として記録します。ただし、現在時刻が休憩開始した日から日付を跨いでいた場合、次の処理を実行します。<br>
・休憩終了した日の０時を休憩終了時刻、勤務終了時刻として記録する。<br>
・新たな勤怠レコードと休憩レコードを作成し、休憩終了した日の０時を勤務開始時刻・休憩開始時刻として、現在時刻を休憩終了時刻として記録する。<br>
この機能は、「休憩開始」ボタンをクリックした後でなければ使用することができません。<br>
<br>
### 日付別一覧ページ
![date-ex](https://github.com/matsudayuki8140/attendance/assets/129087994/192f49fb-79c4-4fb7-b0d1-f5ab7d322ed4)
#### 日付別一覧ページ表示
勤怠レコードと休憩レコードを日付別に取得し、一覧表示します。表示される情報は日付のほかに名前、勤務開始時刻、勤務終了時刻、合計休憩時間、勤務時間です。<br>
ここでの勤務時間とは、勤務開始時刻と勤務終了時刻の差から、合計休憩時間を引いた時間のことを指します。<br>
ページネーションを利用しており、１ページにつき最大５件が表示されます。<br>
このページにアクセスしたとき最初に表示されるのは、表示している当日の勤怠・休憩レコードの一覧です。<br>
#### 別日の一覧を表示する
日付の左側に表示されているボタンをクリックすることで、前日の一覧を表示します。<br>
また、日付の右側に表示されているボタンをクリックすることで、翌日の一覧を表示します。<br>
<br>
### ユーザー一覧ページ
![user](https://github.com/matsudayuki8140/attendance/assets/129087994/0a63185a-0688-4485-9bfb-2744543117d1)
ユーザー登録されている情報のユーザーIDと名前を一覧表示します。<br>
ページネーションを利用しており、１ページにつき最大５件が表示されます。<br>
名前をクリックすることで、後述のユーザー別勤怠表ページにアクセスできます。<br>
<br>
### ユーザー別勤怠表ページ
![userAttendance](https://github.com/matsudayuki8140/attendance/assets/129087994/d951032b-6511-4a09-afaa-f2952aea4d54)
日付別一覧ページのアレンジページです。ユーザーごとの勤怠・休憩レコードを取得し、日付、勤務開始時刻、勤務終了時刻、合計休憩時間、勤務時間を一覧表示します。<br>
ページネーションを利用しており、１ページにつき最大５件が表示されます。<br>
#### 他ユーザーの一覧を表示する
名前の左右に表示されているボタンをクリックすることで、ユーザーIDが前後のユーザーの勤怠表を表示します。<br>
<br>
## 実行環境
HTML5 <br>
CSS3 <br>
PHP 7.4.9 <br>
Laravel Framework 8.83.27　<br>
Laravel breeze <br>
mysql 15.1 <br>
Mailhog<br>
AWS EC2(プラットフォーム：Amazon Linux2) RDS(エンジン：MySQL)<br>
## テーブル設計
### users
<table>
        <tr>
            <th>カラム名</th>
            <th>型</th>
            <th>PRIMARY KEY</th>
            <th>UNIQUE KEY</th>
            <th>NOT NULL</th>
            <th>FOREIGN KEY</th>
        </tr>
        <tr>
            <td>name</td>
            <td>string</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
        <tr>
            <td>email</td>
            <td>string</td>
            <td></td>
            <td>〇</td>
            <td>〇</td>
            <td></td>
        </tr>
        <tr>
            <td>email_verified_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>password</td>
            <td>string</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>updated_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>id</td>
            <td>unsigned bigint</td>
            <td>〇</td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
    </table>

### worktimes
<table>
        <tr>
            <th>カラム名</th>
            <th>型</th>
            <th>PRIMARY KEY</th>
            <th>UNIQUE KEY</th>
            <th>NOT NULL</th>
            <th>FOREIGN KEY</th>
        </tr>
        <tr>
            <td>user_id</td>
            <td>unsigned bigint</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td>〇</td>
        </tr>
        <tr>
            <td>date</td>
            <td>date</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
        <tr>
            <td>start</td>
            <td>datetime</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
        <tr>
            <td>end</td>
            <td>datetime</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>updated_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>id</td>
            <td>unsigned bigint</td>
            <td>〇</td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
</table>

### breaktimes
<table>
        <tr>
            <th>カラム名</th>
            <th>型</th>
            <th>PRIMARY KEY</th>
            <th>UNIQUE KEY</th>
            <th>NOT NULL</th>
            <th>FOREIGN KEY</th>
        </tr>
        <tr>
            <td>worktime_id</td>
            <td>unsigned bigint</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td>〇</td>
        </tr>
        <tr>
            <td>start</td>
            <td>datetime</td>
            <td></td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
        <tr>
            <td>end</td>
            <td>datetime</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>updated_at</td>
            <td>timestamp</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>id</td>
            <td>unsigned bigint</td>
            <td>〇</td>
            <td></td>
            <td>〇</td>
            <td></td>
        </tr>
</table>

## ER図
![atte drawio](https://github.com/matsudayuki8140/attendance/assets/129087994/cfb8a67f-bdf5-4a7e-831b-e1cd0bbed660)

## 環境構築
docker-composeを利用しました。以下の手順でセットアップが出来るはずです。<br>
１．作業ディレクトリにこのリポジトリをクローンする<br>
２．Dockerコンテナを起動する（$ docker-compose up -d --build）<br>
３．PHPコンテナ内にログインして（$ docker-compose exec php bash）コンポーザーをインストール（$ composer install）<br>
４．.envファイルを編集する<br>
