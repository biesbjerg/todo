<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Routing\Router;

/**
 * TodoLists Controller
 *
 * @property \App\Model\Table\TodoListsTable $TodoLists
 * @method \App\Model\Entity\TodoList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TodoListsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $hasTodoLists = (bool) $this->TodoLists->find()->count();

        $this->set(compact('hasTodoLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Todo List id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $slug = null)
    {
        $todoList = $this->TodoLists->get($id, [
            'contain' => [
                'TodoItems' => [
                    'sort' => ['lft' => 'ASC']
                ]
            ]
        ]);

        // Check todo list is valid and being accessed via current slug
        if ($todoList->slug !== $slug) {
            return $this->redirect([
                '_name' => 'view_todo_items',
                'list_id' => $todoList->id,
                'slug' => $todoList->slug
            ]);
        }

        $this->set(compact('todoList'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $todoList = $this->TodoLists->newEmptyEntity();
        if ($this->request->is('post')) {
            $todoList = $this->TodoLists->patchEntity($todoList, $this->request->getData());
            if ($this->TodoLists->save($todoList)) {
                $this->Flash->success(__('The todo list has been saved.'));

                return $this->redirect([
                    '_name' => 'view_todo_items',
                    'list_id' => $todoList->id,
                    'slug' => $todoList->slug
                ]);
            }
            $this->Flash->error(__('The todo list could not be saved. Please, try again.'));
        }
        $this->set(compact('todoList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Todo List id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $todoList = $this->TodoLists->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todoList = $this->TodoLists->patchEntity($todoList, $this->request->getData());
            if ($this->TodoLists->save($todoList)) {
                $this->Flash->success(__('The todo list has been saved.'));

                return $this->redirect([
                    '_name' => 'view_todo_items',
                    'list_id' => $todoList->id,
                    'slug' => $todoList->slug
                ]);
            }
            $this->Flash->error(__('The todo list could not be saved. Please, try again.'));
        }
        $this->set(compact('todoList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Todo List id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $todoList = $this->TodoLists->get($id);
        if ($this->TodoLists->delete($todoList)) {
            $this->Flash->success(__('The todo list has been deleted.'));
        } else {
            $this->Flash->error(__('The todo list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['_name' => 'home']);
    }
}
