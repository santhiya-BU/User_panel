// src/Template/Books/add.ctp
<h1>Add a New Book</h1>

<!-- Form for adding a book -->
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
<?= $this->Form->button(__('Save Book')) ?>

<!-- Close form -->
<?= $this->Form->end() ?>

<!-- Link to back to the index page -->
<?= $this->Html->link('Back to Book List', ['action' => 'index']) ?>
