// src/Template/Publishers/add.ctp
<h1>Add a New Publisher</h1>

<!-- Form for adding a publisher -->
<?= $this->Form->create($publisher) ?>

<!-- Name input -->
<?= $this->Form->control('name', ['label' => 'Publisher Name']) ?>

<!-- Author selection input -->
<!-- <?= $this->Form->control('authors._ids', ['label' => 'Authors', 'options' => $authors, 'multiple' => 'multiple']) ?> -->

<!-- Submit button -->
<?= $this->Form->button(__('Save Publisher')) ?>

<!-- Close form -->
<?= $this->Form->end() ?>

<!-- Link to back to the index page -->
<?= $this->Html->link('Back to Publisher List', ['action' => 'index']) ?>
