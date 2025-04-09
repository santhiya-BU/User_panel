<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->css('style') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
</head>
<body>
    <div class="container" style="display: flex; gap: 20px;">
        <!-- Left Sidebar -->
        <div style="width: 25%;">
            <?= $this->element('user_sidebar') ?>
        </div>

        <!-- Main Content -->
        <div style="width: 75%;">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</body>
</html>
