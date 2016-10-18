<div class="categories view large-9 medium-8 columns content">
    <h3>Sách về lĩnh vực <?= h($category->name) ?></h3>
    <div class="related">
        <?php if (!empty($books) && count($books) > 0){ ?>
			<?php echo $this->element('book', array('books'=>$books)); ?>
			<?php echo $this->element('paginator', array('object'=>'quyển sách')); ?>
        <?php } else { ?>
        	<h4><?php echo __("Không có quyển sách nào !"); ?></h4>
        <?php } ?>

    </div>
</div>
