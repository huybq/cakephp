<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Writer'), ['action' => 'edit', $writer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Writer'), ['action' => 'delete', $writer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $writer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Writers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Writer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="writers view large-9 medium-8 columns content">
    <h3><?= h($writer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($writer->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($writer->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($writer->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($writer->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Biography') ?></h4>
        <?= $this->Text->autoParagraph(h($writer->biography)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Books') ?></h4>
        <?php if (!empty($writer->books)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Category Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Slug') ?></th>
                <th><?= __('Image') ?></th>
                <th><?= __('Info') ?></th>
                <th><?= __('Price') ?></th>
                <th><?= __('Sale Price') ?></th>
                <th><?= __('Pages') ?></th>
                <th><?= __('Publisher') ?></th>
                <th><?= __('Publish Date') ?></th>
                <th><?= __('Link Download') ?></th>
                <th><?= __('Published') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($writer->books as $books): ?>
            <tr>
                <td><?= h($books->id) ?></td>
                <td><?= h($books->category_id) ?></td>
                <td><?= h($books->title) ?></td>
                <td><?= h($books->slug) ?></td>
                <td><?= h($books->image) ?></td>
                <td><?= h($books->info) ?></td>
                <td><?= h($books->price) ?></td>
                <td><?= h($books->sale_price) ?></td>
                <td><?= h($books->pages) ?></td>
                <td><?= h($books->publisher) ?></td>
                <td><?= h($books->publish_date) ?></td>
                <td><?= h($books->link_download) ?></td>
                <td><?= h($books->published) ?></td>
                <td><?= h($books->created) ?></td>
                <td><?= h($books->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Books', 'action' => 'view', $books->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Books', 'action' => 'edit', $books->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Books', 'action' => 'delete', $books->id], ['confirm' => __('Are you sure you want to delete # {0}?', $books->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
