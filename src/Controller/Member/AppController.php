<?php

namespace App\Controller\Member;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');

        $this->loadComponent('Auth', [
            'authorize'      => [ 'Controller'],
            'authenticate'   => [ 'Form' => [
                'userModel' => 'MemberUsers',
                'fields' => ['username' => 'email', 'password' => 'password']
            ]
            ],
            'loginRedirect'  => [ 'controller' => 'MemberUsers' , 'action' => 'index' ],
            'logoutRedirect' => [ 'controller' => 'MemberUsers' , 'action' => 'login' ],
            'loginAction'    => '/member/MemberUsers/login',
//            'authError'      => 'ログインしてください'
        ]);
    }
}
