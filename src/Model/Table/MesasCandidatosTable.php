<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MesasCandidatos Model
 *
 * @property \App\Model\Table\CandidatosTable|\Cake\ORM\Association\BelongsTo $Candidatos
 * @property \App\Model\Table\MesasTable|\Cake\ORM\Association\BelongsTo $Mesas
 *
 * @method \App\Model\Entity\MesasCandidato get($primaryKey, $options = [])
 * @method \App\Model\Entity\MesasCandidato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MesasCandidato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MesasCandidato|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MesasCandidato|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MesasCandidato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MesasCandidato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MesasCandidato findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MesasCandidatosTable extends Table
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

        $this->setTable('mesas_candidatos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Candidatos', [
            'foreignKey' => 'candidato_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Mesas', [
            'foreignKey' => 'mesa_id',
            'joinType' => 'INNER'
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
            ->integer('votos')
            ->requirePresence('votos', 'create')
            ->allowEmptyString('votos', false);

        

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
        $rules->add($rules->existsIn(['candidato_id'], 'Candidatos'));
        $rules->add($rules->existsIn(['mesa_id'], 'Mesas'));
        $rules->add($rules->isUnique(['candidato_id','mesa_id']));

        return $rules;
    }
}
