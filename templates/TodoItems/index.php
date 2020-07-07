<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoItem[]|\Cake\Collection\CollectionInterface $todoItems
 */
?>
<div class="todoItems index content">
    <?= $this->Html->link(__('New Todo Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Todo Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('todo_list_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('notes') ?></th>
                    <th><?= $this->Paginator->sort('completed') ?></th>
                    <th><?= $this->Paginator->sort('due_date') ?></th>
                    <th><?= $this->Paginator->sort('parent_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todoItems as $todoItem): ?>
                <tr>
                    <td><?= $this->Number->format($todoItem->id) ?></td>
                    <td><?= $todoItem->has('todo_list') ? $this->Html->link($todoItem->todo_list->title, ['controller' => 'TodoLists', 'action' => 'view', $todoItem->todo_list->id]) : '' ?></td>
                    <td><?= h($todoItem->title) ?></td>
                    <td><?= h($todoItem->notes) ?></td>
                    <td><?= h($todoItem->completed) ?></td>
                    <td><?= h($todoItem->due_date) ?></td>
                    <td><?= $todoItem->has('parent_todo_item') ? $this->Html->link($todoItem->parent_todo_item->title, ['controller' => 'TodoItems', 'action' => 'view', $todoItem->parent_todo_item->id]) : '' ?></td>
                    <td><?= h($todoItem->created) ?></td>
                    <td><?= h($todoItem->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $todoItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $todoItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $todoItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoItem->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
