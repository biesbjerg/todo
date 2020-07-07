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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $todoItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $todoItem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Todo Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="todoItems form content">
            <?= $this->Form->create($todoItem) ?>
            <fieldset>
                <legend><?= __('Edit Todo Item') ?></legend>
                <?php
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
