<div class="books view large-9 medium-8 columns content">
    <h3><?= h($book->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($book->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><?php echo $this->Html->image($book->image, array('width'=>'150px', 'height'=>'230px')); ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($book->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Sale Price') ?></th>
            <td><?= $this->Number->format($book->sale_price) ?></td>
        </tr>
        <tr>
            <th><?= __('Pages') ?></th>
            <td><?= $this->Number->format($book->pages) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Info') ?></h4>
        <?= $this->Text->autoParagraph(h($book->info)); ?>
    </div>

    <div class="related">
        <h4><?= __('Tác giả') ?></h4>
        <?php if (!empty($book->writers)): ?>
            <?php foreach ($book->writers as $writers): ?>
            <?php echo $this->Html->link($writers->name,'/tac-gia/'.$writers->slug); ?><br/>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

	<div class="related">
        <h4><?= __('Sách cùng danh mục') ?></h4>
        <?php if (!empty($relateBooks)): ?>
        	<?php echo $this->element('book', array('books'=>$relateBooks)); ?>
        <?php endif; ?>
    </div>

    <div class="related">
        <h4><?= __('Bình luận') ?></h4>
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
	            <p>Nội dung: <?php echo $comment->content ?><br/>Người bình luận: <?php echo $comment->user->username ?></p>
	            <hr/>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


</div>
