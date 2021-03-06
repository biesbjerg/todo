<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Behavior\CounterCacheBehavior;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TodoItems Model
 *
 * @property \App\Model\Table\TodoListsTable&\Cake\ORM\Association\BelongsTo $TodoLists
 * @property \App\Model\Table\TodoItemsTable&\Cake\ORM\Association\BelongsTo $ParentTodoItems
 * @property \App\Model\Table\TodoItemsTable&\Cake\ORM\Association\HasMany $ChildTodoItems
 * @method \App\Model\Entity\TodoItem newEmptyEntity()
 * @method \App\Model\Entity\TodoItem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TodoItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TodoItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\TodoItem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TodoItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TodoItem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TodoItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TodoItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TodoItem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TodoItem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TodoItem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TodoItem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class TodoItemsTable extends Table
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

        $this->setTable('todo_items');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree', [
            'level' => 'level'
        ]);
        $this->addBehavior('CounterCache', [
            'TodoLists' => [
                'incomplete_item_count' => [
                    'conditions' => [
                        'TodoItems.is_completed' => false
                    ]
                ]
            ]
        ]);

        $this->belongsTo('TodoLists', [
            'foreignKey' => 'todo_list_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ParentTodoItems', [
            'className' => 'TodoItems',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildTodoItems', [
            'className' => 'TodoItems',
            'foreignKey' => 'parent_id',
        ]);
    }

    /**
     * Scope todo item to specified todo list.
     *
     * @return bool
     */
    public function save(EntityInterface $entity, $options = [])
    {
        $oldScope = $this->getBehavior('Tree')->getConfig('scope');
        if ($entity->has('todo_list_id')) {
            $this->getBehavior('Tree')->setConfig('scope', [
                'todo_list_id' => $entity->todo_list_id
            ]);
        }
        $success = parent::save($entity, $options);
        $this->getBehavior('Tree')->setConfig('scope', $oldScope);

        return $success;
    }

    public function findMyDay(Query $query, array $options): Query
    {
        return $query
            ->where([
                'show_in_my_day' => true,
                'is_completed' => false
            ])
            ->order(['due_date' => 'ASC']);
    }

    public function findPlanned(Query $query, array $options): Query
    {
        return $query
            ->where([
                'due_date IS NOT' => null,
                'is_completed' => false
            ])
            ->order(['due_date' => 'ASC']);
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
            ->notEmptyString('title');

        $validator
            ->scalar('notes')
            ->maxLength('notes', 3000)
            ->allowEmptyString('notes');

        $validator
            ->boolean('is_completed')
            ->notEmptyString('is_completed');

        $validator
            ->boolean('show_in_my_day')
            ->notEmptyString('show_in_my_day');

        $validator
            ->date('due_date')
            ->allowEmptyDate('due_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['todo_list_id'], 'TodoLists'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentTodoItems'));

        return $rules;
    }
}
