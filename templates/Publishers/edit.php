// src/Template/Publishers/edit.ctp
<h1>Edit Publisher</h1>

<!-- Form for editing the publisher -->
<?= $this->Form->create($publisher) ?>

<!-- Name input -->
<?= $this->Form->control('name', ['label' => 'Publisher Name']) ?>

<!-- Author selection input -->
<?= $this->Form->control('authors._ids', ['label' => 'Authors', 'options' => $authors, 'multiple' => 'multiple']) ?>

<!-- Submit button -->
<?= $this->Form->button(__('Update Publisher')) ?>

<!-- Close form -->
<?= $this->Form->end() ?>

<!-- Link to back to the index page -->
<?= $this->Html->link('Back to Publisher List', ['action' => 'index']) ?>
