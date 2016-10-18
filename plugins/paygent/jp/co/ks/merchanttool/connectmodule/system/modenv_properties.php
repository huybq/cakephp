<?php
### Client Certificate File        ###
### クライアント証明書ファイルパス ###
paygentB2Bmodule.client_file_path=D:/xampp/htdocs/Develop/app/Plugin/MdlPaygent/Mdev-20130909_client_cert.pem

### Trusted Server Certificate ###
### 認証済みのCAファイルパス   ###
paygentB2Bmodule.ca_file_path=D:/xampp/htdocs/Develop/app/Plugin/MdlPaygent/curl-ca-bundle.crt



### Proxy Server Settings ( Edit them when connections are proxied) ###
### プロキシサーバー設定（プロキシサーバーを使用する場合のみ設定）  ###
paygentB2Bmodule.proxy_server_name=
paygentB2Bmodule.proxy_server_ip=
paygentB2Bmodule.proxy_server_port=0

### Default ID/Password (Used when these values are not specified within programs) ###
### 接続ID、接続パスワードが設定されない場合に使用されるデフォルト値（空白可）     ###
paygentB2Bmodule.default_id=
paygentB2Bmodule.default_password=

### Timeout value in second ###
### タイムアウト値（秒）     ###
paygentB2Bmodule.timeout_value=35

### Program Log File     ###
### ログファイル出力パス ###
paygentB2Bmodule.log_output_path=D:/xampp/htdocs/Develop/app/log/test.log

###デバッグオプション###
# 1:リクエスト/レスポンスをログ出力
# 0:エラー時のみ出力
# ※本番稼動時は必ず0を設定してください
paygentB2Bmodule.debug_flg=0

#!!!  DO NOT EDIT BELOW THIS LINE   !!!
#!!! 以下の値は編集しないでください !!!

###最大照会件数（2000件がペイジェントシステムの最大値なのでそれ以上の値は無効）###
paygentB2Bmodule.select_max_cnt=2000

###CSV出力対象###
paygentB2Bmodule.telegram_kind.ref=027,090
###ATM決済URL###
paygentB2Bmodule.url.01=https://sandbox.paygent.co.jp/n/atm/request
###クレジットカード決済URL1###
paygentB2Bmodule.url.02=https://sandbox.paygent.co.jp/n/card/request
###クレジットカード決済URL2###
paygentB2Bmodule.url.11=https://sandbox.paygent.co.jp/n/card/request
###クレジットカード決済(多通貨)URL###
paygentB2Bmodule.url.18=https://sandbox.paygent.co.jp/n/card/request
###クレジットカード決済(端末読取)URL###
paygentB2Bmodule.url.19=https://sandbox.paygent.co.jp/n/card/request
###コンビニ番号方式決済URL###
paygentB2Bmodule.url.03=https://sandbox.paygent.co.jp/n/conveni/request
###コンビニ帳票方式決済URL###
paygentB2Bmodule.url.04=https://sandbox.paygent.co.jp/n/conveni/request_print
###銀行ネット決済URL###
paygentB2Bmodule.url.05=https://sandbox.paygent.co.jp/n/bank/request
###銀行ネット決済ASPURL###
paygentB2Bmodule.url.06=https://sandbox.paygent.co.jp/n/bank/requestasp
###仮想口座決済URL###
paygentB2Bmodule.url.07=https://sandbox.paygent.co.jp/n/virtualaccount/request
###決済情報照会URL###
paygentB2Bmodule.url.09=https://sandbox.paygent.co.jp/n/ref/request
###決済情報差分照会URL###
paygentB2Bmodule.url.091=https://sandbox.paygent.co.jp/n/ref/paynotice
###キャリア継続課金差分照会URL###
paygentB2Bmodule.url.093=https://sandbox.paygent.co.jp/n/ref/runnotice
###決済情報照会URL###
paygentB2Bmodule.url.094=https://sandbox.paygent.co.jp/n/ref/paymentref
###携帯キャリア決済URL###
paygentB2Bmodule.url.10=https://sandbox.paygent.co.jp/n/c/request
###携帯キャリア決済URL（継続課金用）###
paygentB2Bmodule.url.12=https://sandbox.paygent.co.jp/n/c/request
###ファイル決済URL###
paygentB2Bmodule.url.20=https://sandbox.paygent.co.jp/n/o/requestdata
###電子マネー決済URL###
paygentB2Bmodule.url.15=https://sandbox.paygent.co.jp/n/emoney/request
###PayPal決済URL###
paygentB2Bmodule.url.13=https://sandbox.paygent.co.jp/n/paypal/request
###カード番号照会URL###
paygentB2Bmodule.url.095=https://sandbox.paygent.co.jp/n/ref/cardnoref
###後払い決済URL###
paygentB2Bmodule.url.22=https://sandbox.paygent.co.jp/n/later/request
?>