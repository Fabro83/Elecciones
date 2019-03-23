<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidatos Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Funcions
 * @property |\Cake\ORM\Association\BelongsTo $Partidos
 * @property \App\Model\Table\MesasTable|\Cake\ORM\Association\BelongsToMany $Mesas
 *
 * @method \App\Model\Entity\Candidato get($primaryKey, $options = [])
 * @method \App\Model\Entity\Candidato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Candidato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Candidato|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidato|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Candidato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Candidato findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CandidatosTable extends Table
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

        $this->setTable('candidatos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id','funcion_id','partido_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Funciones', [
            'foreignKey' => 'funcion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Partidos', [
            'foreignKey' => 'partido_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Mesas', [
            'foreignKey' => 'candidato_id',
            'targetForeignKey' => 'mesa_id',
            'joinTable' => 'mesas_candidatos'
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
            ->scalar('Nombre')
            ->maxLength('Nombre', 200)
            ->allowEmptyString('Nombre');


        $validator
            ->scalar('url')
            ->allowEmptyString('url');
        
        $validator
            ->scalar('funcion_id')
            ->notEmpty('funcion_id');
        
        $validator
            ->scalar('partido_id')
            ->notEmpty('partido_id');

        return $validator;
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
        $rules->add($rules->existsIn(['funcion_id'], 'Funciones'));
        $rules->add($rules->existsIn(['partido_id'], 'Partidos'));

        return $rules;
    }
}
