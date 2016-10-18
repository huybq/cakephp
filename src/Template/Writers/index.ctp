<div class="writers index large-9 medium-8 columns content">
    <h3><?= __('Danh sách tác giả') ?></h3>
            <?php foreach ($writers as $writer): ?>
                <?php echo $this->Html->link($writer->name, '/tac-gia/'.$writer->slug) ?><br/>
            <?php endforeach; ?>
            <?php echo $this->element('paginator', array('object'=>'tác giả')) ?>
</div>
