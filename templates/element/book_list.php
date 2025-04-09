<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
        </tr>
    </thead>
    <tbody>

            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= h($book->title) ?></td>
                    <td><?= h($book->author->name ?? 'N/A') ?></td>
                    <td><?= h($book->publisher->name ?? 'N/A') ?></td>
                </tr>
            <?php endforeach; ?>
        
    </tbody>
</table>