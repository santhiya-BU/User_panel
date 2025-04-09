<!-- <h2>Available Books</h2>

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
</table> -->

<h2>Available Books</h2>

<div id="book-list">
    <?= $this->element('book_list', ['books' => $books]) ?>
</div>

<script>
$(document).ready(function() {
  
    $('#filter-form input[type="checkbox"]').on('change', function() {
        let formData = $('#filter-form').serialize();

        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'filter']) ?>",
            method: "GET",
            data: formData,
            success: function(response) {
                $('#book-list').html(response);
            }
        });
    });
});
</script>
