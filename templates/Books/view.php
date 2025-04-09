<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<style>
    .book-title {
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }
    .book-title:hover {
        color: #007bff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td, th {
        padding: 10px;
        border: 1px solid #ccc;
    }
</style>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books view content">
            <h3><?= h($book->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($book->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($book->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= h($book->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Publisher') ?></th>
                    <td><?= $book->has('publisher') ? $this->Html->link($book->publisher->name, ['controller' => 'Publishers', 'action' => 'view', $book->publisher->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Author') ?></th>
                    <td><?= $book->has('author') ? $this->Html->link($book->author->name, ['controller' => 'Authors', 'action' => 'view', $book->author->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($book->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published Date') ?></th>
                    <td><?= h($book->published_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($book->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($book->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>


<hr>
<h4>Comments</h4>

<?php if (!empty($book->comments)): ?>
    <ul>
        <?php foreach ($book->comments as $comment): ?>
            <li>
                <strong><?= h($comment->name) ?></strong><br>
                <?= nl2br(h($comment->body)) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No comments yet.</p>
<?php endif; ?>

<hr>
<h4>Leave a Comment</h4>

<?= $this->Form->create($comment, ['id' => 'comment-form']) ?>
<?= $this->Form->control('name', ['label' => 'Your Name', 'id' => 'comment-name']) ?>
<?= $this->Form->control('body', ['type' => 'textarea', 'label' => 'Your Comment', 'id' => 'comment-body']) ?>
<?= $this->Form->button('Submit Comment') ?>
<?= $this->Form->end() ?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('comment-form');

    form.addEventListener('submit', function (e) {
        // Allow normal form submission
        // After a brief delay (to allow CakePHP redirect), clear form
        setTimeout(() => {
            document.getElementById('comment-name').value = '';
            document.getElementById('comment-body').value = '';
        }, 100); // 100ms delay for processing
    });
});
</script>

