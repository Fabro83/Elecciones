<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Funciones Model
 *
 * @method \App\Model\Entity\Funcione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Funcione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Funcione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Funcione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Funcione|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Funcione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Funcione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Funcione findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FuncionesTable extends Table
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

        $this->setTable('funciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('Candidatos', [
            'foreignKey' => 'funcion_id'
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
            ->scalar('nombre')
            ->maxLength('nombre', 200)
            ->allowEmptyString('nombre');

        $validator
            ->boolean('delete')
            ->allowEmptyString('delete');

        return $validator;
    }
}
