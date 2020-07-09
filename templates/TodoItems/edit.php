<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoItem $todoItem
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1><?= h($todoList->title) ?></h1>

            <?= $this->Form->create($todoItem) ?>
            <fieldset>
                <legend><?= __('Edit Todo Item') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('notes', ['type' => 'textarea']);
                    echo $this->Form->control('is_completed');
                    echo $this->Form->control('due_date', ['empty' => true]);
                    echo $this->Form->control('parent_id', ['options' => $parentTodoItems, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
