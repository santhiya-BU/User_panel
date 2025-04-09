<?php 
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Query\SelectQuery;
class CartsController extends AppController
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
        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart') ?? [];

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->set(compact('cart', 'total'));
    }

    public function add($bookId)
    {
        $book = $this->loadModel('Books')->get($bookId);

        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart') ?? [];

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] += 1;
        } else {
            $cart[$bookId] = [
                'book_id' => $bookId,
                'title' => $book->title,
                'price' => $book->price,
                'quantity' => 1,
            ];
        }

        $session->write('Cart', $cart);
        $this->Flash->success(__('Book added to cart.'));
        return $this->redirect(['controller' => 'Carts', 'action' => 'index']);
    }

    public function view()
    {
        $cart = $this->getRequest()->getSession()->read('Cart') ?? [];
        $this->set(compact('cart'));
    }

    public function remove($bookId)
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart');

        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
        }

        $session->write('Cart', $cart);
        return $this->redirect(['action' => 'view']);
    }

    public function update()
    {
        if ($this->request->is('post')) {
            $quantities = $this->request->getData('quantity');
            $cart = $this->getRequest()->getSession()->read('Cart');

            foreach ($quantities as $bookId => $qty) {
                if (isset($cart[$bookId])) {
                    $cart[$bookId]['quantity'] = (int)$qty;
                }
            }

            $this->getRequest()->getSession()->write('Cart', $cart);
            $this->Flash->success('Cart updated.');
        }

        return $this->redirect(['action' => 'view']);
    }


}