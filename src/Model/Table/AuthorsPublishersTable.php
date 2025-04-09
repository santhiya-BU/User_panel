<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class AuthorsPublishersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('authors_publishers');
        $this->belongsTo('Authors');
        $this->belongsTo('Publishers');
    }
}
