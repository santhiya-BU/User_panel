<?php
// src/Controller/UserController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query\SelectQuery;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Books');
        $this->loadModel('Authors');
        $this->loadModel('Publishers');
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('user');

        $books = $this->Books->find('all')->contain(['Authors', 'Publishers']);
        $authors = $this->Authors->find('all');
        $publishers = $this->Publishers->find('all');

        $this->set(compact('books', 'authors', 'publishers'));
    }


    public function filter()
{
    $this->request->allowMethod(['get', 'ajax']);
    $this->viewBuilder()->disableAutoLayout();
    $this->viewBuilder()->setLayout(false);

    $this->loadModel('Books');
    $this->loadModel('Authors');
    $this->loadModel('Publishers');

    $authors = $this->request->getQuery('authors', []);
    $publishers = $this->request->getQuery('publishers', []);

    $query = $this->Books->find()->contain(['Authors', 'Publishers']);

    if (!empty($authors)) {
        $query->where(['Books.author_id IN' => $authors]);
    }

    if (!empty($publishers)) {
        $query->where(['Books.publisher_id IN' => $publishers]);
    }

    // ✅ Force query execution to get countable result
    $books = $query->toList(); // OR ->all()

    $this->set(compact('books'));
    $this->render('/element/book_list');
}

}

