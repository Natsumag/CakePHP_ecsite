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

$cakeDescription = '管理画面';

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

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <!-- jQuery -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- bootstrap framework -->
    <?= $this->Html->css('/bootstrap/css/bootstrap.css') ?>
    <?= $this->Html->script('/bootstrap/js/bootstrap.js') ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="#">管理画面</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php if ($this->request->getSession()->read('Auth.User')): ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        AdminUser
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'AdminUsers', 'action' => 'index']) ?>">
                            Index
                        </a>
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'AdminUsers', 'action' => 'add']) ?>">
                            Add
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>">
                            Index
                        </a>
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'add']) ?>">
                            Add
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'Contacts', 'action' => 'index']) ?>">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Material
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Materials', 'action' => 'index']) ?>">
                            Index
                        </a>
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Materials', 'action' => 'add']) ?>">
                            Add
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        MemberUser
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'MemberUsers', 'action' => 'index']) ?>">
                            Index
                        </a>
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'MemberUsers', 'action' => 'add']) ?>">
                            Add
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Notice
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Notices', 'action' => 'index']) ?>">
                            Index
                        </a>
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Notices', 'action' => 'add']) ?>">
                            Add
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Product
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>">
                            Index
                        </a>
                        <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'add']) ?>">
                            Add
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'PurchaseHistoryDetails', 'action' => 'index']) ?>">PurchaseHistoryDetail</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->Url->build(['controller' => 'AdminUsers', 'action' => 'logout']) ?>">Logout</a>
                </li>
            </ul>
        </div>
    <?php else: ?>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->Url->build(['controller' => 'AdminUsers', 'action' => 'login']) ?>">Login</a>
            </li>
        </ul>
    <?php endif; ?>
</nav>
<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
