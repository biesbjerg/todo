<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TodoItems Controller
 *
 * @property \App\Model\Table\TodoItemsTable $TodoItems
 * @method \App\Model\Entity\TodoItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TodoItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TodoLists', 'ParentTodoItems'],
        ];
        $todoItems = $this->paginate($this->TodoItems);

        $this->set(compact('todoItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Todo Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $todoItem = $this->TodoItems->get($id, [
            'contain' => ['TodoLists', 'ParentTodoItems', 'ChildTodoItems'],
        ]);

        $this->set(compact('todoItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $todoItem = $this->TodoItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $todoItem = $this->TodoItems->patchEntity($todoItem, $this->request->getData());
            if ($this->TodoItems->save($todoItem)) {
                $this->Flash->success(__('The todo item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo item could not be saved. Please, try again.'));
        }
        $todoLists = $this->TodoItems->TodoLists->find('list', ['limit' => 200]);
        $parentTodoItems = $this->TodoItems->ParentTodoItems->find('list', ['limit' => 200]);
        $this->set(compact('todoItem', 'todoLists', 'parentTodoItems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Todo Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $todoItem = $this->TodoItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todoItem = $this->TodoItems->patchEntity($todoItem, $this->request->getData());
            if ($this->TodoItems->save($todoItem)) {
                $this->Flash->success(__('The todo item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo item could not be saved. Please, try again.'));
        }
        $parentTodoItems = $this->TodoItems->ParentTodoItems->find('list', ['limit' => 200]);
        $this->set(compact('todoItem', 'parentTodoItems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Todo Item id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $todoItem = $this->TodoItems->get($id);
        if ($this->TodoItems->delete($todoItem)) {
            $this->Flash->success(__('The todo item has been deleted.'));
        } else {
            $this->Flash->error(__('The todo item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
