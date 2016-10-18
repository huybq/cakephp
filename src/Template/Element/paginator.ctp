<div class="paginator" style="padding-top: 50px;clear: both;">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p style="text-align: center;"><?= $this->Paginator->counter("Trang {{page}}/{{pages}}, đang hiển thị {{current}} trong tổng số {{count}} ".$object.".") ?></p>
</div>