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
            <?= $this->Html->link(__('Edit Todo List'), ['action' => 'edit', $todoList->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Todo List'), ['action' => 'delete', $todoList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoList->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Todo Lists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Todo List'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="todoLists view content">
            <h3><?= h($todoList->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($todoList->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Notes') ?></th>
                    <td><?= h($todoList->notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Color') ?></th>
                    <td><?= h($todoList->color) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($todoList->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($todoList->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($todoList->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Todo Items') ?></h4>
                <?php if (!empty($todoList->todo_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Todo List Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Completed') ?></th>
                            <th><?= __('Due Date') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($todoList->todo_items as $todoItems) : ?>
                        <tr>
                            <td><?= h($todoItems->id) ?></td>
                            <td><?= h($todoItems->todo_list_id) ?></td>
                            <td><?= h($todoItems->title) ?></td>
                            <td><?= h($todoItems->notes) ?></td>
                            <td><?= h($todoItems->completed) ?></td>
                            <td><?= h($todoItems->due_date) ?></td>
                            <td><?= h($todoItems->parent_id) ?></td>
                            <td><?= h($todoItems->lft) ?></td>
                            <td><?= h($todoItems->rght) ?></td>
                            <td><?= h($todoItems->created) ?></td>
                            <td><?= h($todoItems->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TodoItems', 'action' => 'view', $todoItems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'TodoItems', 'action' => 'edit', $todoItems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TodoItems', 'action' => 'delete', $todoItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoItems->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
