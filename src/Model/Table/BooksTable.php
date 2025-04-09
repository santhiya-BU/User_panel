<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;


class BooksTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('books');
        $this->setPrimaryKey('id');
        $this->setDisplayField('title');
        
        $this->belongsTo('Authors', [
            'foreignKey' => 'author_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Publishers', [
            'foreignKey' => 'publisher_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'book_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
    }


    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');
        
        $validator
            ->numeric('price') // <- Add if needed
            ->notEmptyString('price');

        $validator
            ->integer('publisher_id')
            ->allowEmptyString('publisher_id');

        $validator
            ->integer('author_id')
            ->allowEmptyString('author_id');

        $validator
            ->date('published_date')
            ->allowEmptyDate('published_date');

        return $validator;
    }

 
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('publisher_id', 'Publishers'), ['errorField' => 'publisher_id']);
        $rules->add($rules->existsIn('author_id', 'Authors'), ['errorField' => 'author_id']);

        return $rules;
    }
}
