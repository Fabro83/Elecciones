<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Establecimientos Model
 *
 * @property \App\Model\Table\MesasTable|\Cake\ORM\Association\HasMany $Mesas
 *
 * @method \App\Model\Entity\Establecimiento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Establecimiento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Establecimiento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Establecimiento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Establecimiento|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Establecimiento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Establecimiento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Establecimiento findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EstablecimientosTable extends Table
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

        $this->setTable('establecimientos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Mesas', [
            'foreignKey' => 'establecimiento_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nombre_establecimiento')
            ->maxLength('nombre_establecimiento', 100)
            ->allowEmptyString('nombre_establecimiento');

        $validator
            ->scalar('fiscal')
            ->maxLength('fiscal', 200)
            ->allowEmptyString('fiscal');

        $validator
            ->scalar('contacto')
            ->maxLength('contacto', 200)
            ->allowEmptyString('contacto');

        $validator
            ->boolean('delete')
            ->requirePresence('delete', 'create')
            ->allowEmptyString('delete', false);

        return $validator;
    }
}
