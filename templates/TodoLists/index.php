<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoList[]|\Cake\Collection\CollectionInterface $todoLists
 */
?>
<div class="todoLists index content">
    <?= $this->Html->link(__('New Todo List'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Todo Lists') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('notes') ?></th>
                    <th><?= $this->Paginator->sort('color') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todoLists as $todoList): ?>
                <tr>
                    <td><?= $this->Number->format($todoList->id) ?></td>
                    <td><?= h($todoList->title) ?></td>
                    <td><?= h($todoList->notes) ?></td>
                    <td><?= h($todoList->color) ?></td>
                    <td><?= h($todoList->created) ?></td>
                    <td><?= h($todoList->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $todoList->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $todoList->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $todoList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoList->id)]) ?>
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
