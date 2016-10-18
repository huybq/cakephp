<div class="contact form large-9 medium-8 columns content">
    <?= $this->Form->create($contact) ?>
    <fieldset>
        <legend><?= __('Add Book') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email', ['value' => '13:30:00']);
            echo $this->Form->input('body');
            echo $this->Form->select('field',[1=>'A', 2=>'B', 3=>'C', 4=>'D', 5=>'D'],['empty' => '(choose one)']);
            echo $this->Form->checkbox('name', ['hiddenField' => false, 'a'=>'b']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>