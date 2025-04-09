<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Table\RulesChecker;

class AuthorsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('authors');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');
        
        $this->hasMany('Books', [
            'foreignKey' => 'author_id',
        ]);
        $this->belongsToMany('Publishers', [
            'joinTable' => 'authors_publishers',
            'foreignKey' => 'author_id',
            'targetForeignKey' => 'publisher_id',
            'through' => 'AuthorsPublishers'
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
            ->scalar('bio')
            ->allowEmptyString('bio');

        return $validator;
    }
}
