<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * DynamicTodoLists cell
 */
class DynamicTodoListsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($activeListId = null)
    {
        $this->loadModel('TodoItems');

        $todoLists = [
            [
                'id' => 'myDay',
                'title' => __('My Day'),
                'url' => 'view_my_day_todo_items',
                'incomplete_item_count' => $this->TodoItems->find('myDay')->count()
            ],
            [
                'id' => 'planned',
                'title' => __('Planned'),
                'url' => 'view_planned_todo_items',
                'incomplete_item_count' => $this->TodoItems->find('planned')->count()
            ]
        ];

        $this->set(compact('todoLists', 'activeListId'));
    }
}
