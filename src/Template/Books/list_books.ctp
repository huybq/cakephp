<div class="books index large-9 medium-8 columns content">
    <h3><?= __('Tất cả sách') ?></h3>
      <p><?= $this->Paginator->sort('title','Sắp xếp theo tên sách') ?>
      /<?= $this->Paginator->sort('price', 'Giá') ?></p>
	<?php echo $this->element('book', array('books'=>$books))?>
   	<?php echo $this->element('paginator', array('object'=>'quyển sách')) ?>
</div>
