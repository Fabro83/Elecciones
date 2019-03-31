<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MesasCandidatostwo Model
 *
 * @property \App\Model\Table\CandidatosTable|\Cake\ORM\Association\BelongsTo $Candidatos
 * @property \App\Model\Table\MesasTable|\Cake\ORM\Association\BelongsTo $Mesas
 *
 * @method \App\Model\Entity\MesasCandidatostwo get($primaryKey, $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MesasCandidatostwo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MesasCandidatostwoTable extends Table
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

        $this->setTable('mesas_candidatostwo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Candidatostwo', [
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
        $rules->add($rules->existsIn(['candidato_id'], 'Candidatostwo'));
        $rules->add($rules->existsIn(['mesa_id'], 'Mesas'));
        $rules->add($rules->isUnique(['candidato_id','mesa_id']));

        return $rules;
    }
    public function findPersonalData(Query $query, array $options)
    {
        $funcion_id = $options['funcion_id'];
        return $query->select(['MesasCandidatostwo.id','MesasCandidatostwo.candidato_id','MesasCandidatostwo.mesa_id','MesasCandidatostwo.votos'])
                     ->contain(['Mesas'=>['fields'=>['Mesas.id','Mesas.nombre_mesa']]])
                     ->contain(['Candidatos'=>function($q) use ($funcion_id)
                     {
                        return $q->where(['funcion_id'=>$funcion_id])
                                 ->order(['partido_id ASC']);
                     }])->toArray();
    }
}
