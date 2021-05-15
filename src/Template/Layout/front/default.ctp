<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'RISOLI Japan リゾリ ジャパン';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('./front/' . 'base.css') ?>
    <?= $this->Html->css('./front/' . 'products.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="header">
    <div id="headerInner" class="clearfix">

        <div class="headBlock">
            <div id="toggle">
                <div>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="logo"><a href="https://www.risoli.jp/"><img src="https://www.risoli.jp/wp/wp-content/themes/welcart_basic/risoli/images/common/logo.png" alt="RISOLI Il Pressofuso in Cucina"></a></div>
            <ul id="sns">
                <li class="cart"><a href="#" title="ショッピング"><img src="webroot/img/front/btn_cart.png" alt="海の写真" title="空と海"></a></li>
                <li class="fb"><a href="https://www.facebook.com/RISOLIJapan-863314863828540/" target="_blank" title="RISOLI Official Facebook"><img src="webroot/img/front/btn_cart.png" alt="海の写真" title="空と海">Facebook</a></li>
                <li class="ig"><a href="https://www.instagram.com/kaorit2017/" target="_blank" title="RISOLI Official Instagram"><img src="webroot/img/front/btn_cart.png" alt="海の写真" title="空と海">Instagram</a></li>
            </ul>
        </div>

        <nav>
            <ul id="global">
                <li class="home"><a href="https://www.risoli.jp/">Home</a></li>
                <li class="concept"><a href="https://www.risoli.jp/concept">Concept</a></li>
                <li class="products"><a href="http://192.168.33.10/ecsite/generalProducts">Products</a>
                    <ul>
                        <li><a href="https://www.risoli.jp/archives/84"><span>フライパン</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/9"><span>ディープパン</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/157"><span>シチューポット</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/159"><span>シチューパン</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/179"><span>ソースポット</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/175"><span>グリル</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/177"><span>プレートグリル</span></a></li>
                        <li><a href="https://www.risoli.jp/products/#others"><span>その他のアイテム</span></a></li>
                        <li><a href="https://www.risoli.jp/products/#accessories"><span>アクセサリー</span></a></li>
                        <li><a href="https://www.risoli.jp/archives/828"><span>オリーブオイル</span></a></li>

                    </ul>
                </li>
                <li class="charm"><a href="https://www.risoli.jp/charm">RISOLIの魅力</a>
                    <ul>
                        <li><a href="https://www.risoli.jp/charm/#alfredo">デザイナー アルフレッドの思い</a></li>
                        <li><a href="https://www.risoli.jp/charm/#amore">アモーレプラザ（新着情報！）</a></li>
                    </ul>
                </li>
                <li class="guide"><a href="https://www.risoli.jp/guide">ご利用ガイド</a>
                    <ul>
                        <li><a href="https://www.risoli.jp/guide#guide1">送料・商品のお届けについて</a></li>
                        <li><a href="https://www.risoli.jp/guide#guide2">返品・キャンセルについて</a></li>
                        <li><a href="https://www.risoli.jp/guide#guide3">お支払いについて</a></li>
                        <li><a href="https://www.risoli.jp/guide#guide4">セキュリティ・<br>プライバシーポリシーについて</a></li>
                        <li><a href="https://www.risoli.jp/guide#guide6">商品Q&amp;A</a></li>
                        <li><a href="https://www.risoli.jp/media" target="_blank">各メディアへの商品の貸し出しについて</a></li>
                        <li><a href="https://www.risoli.jp/legal">特定商取引法に基づく表記</a></li>
                    </ul>
                </li>
                <li class="shopping"><a href="https://www.risoli.jp/usces-cart" title="ショッピング">ショッピング</a></li>
            </ul>
        </nav>

    </div>
</div><?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
