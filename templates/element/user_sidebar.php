<!-- <div>
    <h3>Publishers</h3>
    <ul>
        <?php foreach ($publishers as $publisher): ?>
            <li><?= h($publisher->name) ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Authors</h3>
    <ul>
        <?php foreach ($authors as $author): ?>
            <li><?= h($author->name) ?></li>
        <?php endforeach; ?>
    </ul>
</div> -->


<div>
    <h3>Publishers</h3>
    <form id="filter-form">
        <?php foreach ($publishers as $publisher): ?>
            <div>
                <label>
                    <input type="checkbox" name="publishers[]" value="<?= $publisher->id ?>">
                    <?= h($publisher->name) ?>
                </label>
            </div>
        <?php endforeach; ?>

        <h3>Authors</h3>
        <?php foreach ($authors as $author): ?>
            <div>
                <label>
                    <input type="checkbox" name="authors[]" value="<?= $author->id ?>">
                    <?= h($author->name) ?>
                </label>
            </div>
        <?php endforeach; ?>
    </form>
</div>
