<?php
declare(strict_types=1);

// src/Controller/PublishersController.php
namespace App\Controller;

use App\Controller\AppController;

class PublishersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Publishers');
        $this->loadModel('Books');
        $this->loadModel('Authors');
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $publishers = $this->paginate($this->Publishers->find('all', [
            'contain' => ['Books', 'Authors']
        ]));
        $this->set(compact('publishers'));
    }

    public function add()
    {
        $publisher = $this->Publishers->newEmptyEntity();
        if ($this->request->is('post')) {
            $publisher = $this->Publishers->patchEntity($publisher, $this->request->getData());
            if ($this->Publishers->save($publisher)) {
                $this->Flash->success(__('The publisher has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the publisher.'));
        }
        $authors = $this->Authors->find('list');
        $this->set(compact('publisher', 'authors'));
    }

    public function edit($id = null)
    {
        $publisher = $this->Publishers->get($id, ['contain' => ['Authors']]);
        if ($this->request->is(['post', 'put'])) {
            $publisher = $this->Publishers->patchEntity($publisher, $this->request->getData());
            if ($this->Publishers->save($publisher)) {
                $this->Flash->success(__('The publisher has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the publisher.'));
        }
        $authors = $this->Authors->find('list');
        $this->set(compact('publisher', 'authors'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $publisher = $this->Publishers->get($id);
        if ($this->Publishers->delete($publisher)) {
            $this->Flash->success(__('The publisher has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the publisher.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

