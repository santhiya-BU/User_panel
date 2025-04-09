// src/Template/Publishers/index.ctp
<h1>Publishers</h1>
<?= $this->Html->link('Add New Publisher', ['action' => 'add'], ['class' => 'button']) ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Books</th>
            <th>Authors</th>
            <th class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($publishers as $publisher): ?>
        <tr>
            <td><?= h($publisher->name) ?></td>
            <td>
                <?php foreach ($publisher->books as $book): ?>
                    <?= h($book->title) ?><br>
                <?php endforeach; ?>
            </td>
            <td>
                <?php foreach ($publisher->authors as $author): ?>
                    <?= h($author->name) ?><br>
                <?php endforeach; ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('Edit', ['action' => 'edit', $publisher->id]) ?>
                <?= $this->Form->postLink('Delete', ['action' => 'delete', $publisher->id], ['confirm' => 'Are you sure?']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
