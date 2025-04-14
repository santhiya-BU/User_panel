<?php
// src/Controller/UserController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Cookie\Cookie;
use Cake\ORM\Query\SelectQuery;
use DateTime;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Books');
        $this->loadModel('Authors');
        $this->loadModel('Publishers');
        // $this->loadModel('LoginHistories');
        $this->loadComponent('Authentication.Authentication');
        // $this->Authentication->addUnauthenticatedActions(['login', 'logout','register']);
      
    }


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'logout', 'register']);
    }

//     public function index()
//     {
//         $this->viewBuilder()->setLayout('user');

//         $books = $this->Books->find('all')->contain(['Authors', 'Publishers']);
//         $authors = $this->Authors->find('all');
//         $publishers = $this->Publishers->find('all');

//         $this->set(compact('books', 'authors', 'publishers'));
//     }


//     public function filter()
// {
//     $this->request->allowMethod(['get', 'ajax']);
//     $this->viewBuilder()->disableAutoLayout();
//     $this->viewBuilder()->setLayout(false);

//     $this->loadModel('Books');
//     $this->loadModel('Authors');
//     $this->loadModel('Publishers');

//     $authors = $this->request->getQuery('authors', []);
//     $publishers = $this->request->getQuery('publishers', []);

//     $query = $this->Books->find()->contain(['Authors', 'Publishers']);

//     if (!empty($authors)) {
//         $query->where(['Books.author_id IN' => $authors]);
//     }

//     if (!empty($publishers)) {
//         $query->where(['Books.publisher_id IN' => $publishers]);
//     }

//     // ✅ Force query execution to get countable result
//     $books = $query->toList(); // OR ->all()

//     $this->set(compact('books'));
//     $this->render('/element/book_list');
// }

public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
      
        if ($result->isValid()) {
            $user = $this->request->getAttribute('identity');
          
            // $this->_trackLogin($user->id);

            // Set secure cookie (replacing deprecated CookieComponent)
            $cookie = new Cookie(
                'user_id',
                (string)$user->id,
                new DateTime('+1 day'), // 👈 expires must be DateTime
                '/',
                '',
                false,
                true, // httpOnly
                null,
                'Lax'
            );
            $this->response = $this->response->withCookie($cookie);

            $this->request->getSession()->write('user_id', $user->id);

            return $this->redirect(['controller' => 'books','action' => 'index'])->withCookie($cookie);
        }

        if ($this->request->is('post')) {
            $this->Flash->error('Invalid credentials');
        }
    }


    // private function _trackLogin($userId)
    // {
    //     $login = $this->LoginHistories->newEntity([
    //         'user_id' => $userId,
    //         'ip_address' => $this->request->clientIp(),
    //     ]);
    //     $this->LoginHistories->save($login);
    // }

}

