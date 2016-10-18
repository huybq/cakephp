<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Books Writer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Writers'), ['controller' => 'Writers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Writer'), ['controller' => 'Writers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="booksWriters index large-9 medium-8 columns content">
    <h3><?= __('Books Writers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('book_id') ?></th>
                <th><?= $this->Paginator->sort('writer_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($booksWriters as $booksWriter): ?>
            <tr>
                <td><?= $booksWriter->has('book') ? $this->Html->link($booksWriter->book->title, ['controller' => 'Books', 'action' => 'view', $booksWriter->book->id]) : '' ?></td>
                <td><?= $booksWriter->has('writer') ? $this->Html->link($booksWriter->writer->name, ['controller' => 'Writers', 'action' => 'view', $booksWriter->writer->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $booksWriter->book_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booksWriter->book_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booksWriter->book_id], ['confirm' => __('Are you sure you want to delete # {0}?', $booksWriter->book_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
