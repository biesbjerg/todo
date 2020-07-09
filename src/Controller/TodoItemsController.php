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
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($listId)
    {
        $todoList = $this->TodoItems->TodoLists->get($listId, [
            'fields' => ['id', 'slug', 'title']
        ]);

        $todoItem = $this->TodoItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $todoItem = $this->TodoItems->patchEntity($todoItem, $this->request->getData());
            if ($this->TodoItems->save($todoItem)) {
                $this->Flash->success(__('The todo item has been saved.'));

                return $this->redirect([
                    '_name' => 'view_todo_items',
                    'list_id' => $todoList->id,
                    'slug' => $todoList->slug
                ]);
            }
            $this->Flash->error(__('The todo item could not be saved. Please, try again.'));
        }
        $parentTodoItems = $this->TodoItems->ParentTodoItems
            ->find('treeList')
            ->where(['todo_list_id' => $todoList->id]);

        $this->set(compact('todoList', 'todoItem', 'parentTodoItems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Todo Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($listId, $id = null)
    {
        $todoList = $this->TodoItems->TodoLists->get($listId, [
            'fields' => ['id', 'slug', 'title']
        ]);

        $todoItem = $this->TodoItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todoItem = $this->TodoItems->patchEntity($todoItem, $this->request->getData());
            if ($this->TodoItems->save($todoItem)) {
                $this->Flash->success(__('The todo item has been saved.'));

                return $this->redirect([
                    '_name' => 'view_todo_items',
                    'list_id' => $todoList->id,
                    'slug' => $todoList->slug
                ]);
            }
            $this->Flash->error(__('The todo item could not be saved. Please, try again.'));
        }
        $parentTodoItems = $this->TodoItems->ParentTodoItems
            ->find('treeList')
            ->where([
                'todo_list_id' => $todoList->id,
                'id !=' => $id
            ]);

        $this->set(compact('todoList', 'todoItem', 'parentTodoItems'));
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
        $todoItem = $this->TodoItems->get($id, [
            'contain' => [
                'TodoLists' => [
                    'fields' => ['id', 'slug']
                ]
            ]
        ]);
        if ($this->TodoItems->delete($todoItem)) {
            $this->Flash->success(__('The todo item has been deleted.'));
        } else {
            $this->Flash->error(__('The todo item could not be deleted. Please, try again.'));
        }

        return $this->redirect([
            '_name' => 'view_todo_items',
            'list_id' => $todoItem->todo_list->id,
            'slug' => $todoItem->todo_list->slug
        ]);
    }

    public function updateIsCompleted($id = null)
    {
        $todoItem = $this->TodoItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todoItem = $this->TodoItems->patchEntity($todoItem, $this->request->getData());
            if ($this->TodoItems->save($todoItem)) {
                if ($todoItem->is_completed) {
                    $this->Flash->success(__('The todo item has been marked as completed.'));
                } else {
                    $this->Flash->success(__('The todo item has been marked as not completed.'));
                }
            } else {
                $this->Flash->error(__('The todo item could not be marked as completed.'));
            }
        }

        return $this->redirect($this->referer());
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post']);
        $todoItem = $this->TodoItems->get($id);
        $this->TodoItems->getBehavior('Tree')->setConfig('scope', [
            'todo_list_id' => $todoItem->todo_list_id
        ]);
        if ($this->TodoItems->moveUp($todoItem)) {
            $this->Flash->success(__('The todo item has been moved up.'));
        } else {
            $this->Flash->error(__('The todo item could not be moved up.'));
        }

        return $this->redirect($this->referer());
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post']);
        $todoItem = $this->TodoItems->get($id);
        $this->TodoItems->getBehavior('Tree')->setConfig('scope', [
            'todo_list_id' => $todoItem->todo_list_id
        ]);
        if ($this->TodoItems->moveDown($todoItem)) {
            $this->Flash->success(__('The todo item has been moved down.'));
        } else {
            $this->Flash->error(__('The todo item could not be moved down.'));
        }

        return $this->redirect($this->referer());
    }
}
