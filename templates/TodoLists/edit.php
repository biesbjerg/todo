<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoList $todoList
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $todoList->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $todoList->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Todo Lists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="todoLists form content">
            <?= $this->Form->create($todoList) ?>
            <fieldset>
                <legend><?= __('Edit Todo List') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('notes');
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
