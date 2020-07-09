<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TodoLists Model
 *
 * @property \App\Model\Table\TodoItemsTable&\Cake\ORM\Association\HasMany $TodoItems
 * @method \App\Model\Entity\TodoList newEmptyEntity()
 * @method \App\Model\Entity\TodoList newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TodoList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TodoList get($primaryKey, $options = [])
 * @method \App\Model\Entity\TodoList findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TodoList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TodoList[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TodoList|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TodoList saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TodoList[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TodoList[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TodoList[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TodoList[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TodoListsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('todo_lists');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Slug.Slug', [
            'onUpdate' => true
        ]);

        $this->hasMany('TodoItems', [
            'foreignKey' => 'todo_list_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('color')
            ->maxLength('color', 7)
            ->allowEmptyString('color');

        return $validator;
    }
}
