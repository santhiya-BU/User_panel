// src/Template/Books/index.ctp
<h1>Books</h1>
<style>
    ul {
        list-style: none;
        padding: 0;
    }
    ul li {
        margin-bottom: 15px;
        padding: 10px;
        background: #f4f4f4;
        border-left: 4px solid #007bff;
    }
    .carts{
        background:rgb(79, 177, 112);
        color: #FFFFFF;
        font-size: 16px;
        font-weight: 600;
        padding : 10px;
    }

    .cart-class {
        width: 20%;
    }
</style>

<?php
$urlParams = $this->request->getQuery();
$sortField = $urlParams['sort'] ?? null;
$dir = $urlParams['direction'] ?? 'asc';
$arrow = ($dir === 'asc') ? ' ▲' : ' ▼';
?>
<?= $this->Form->create(null, ['type' => 'get']) ?>

<fieldset>
    <legend>Search Books</legend>

    <?= $this->Form->control('title', ['label' => 'Book Title']) ?>
    <?= $this->Form->control('description', ['label' => 'Description']) ?>
    <?= $this->Form->control('price', ['label' => 'Price']) ?>
    <?= $this->Form->control('author_name', ['label' => 'Author Name']) ?>
    <?= $this->Form->control('publisher_name', ['label' => 'Publisher Name']) ?>

    <?= $this->Form->button('Search') ?>
</fieldset>

<?= $this->Form->end() ?>

<?= $this->Html->link('Add New Book', ['action' => 'add'], ['class' => 'button']) ?>
<table>
    <thead>
        <tr>
            <th><?= $this->Html->link('Title' . ($sortField === 'title' ? $arrow : ''), ['?' => array_merge($urlParams, ['sort' => 'title', 'direction' => $dir === 'asc' ? 'desc' : 'asc'])]) ?></th>
            <th>Description</th>
            <th><?= $this->Html->link('Price' . ($sortField === 'price' ? $arrow : ''), ['?' => array_merge($urlParams, ['sort' => 'price', 'direction' => $dir === 'asc' ? 'desc' : 'asc'])]) ?></th>
            <th>Author</th>
            <th>Publisher</th>
            <th class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
        <tr>
            <td>
                <a href="<?= $this->Url->build(['controller' => 'Books', 'action' => 'view', $book->id]) ?>" class="book-title">
                    <?= h($book->title) ?>
                </a>
            </td>
            <td><?= h($book->description) ?></td>
            <td><?= h($book->price) ?></td>
            <td><?= h($book->author->name) ?></td>
            <td><?= h($book->publisher->name) ?></td>
            <td class="actions">
                <?= $this->Html->link('Edit', ['action' => 'edit', $book->id]) ?>
                <?= $this->Form->postLink('Delete', ['action' => 'delete', $book->id], ['confirm' => 'Are you sure?']) ?>
            </td>
            <td>
                <button class="like-btn" data-id="<?= $book->id ?>">👍 Like (<?= h($book->likes) ?>)</button>
            </td>
            <td>
                <span class="book-title" data-id="<?= $book->id ?>">
                    👁️ <?= h($book->views) ?>
                </span>
            </td>
            <td class="cart-class">
            <?= $this->Form->postLink(
                'Add to Cart',
                ['controller' => 'Carts', 'action' => 'add', $book->id],
                ['class' => 'btn btn-sm btn-primary carts']
            ) ?>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< Prev') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Next >') ?>
    </ul>
</div>





<script>
document.querySelectorAll('.like-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const bookId = this.getAttribute('data-id');
        fetch('/books/like/' + bookId, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': <?= json_encode($this->request->getAttribute('csrfToken')) ?>,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.response.status === 'success') {
                this.innerHTML = `👍 Like (${data.response.likes})`;
            }
        });
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.book-title').forEach(elem => {
        elem.addEventListener('mouseenter', function () {
            const bookId = this.getAttribute('data-id');

            fetch("/books/update_view/" + bookId, {
                method: "POST",
                headers: {
                    "X-CSRF-Token": <?= json_encode($this->request->getAttribute('csrfToken')) ?>,
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                console.log("Views updated to", data.views);
            })
            .catch(error => console.error("Error updating views:", error));
        });
    });
});

</script>
