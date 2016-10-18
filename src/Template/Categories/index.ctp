<div class="categories index large-9 medium-8 columns content">
    <h3><?= __('Danh mục sách') ?></h3>
            <?php foreach ($categories as $category): ?>
                <?php echo $this->Html->link($category->name, '/danh-muc/'.$category->slug) ?><br/>
            <?php endforeach; ?>
            <?php echo $this->element('paginator', array('object'=>'danh mục')); ?>
</div>
