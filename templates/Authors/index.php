// src/Template/Authors/index.ctp
<h1>Authors</h1>
<?= $this->Html->link('Add New Author', ['action' => 'add'], ['class' => 'button']) ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Books</th>
            <th>Publishers</th>
            <th class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($authors as $author): ?>
        <tr>
            <td><?= h($author->name) ?></td>
            <td>
                <?php foreach ($author->books as $book): ?>
                    <?= h($book->title) ?><br>
                <?php endforeach; ?>
            </td>
            <td>
                <?php foreach ($author->publishers as $publisher): ?>
                    <?= h($publisher->name) ?><br>
                <?php endforeach; ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('Edit', ['action' => 'edit', $author->id]) ?>
                <?= $this->Form->postLink('Delete', ['action' => 'delete', $author->id], ['confirm' => 'Are you sure?']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
