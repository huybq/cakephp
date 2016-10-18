<div class="books index large-9 medium-8 columns content">
    <h3><?= __('Trang chủ') ?></h3>
    <p><?php echo $this->Html->link('Xem toàn bộ sách','/xem-toan-bo') ?></p>
	<?php echo $this->element('book', array('books'=>$books))?>
</div>
