<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * TodoLists cell
 */
class TodoListsCell extends Cell
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
    public function display($activeListId = null): void
    {
        $this->loadModel('TodoLists');
        $todoLists = $this->TodoLists
            ->find()
            ->select(['id', 'slug', 'title', 'color', 'incomplete_item_count'])
            ->order(['created' => 'ASC']);

        $this->set(compact('todoLists', 'activeListId'));
    }
}
