

# Task Share

シンプルなデザインにより、視覚的に分かりやすいチームタスク管理アプリです。  
チーム員の担当タスク数の表示や各タスクごとのチャット&メモ機能により、タスクの振り分け・進捗管理・話し合いなど、これ一つで一括管理できます。
<br />
<br />
## 制作した目的

主に2つです。

#### 1. オンラインでも、チーム全体の進捗状況を把握できる
コロナ渦のようにオンラインでのチーム作業では、情報共有の機会が圧倒的に少なくなります。  
チーム全体で「誰が何をやっているのか」を一目で把握できるようにしました。

#### 2. タスクをあとからも振り返りやすくする  
タスクごとにチャットとメモ機能を付けることで、進捗過程や要点を簡単に振り返られるようにしました。  
またチャットで「進捗過程」、メモで「まとめ」を振り返られるので、議事録などにまとめ直す手間も省けます。
<br />
<br />
<br />
## 工夫した点
チームタスクには、外部に漏れてはいけない情報も多いと考え、  
以下のようにセキュリティを重視しました。  
<br />
・ログイン機能(二段階認証も搭載済み)  
・チームのパスワード検索機能  
・検索後もチームに入るためには管理者許可が必要  
・意図しないURLから侵入を防ぐcheckRelationメソッドをつくる
<br />
<br />
<br />
## 使い方

### トップ画面
___
![トップ画面](readme_group_home.png)


チームタスクが付箋メモとして表示されています。  
緊急性と重要性に応じて、ドラッグで自由に配置できます。  
またタスク内の【担当する！】により、押したユーザーの個人タスクへ追加できます。
 <br />
 <br />
### トップ画面(サイド)
___
![サイド画面](readme_group_menu.png)

トップ画面右上のチーム名ボタンを押すと、チームメニューが表示されます。  
メニューではメンバー名とメンバーの担当タスク数を確認できます。  
管理者のみ管理者メニューが表示されます。
 <br />
 <br />
### チャット&メモ画面
___
![チャット&メモ画面](readme_group_chat.png)

トップ画面のタスク内の【More】を押すと、上記の画面が表示されます。  
各タスクごとにチャットとメモを残すことができます。  
前述の通り、チャットが「進捗過程」、メモが「まとめ」の役割を果たし振り返りも容易です。
<br />
<br />
<br />
## URL

http://heroku-task-share.herokuapp.com/  

【テストアカウント】  
メールアドレス：test1@test.com  
パスワード：test12021  

ぜひテストアカウント又は会員登録をして一度ご利用ください！
<br />
<br />
<br />
## 使用技術

・HTML/CSS  
・JavaScript  
・PHP 7.4.1  
・Laravel 6.0  
・MySQL 5.7.24  
<br />
<br />
<br />
## 機能一覧

・ユーザー登録/ログイン(二段階認証も搭載しているが適用していない)   
<br />
・個人タスク管理  
-- タスク/フォルダCRUD  
 <br />
・チームタスク管理  
-- タスク/フォルダCRUD  
-- チャット機能  
-- メモ機能  
 <br />
・チーム作成/パスワード検索機能







