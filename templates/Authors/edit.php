// src/Template/Authors/edit.ctp
<h1>Edit Author</h1>

<!-- Form for editing the author -->
<?= $this->Form->create($author) ?>

<!-- Name input -->
<?= $this->Form->control('name', ['label' => 'Author Name']) ?>

<!-- Publisher selection input -->
<?= $this->Form->control('publishers._ids', ['label' => 'Publishers', 'options' => $publishers, 'multiple' => 'multiple']) ?>

<!-- Submit button -->
<?= $this->Form->button(__('Update Author')) ?>

<!-- Close form -->
<?= $this->Form->end() ?>

<!-- Link to back to the index page -->
<?= $this->Html->link('Back to Author List', ['action' => 'index']) ?>
