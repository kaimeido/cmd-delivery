①Line友達登録
・下記URLからLine友達登録をお願いします。
　https://line.me/R/ti/p/e3RfTtb-9B#~
・名前をメッセージ入力して、ユーザ登録を行います。

②設定ページ
　https://command-delivery.herokuapp.com/setting.php
・ユーザ名、送信有無など設定変更したら、更新ボタンで反映します。
・不要なユーザは削除ボタンから削除可能です。
・「メッセージ送信」ボタンでは、
　送信チェックが入っているユーザにテストメッセージを送ります。

→このユーザ設定情報は、JSONファイルに保存されています。
　https://command-delivery.herokuapp.com/userinfo.json

③AIスピーカでコマンド送信
・設定ページで設定したユーザに対して、発言内容を送信します。

④URL引数にメッセージ指定でコマンド送信
・https://command-delivery.herokuapp.com/sendMessage.php/?msg=テストメッセージ
　※引数が指定されていない場合は、③のコマンドを送信します。
　※シーケンサからアラーム取得時に、実行してください。


■コマンド送信の使用プロフラムとファイル（https://command-delivery.herokuapp.com）

【使用プログラム】
・index.php
　LINEアプリのメインプログラム。
　ユーザ情報登録を行い、PCにメッセージを送る。
　ユーザ情報：userinfo.json
　LINEメッセージ内容：userMsg.json

・clearLineMsg.php
　LINEから送られたメッセージ内容（userMsg.json）をクリアする。
　
・clearVoiceMsg.php
　AIスピーカから送られたメッセージ内容（input.json）をクリアする。
　※直接書かれたファイル（input.txt）は別サーバの為、クリア不可。

・pushMessage.php
　AIスピーカから送られたメッセージをユーザに送信する。
　メッセージ内容のコピーも作成。
　AIスピーカメッセージ内容：input.json

・sendMessage.php
　引数で渡されたメッセージをユーザに送信する。
　※引数がなければ、AIスピーカメッセージ内容を送信。

・setting.php
　Webページでユーザ情報を編集する。
　
【使用ファイル】
・userinfo.json
　ユーザ情報
　LINEユーザID、ユーザ名、送信有無フラグ
　{"LINEユーザID":{"userName":"ユーザ名","delivery":1}

・input.json
　AIスピーカメッセージ内容
　{"SpeakerMsg":"abc"}

・userMsg.json
　LINEメッセージ内容
　{"LINEユーザID":{"msg":"了解しました"}}

