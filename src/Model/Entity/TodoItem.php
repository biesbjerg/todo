<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TodoItem Entity
 *
 * @property int $id
 * @property int $todo_list_id
 * @property string|null $title
 * @property string|null $notes
 * @property bool $is_completed
 * @property \Cake\I18n\FrozenDate|null $due_date
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\TodoList $todo_list
 * @property \App\Model\Entity\ParentTodoItem $parent_todo_item
 * @property \App\Model\Entity\ChildTodoItem[] $child_todo_items
 */
class TodoItem extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'todo_list_id' => true,
        'title' => true,
        'notes' => true,
        'is_completed' => true,
        'due_date' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'created' => true,
        'modified' => true,
        'todo_list' => true,
        'parent_todo_item' => true,
        'child_todo_items' => true,
    ];
}
