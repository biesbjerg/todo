<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TodoList[]|\Cake\Collection\CollectionInterface $todoLists
 */
?>
<ul class="nav flex-column nav-pills">
    <?php foreach ($todoLists as $todoList) :?>

    <li class="nav-item">
        <?php
            $badge = $this->Html->tag('span', '&nbsp;', [
                'class' => 'badge',
                'style' => sprintf('background-color: %s', $todoList->color)
            ]);
            $itemCountBadge = $this->Html->tag('span', $todoList->incomplete_item_count, [
                'class' => ['badge', 'badge-pill']
            ]);
            $title = sprintf('%s %s', $todoList->title, $itemCountBadge);

            echo $this->Html->link($title, [
                '_name' => 'view_todo_items',
                'list_id' => $todoList->id,
                'slug' => $todoList->slug
            ], [
                'class' => [
                    'nav-link',
                    'rounded-0',
                    $todoList->id == $activeListId ? 'active' : ''
                ],
                'escape' => false
            ]);
        ?>
    </li>

    <?php endforeach ?>
</ul>
