<?php
declare(strict_types=1);

// src/Controller/BooksController.php
namespace App\Controller;

use App\Controller\AppController;

class BooksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Books');
        $this->loadModel('Authors');
        $this->loadModel('Publishers');
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        // $books = $this->paginate($this->Books->find('all', [
        //     'contain' => ['Authors', 'Publishers']
        // ]));
        // $this->set(compact('books'));

        $this->loadModel('Authors');
        $this->loadModel('Publishers');

        $query = $this->Books->find()->contain(['Authors', 'Publishers']);

        $search = $this->request->getQuery();

        if (!empty($search['title'])) {
            $query->where(['Books.title LIKE' => '%' . trim($search['title']) . '%']);
        }

        if (!empty($search['description'])) {
            $query->where(['Books.description LIKE' => '%' . trim($search['description']) . '%']);
        }

        if (!empty($search['price'])) {
            $query->where(['Books.price' => $search['price']]);
        }

        if (!empty($search['author_name'])) {
            $query->matching('Authors', function ($q) use ($search) {
                return $q->where(['Authors.name LIKE' => '%' . trim($search['author_name']) . '%']);
            });
        }

        if (!empty($search['publisher_name'])) {
            $query->matching('Publishers', function ($q) use ($search) {
                return $q->where(['Publishers.name LIKE' => '%' . trim($search['publisher_name']) . '%']);
            });
        }

        // $sort = $this->request->getQuery('sort');
        // $direction = $this->request->getQuery('direction', 'asc');

        // $validSortFields = ['title', 'price', 'Books.title', 'Books.price'];

        // if (in_array($sort, $validSortFields)) {
        //     $query->order([$sort => $direction]);
        // } else {
        //     $query->order(['Books.title' => 'asc']); // default
        // }

        $this->paginate = [
            'limit' => 10,
            'order' => ['Books.title' => 'asc'],
            'sortWhitelist' => ['Books.title', 'Books.price'], // only allow sorting on these fields
            'contain' => ['Authors', 'Publishers']
        ];
    
        $books = $this->paginate($query);

        // $books = $query->all();

        $this->set(compact('books', 'search'));
    }

    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            print_r($book);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the book.'));
        }
        $authors = $this->Authors->find('list');
        $publishers = $this->Publishers->find('list');
        $this->set(compact('book', 'authors', 'publishers'));
    }

    public function edit($id = null)
    {
        $book = $this->Books->get($id, ['contain' => ['Authors', 'Publishers']]);
        if ($this->request->is(['post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the book.'));
        }
        $authors = $this->Authors->find('list');
        $publishers = $this->Publishers->find('list');
        $this->set(compact('book', 'authors', 'publishers'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the book.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function update_view($id = null)
    {
        $book = $this->Books->get($id, ['contain' => ['Authors', 'Publishers']]);

        $book->views += 1;
        $this->Books->save($book);
        $this->viewBuilder()->setClassName('Json');

        $this->set([
            'views' => $book->views,
            '_serialize' => ['views']
        ]);
        
    }


    public function like($id = null)
    {
        $this->request->allowMethod(['post', 'ajax']);

        $book = $this->Books->get($id);
        $book->likes += 1;

        if ($this->Books->save($book)) {
            $response = ['status' => 'success', 'likes' => $book->likes];
        } else {
            $response = ['status' => 'error'];
        }

        $this->set([
            'response' => $response,
            '_serialize' => 'response'
        ]);
    }


    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['Authors', 'Publishers','Comments'] // include related data
        ]);

        $comment = $this->Books->Comments->newEmptyEntity();

        if ($this->request->is('post')) {
            $comment = $this->Books->Comments->patchEntity($comment, $this->request->getData());
            $comment->book_id = $book->id;

            if ($this->Books->Comments->save($comment)) {
                $this->Flash->success(__('Comment added successfully.'));
                $comment = $this->Books->Comments->newEmptyEntity();
                return $this->redirect(['action' => 'view', $id]);
                
            }

            $this->Flash->error(__('Unable to save comment.'));
        }

        $this->set(compact('book', 'comment'));
    }

}
