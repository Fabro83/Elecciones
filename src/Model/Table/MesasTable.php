<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mesas Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Establecimientos
 * @property \App\Model\Table\CandidatosTable|\Cake\ORM\Association\BelongsToMany $Candidatos
 *
 * @method \App\Model\Entity\Mesa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mesa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mesa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mesa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mesa|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mesa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mesa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mesa findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MesasTable extends Table
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

        $this->setTable('mesas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Establecimientos', [
            'foreignKey' => 'establecimiento_id'
        ]);
        $this->belongsToMany('Candidatos', [
            'foreignKey' => 'mesa_id',
            'targetForeignKey' => 'candidato_id',
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
            ->scalar('nombre_mesa')
            ->maxLength('nombre_mesa', 9)
            ->allowEmptyString('nombre_mesa');

        $validator
            ->scalar('fiscal')
            ->maxLength('fiscal', 200)
            ->allowEmptyString('fiscal');

        $validator
            ->scalar('contacto')
            ->maxLength('contacto', 200)
            ->allowEmptyString('contacto');

        

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
        $rules->add($rules->existsIn(['establecimiento_id'], 'Establecimientos'));

        return $rules;
    }
}
