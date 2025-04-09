// src/Template/Authors/add.ctp
<h1>Add a New Author</h1>

<!-- Form for adding an author -->
<?= $this->Form->create($author) ?>

<!-- Name input -->
<?= $this->Form->control('name', ['label' => 'Author Name']) ?>


<!-- Publisher selection input -->
<!-- <?= $this->Form->control('publishers._ids', ['label' => 'Publishers', 'options' => $publishers, 'multiple' => 'multiple']) ?> -->

<!-- Submit button -->
<?= $this->Form->button(__('Save Author')) ?>

<!-- Close form -->
<?= $this->Form->end() ?>

<!-- Link to back to the index page -->
<?= $this->Html->link('Back to Author List', ['action' => 'index']) ?>
