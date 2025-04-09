<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Table\RulesChecker;

class PublishersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('publishers');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');
        
        $this->belongsToMany('Authors', [
            'joinTable' => 'authors_publishers',
            'foreignKey' => 'publisher_id',
            'targetForeignKey' => 'author_id',
            'through' => 'AuthorsPublishers'
        ]);
        $this->hasMany('Books', [
            'foreignKey' => 'publisher_id',
        ]);
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmptyString('phone');

        return $validator;
    }
}
