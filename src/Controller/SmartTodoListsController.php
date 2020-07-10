<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * SmartTodoLists Controller
 *
 * @method \App\Model\Entity\SmartTodoList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SmartTodoListsController extends AppController
{
    /**
     * View method
     *
     * @param string|null $id Smart Todo List id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lists = [
            'my-day' => [
                'title' => __('My Day'),
                'notes' => __('This is a list of items that you have added to "My Day".'),
                'finder' => 'myDay'
            ],
            'planned' => [
                'title' => __('Planned'),
                'notes' => __('This is a list of items with a due date.'),
                'finder' => 'planned'
            ]
        ];
        if (!isset($lists[$id])) {
            throw new RecordNotFoundException();
        }

        extract($lists[$id]);

        $this->loadModel('TodoItems');
        $todoItems = $this->TodoItems->find($finder);

        $this->set(compact('title', 'notes', 'todoItems'));
    }
}
