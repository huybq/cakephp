<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Books Writer'), ['action' => 'edit', $booksWriter->book_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Books Writer'), ['action' => 'delete', $booksWriter->book_id], ['confirm' => __('Are you sure you want to delete # {0}?', $booksWriter->book_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Books Writers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Books Writer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Writers'), ['controller' => 'Writers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Writer'), ['controller' => 'Writers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="booksWriters view large-9 medium-8 columns content">
    <h3><?= h($booksWriter->book_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Book') ?></th>
            <td><?= $booksWriter->has('book') ? $this->Html->link($booksWriter->book->title, ['controller' => 'Books', 'action' => 'view', $booksWriter->book->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Writer') ?></th>
            <td><?= $booksWriter->has('writer') ? $this->Html->link($booksWriter->writer->name, ['controller' => 'Writers', 'action' => 'view', $booksWriter->writer->id]) : '' ?></td>
        </tr>
    </table>
</div>
