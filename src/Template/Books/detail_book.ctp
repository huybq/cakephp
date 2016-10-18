<div class="books index large-9 medium-8 columns content">
    <h3><?= __('Chi tiết sách') ?></h3>
	<div class="product large-4 medium-4 service-image-left">
		<center>
			<img id="item-display" src="/CREATETEST/webroot<?= h($book->image) ?>" alt=""></img>
		</center>
	</div>
	<div class="large-5 medium-4">
		<div class="product-title"><?= h($book->title) ?></div>
		<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
		<hr>
		<div class="product-price"><?= $this->Number->format($book->sale_price) ?> VNĐ</div>
		<hr>
		<div class="btn-group cart">
			<button type="button" class="btn btn-success">
				Add to cart
			</button>
		</div>
		<div class="btn-group wishlist">
			<button type="button" class="btn btn-danger">
				Add to wishlist
			</button>
		</div>
	</div>
</div>