<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * SmartTodoLists cell
 */
class SmartTodoListsCell extends Cell
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
                'id' => 'my-day',
                'title' => __('My Day'),
                'incomplete_item_count' => $this->TodoItems->find('myDay')->count()
            ],
            [
                'id' => 'planned',
                'title' => __('Planned'),
                'incomplete_item_count' => $this->TodoItems->find('planned')->count()
            ]
        ];

        $this->set(compact('todoLists', 'activeListId'));
    }
}
