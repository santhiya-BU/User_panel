// src/Template/Books/edit.ctp
<h1>Edit Book</h1>

<!-- Form for editing the book -->
<?= $this->Form->create($book) ?>

<!-- Title input -->
<?= $this->Form->control('title', ['label' => 'Book Title']) ?>

<?= $this->Form->control('description', ['label' => 'Description']) ?>

<?= $this->Form->control('price', ['label' => 'Price']) ?>

<!-- Author selection input -->
<?= $this->Form->control('author_id', ['label' => 'Author', 'options' => $authors]) ?>

<!-- Publisher selection input -->
<?= $this->Form->control('publisher_id', ['label' => 'Publisher', 'options' => $publishers]) ?>

<!-- Submit button -->
<?= $this->Form->button(__('Update Book')) ?>

<!-- Close form -->
<?= $this->Form->end() ?>

<!-- Link to back to the index page -->
<?= $this->Html->link('Back to Book List', ['action' => 'index']) ?>
