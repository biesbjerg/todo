<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1><?= h($todoList->title) ?></h1>
            <div class="actions mt-4 mb-3">
                <?php
                    echo $this->Html->link(__('Add Item'), ['_name' => 'add_todo_item'], [
                        'class' => [
                            'btn',
                            'btn-primary'
                        ]
                    ]);
                    echo $this->Html->link(__('Settings'), ['_name' => 'edit_todo_list', 'list_id' => $todoList->id, 'slug' => $todoList->slug], [
                        'class' => [
                            'btn',
                            'btn-link',
                            'text-secondary',
                            'btn-sm'
                        ]
                    ]);
                    echo $this->Form->postLink(__('Delete'), ['controller' => 'TodoLists', 'action' => 'delete', $todoList->id], [
                        'confirm' => __('Are you sure you want to delete list?'),
                        'class' => [
                            'btn',
                            'btn-link',
                            'text-danger',
                            'btn-sm'
                        ]
                    ]);
                ?>
            </div>

            <?php if (!empty($todoList->notes)) : ?>
                <small><?= h($todoList->notes) ?></small>
            <?php endif ?>

            <?php if (empty($todoList->todo_items)) : ?>

                <p><?= __('List has no items yet...') ?></p>

            <?php endif ?>

            <?php if (!empty($todoList->todo_items)) : ?>

            <?php foreach ($todoList->todo_items as $todoItem) : ?>

            <div class="row flex-nowrap py-2 border-bottom">
                <div class="col-auto pr-0">
                    <?php
                        echo $this->Form->create($todoItem, [
                            'class' => 'submit-on-change',
                            'url' => [
                                'controller' => 'TodoItems',
                                'action' => 'updateIsCompleted',
                                $todoItem->id
                            ]
                        ]);
                        echo $this->Form->checkbox('is_completed');
                        echo $this->Form->end();
                    ?>
                </div>
                <div class="col">
                    <div style="text-indent: <?= $todoItem->level ?>em">
                        <?php
                            if ($todoItem->is_completed) {
                                echo $this->Html->tag('del', h($todoItem->title));
                            } else {
                                echo h($todoItem->title);
                            }
                        ?>
                    </div>
                </div>
                <div class="col">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TodoItems', 'action' => 'edit', 'item_id' => $todoItem->id]) ?>
                    <?= $this->Form->postLink(__('Move up'), ['controller' => 'TodoItems', 'action' => 'move_up', $todoItem->id]) ?>
                    <?= $this->Form->postLink(__('Move down'), ['controller' => 'TodoItems', 'action' => 'move_down', $todoItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TodoItems', 'action' => 'delete', $todoItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoItem->id), 'class' => 'text-danger']) ?>
                </div>
            </div>

            <?php endforeach ?>

            <!--
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <?php foreach ($todoList->todo_items as $todoItem) : ?>
                    <tr>
                        <td style="width: 1em">
                            <?php
                                echo $this->Form->create($todoItem, [
                                    'class' => 'submit-on-change',
                                    'url' => [
                                        'controller' => 'TodoItems',
                                        'action' => 'updateIsCompleted',
                                        $todoItem->id
                                    ]
                                ]);
                                echo $this->Form->checkbox('is_completed');
                                echo $this->Form->end();
                            ?>
                        </td>
                        <td style="text-indent: <?= $todoItem->level ?>em">
                            <?php
                                if ($todoItem->is_completed) {
                                    echo $this->Html->tag('del', h($todoItem->title));
                                } else {
                                    echo h($todoItem->title);
                                }
                            ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'TodoItems', 'action' => 'edit', 'item_id' => $todoItem->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'TodoItems', 'action' => 'delete', $todoItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todoItem->id)]) ?>
                            <?= $this->Form->postLink(__('Up'), ['controller' => 'TodoItems', 'action' => 'move_up', $todoItem->id]) ?>
                            <?= $this->Form->postLink(__('Down'), ['controller' => 'TodoItems', 'action' => 'move_down', $todoItem->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
                            -->
            <?php endif; ?>
        </div>
    </div>
</div>
