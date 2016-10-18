<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BooksWriters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Books
 * @property \Cake\ORM\Association\BelongsTo $Writers
 *
 * @method \App\Model\Entity\BooksWriter get($primaryKey, $options = [])
 * @method \App\Model\Entity\BooksWriter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BooksWriter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BooksWriter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BooksWriter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BooksWriter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BooksWriter findOrCreate($search, callable $callback = null)
 */
class BooksWritersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('books_writers');
        $this->displayField('book_id');
        $this->primaryKey(['book_id', 'writer_id']);

        $this->belongsTo('Books', [
            'foreignKey' => 'book_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Writers', [
            'foreignKey' => 'writer_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['book_id'], 'Books'));
        $rules->add($rules->existsIn(['writer_id'], 'Writers'));

        return $rules;
    }
}
