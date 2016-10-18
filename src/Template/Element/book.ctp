<?php foreach ($books as $book): ?>
	<!--<div class="large-3 medium-3 column productbox" style="float:left">-->
		<?php echo $this->Html->image($book->image, array('width'=>'150px', 'height'=>'230px', 'url'=>'/'.$book->slug));?>
		<div class="producttitle"><?php echo $this->Html->link($book->title,'/'.$book->slug)?></div>
		<div class="productprice">
			<div class="pricetext">Giá: <?= $this->Number->format($book->sale_price) ?> VNĐ</div>
			<div class="pull-right">
				<a href="#" class="btn btn-danger btn-sm" role="button">BUY</a>
			</div>
		</div>
		<?php if (!empty($book->writers)): ?>
			<?php foreach ($book->writers as $writer): ?>
			<?php echo $writer->name.' '; ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<hr/>
	 <!--</div>-->
<?php endforeach; ?>