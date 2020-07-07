<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoItem $todoItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Todo Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="todoItems form content">
            <?= $this->Form->create($todoItem) ?>
            <fieldset>
                <legend><?= __('Add Todo Item') ?></legend>
                <?php
                    echo $this->Form->control('todo_list_id', ['options' => $todoLists]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('completed');
                    echo $this->Form->control('due_date', ['empty' => true]);
                    echo $this->Form->control('parent_id', ['options' => $parentTodoItems, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
