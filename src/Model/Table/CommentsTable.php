<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;


class CommentsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('comments');
        $this->setPrimaryKey('id');
        $this->setDisplayField('body');

        $this->belongsTo('Books', [
            'foreignKey' => 'book_id'
        ]);
    }


    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');
        

        return $validator;
    }
}