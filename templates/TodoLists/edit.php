<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoList $todoList
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?= $this->Form->create($todoList) ?>
            <fieldset>
                <legend><?= __('Edit Todo List') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('color', [
                        'type' => 'color'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
