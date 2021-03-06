# CakePHP EC_site

## 環境構築
1. VirtualBox・Vagrantのインストール
* VirtualBox: https://www.virtualbox.org/wiki/Downloads
* Vagrant: https://www.vagrantup.com/downloads.html
2. boxファイルの登録
`vagrant box add {VM名} {boxファイルダウンロードURL}`
* 今回登録したboxファイル:CentOS 7.2 x64 (Minimal, Puppet 4.2.3, Guest Additions 4.3.30)
* https://github.com/CommanderK5/packer-centos-template/releases/download/0.7.2/vagrant-centos-7.2.box
3. Vagrantfileの作成・設定
* 作成: `vagrant init {VM名}`
* 設定: `vim Vagrantfile` でVagrantfileに以下の情報を追記・コメントアウト
* `config.vm.provision :shell, :path => "provision.sh" //provision.shファイルの設定`
* `config.vm.network "private_network", ip: "192.168.33.10" //VMのIPアドレスの設定`
* `config.vm.synced_folder "./", "/vagrant", :mount_options => ["dmode=777", "fmode=777"] //パーミッションの設定`
4. provision.shファイルの作成（PHP,MySQL,composer,Apche,共有フォルダの設定）
* [provision.sh.zip]( https://github.com/Natsumag/CakePHP_ecsite/files/6289255/provision.sh.zip )
5. Vagrantの起動とssh接続
* 起動: `vagrant up`
* ssh接続: `vagrant ssh`
6. 任意のディレクトを作成し、プロジェクトをcloneする
```
$ mkdir 任意のディレクトリ名 && cd 任意のディレクトリ名
HTTPSもしくはSSHのどちらかのコマンドを実行
$ https://github.com/Natsumag/CakePHP_ecsite.git // HTTPS
$ git@github.com:Natsumag/CakePHP_ecsite.git // SSH
```
7. DBの設定
* ログイン: `mysql -u root -p`
* DBの作成: `CREATE DATABASE ecsite;`
* 確認: `Show Databases;`
* ログアウト: `exit`
8. テーブルの作成とテストデータの挿入
* 移動: `cd /var/www/html/ecsite`
* マイグレーション実行: `bin/cake bake migration`
* シーダー実行: `bin/cake migrations seed`

## 概要
https://www.risoli.jp/ の機能を参考にフライパン専門のECサイトを作成

管理者ユーザ
* お知らせ（notices）、商品カテゴリー（Categories）、商品（Products）、材質（Materials）の登録・編集・削除が可能
* 会員ユーザ（MemberUsers）、お問い合わせ（Contents）、購入履歴（PurchaseHistories、PurchaseHistoryDetails）の閲覧が可能
* お問い合わせ（Contents）の返信が可能
会員ユーザ
* 自身の会員ユーザ（MemberUsers）、カート（Carts）の追加・編集・削除が可能
* 自身の会員ユーザ（MemberUsers）、商品カテゴリー（Categories）、商品（Products）、カート（Carts）、購入履歴（PurchaseHistories）の閲覧が可能

## 構成図
![スクリーンショット 2021-06-29 22 01 23](https://user-images.githubusercontent.com/45713320/123802038-ce1daa00-d925-11eb-958f-1b613f4f1ab2.png)
