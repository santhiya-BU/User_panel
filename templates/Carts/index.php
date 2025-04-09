<h2>Your Cart</h2>

<?= $this->Form->create(null, ['url' => ['action' => 'update']]) ?>
<table>
    <tr>
        <th>Title</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    <?php $total = 0; ?>
    <?php foreach ($cart as $item): ?>
        <?php $subtotal = $item['price'] * $item['quantity']; ?>
        <?php $total += $subtotal; ?>
        <tr>
            <td><?= h($item['title']) ?></td>
            <td>₹<?= h($item['price']) ?></td>
            <td><?= $this->Form->control("quantity[{$item['book_id']}]", [
                'type' => 'number',
                'value' => $item['quantity'],
                'label' => false,
                'min' => 1
            ]) ?></td>
            <td>₹<?= $subtotal ?></td>
            <td><a href="<?= $this->Url->build(['action' => 'remove', $item['book_id']]) ?>">Remove</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Total: ₹<?= $total ?></h3>
<?= $this->Form->button('Update Cart') ?>
<?= $this->Form->end() ?>

