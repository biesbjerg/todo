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
            <?= $this->Html->link(__('Edit Todo Item'), ['action' => 'edit', $todoItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Todo Item'), ['action' => 'delete', $todoItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Todo Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Todo Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="todoItems view content">
            <h3><?= h($todoItem->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Todo List') ?></th>
                    <td><?= $todoItem->has('todo_list') ? $this->Html->link($todoItem->todo_list->title, ['controller' => 'TodoLists', 'action' => 'view', $todoItem->todo_list->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($todoItem->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Notes') ?></th>
                    <td><?= h($todoItem->notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Todo Item') ?></th>
                    <td><?= $todoItem->has('parent_todo_item') ? $this->Html->link($todoItem->parent_todo_item->title, ['controller' => 'TodoItems', 'action' => 'view', $todoItem->parent_todo_item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($todoItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($todoItem->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($todoItem->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Due Date') ?></th>
                    <td><?= h($todoItem->due_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($todoItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($todoItem->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completed') ?></th>
                    <td><?= $todoItem->completed ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Todo Items') ?></h4>
                <?php if (!empty($todoItem->child_todo_items)) : ?>
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
                        <?php foreach ($todoItem->child_todo_items as $childTodoItems) : ?>
                        <tr>
                            <td><?= h($childTodoItems->id) ?></td>
                            <td><?= h($childTodoItems->todo_list_id) ?></td>
                            <td><?= h($childTodoItems->title) ?></td>
                            <td><?= h($childTodoItems->notes) ?></td>
                            <td><?= h($childTodoItems->completed) ?></td>
                            <td><?= h($childTodoItems->due_date) ?></td>
                            <td><?= h($childTodoItems->parent_id) ?></td>
                            <td><?= h($childTodoItems->lft) ?></td>
                            <td><?= h($childTodoItems->rght) ?></td>
                            <td><?= h($childTodoItems->created) ?></td>
                            <td><?= h($childTodoItems->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TodoItems', 'action' => 'view', $childTodoItems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'TodoItems', 'action' => 'edit', $childTodoItems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TodoItems', 'action' => 'delete', $childTodoItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childTodoItems->id)]) ?>
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
