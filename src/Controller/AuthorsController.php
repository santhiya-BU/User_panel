<?php
declare(strict_types=1);

// src/Controller/AuthorsController.php
namespace App\Controller;

use App\Controller\AppController;

class AuthorsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Authors');
        $this->loadModel('Books');
        $this->loadModel('Publishers');
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $authors = $this->paginate($this->Authors->find('all', [
            'contain' => ['Books', 'Publishers']
        ]));
        $this->set(compact('authors'));
    }

    public function add()
    {
        $author = $this->Authors->newEmptyEntity();
        if ($this->request->is('post')) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the author.'));
        }
        $publishers = $this->Publishers->find('list');
        $this->set(compact('author', 'publishers'));
    }

    public function edit($id = null)
    {
        $author = $this->Authors->get($id, ['contain' => ['Publishers']]);
        if ($this->request->is(['post', 'put'])) {
            $author = $this->Authors->patchEntity($author, $this->request->getData());
            if ($this->Authors->save($author)) {
                $this->Flash->success(__('The author has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the author.'));
        }
        $publishers = $this->Publishers->find('list');
        $this->set(compact('author', 'publishers'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $author = $this->Authors->get($id);
        if ($this->Authors->delete($author)) {
            $this->Flash->success(__('The author has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the author.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
