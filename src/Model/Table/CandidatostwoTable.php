<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidatostwo Model
 *
 * @property \App\Model\Table\FuncionsTable|\Cake\ORM\Association\BelongsTo $Funcions
 * @property \App\Model\Table\PartidosTable|\Cake\ORM\Association\BelongsTo $Partidos
 *
 * @method \App\Model\Entity\Candidatostwo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Candidatostwo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Candidatostwo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Candidatostwo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidatostwo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidatostwo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Candidatostwo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Candidatostwo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CandidatostwoTable extends Table
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

        $this->setTable('candidatostwo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Funcions', [
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
            'joinTable' => 'mesas_candidatostwo'
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
            ->requirePresence('Nombre', 'create')
            ->allowEmptyString('Nombre', false);

        $validator
            ->boolean('delete')
            ->allowEmptyString('delete');

        $validator
            ->scalar('url')
            ->allowEmptyString('url');

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
        $rules->add($rules->existsIn(['funcion_id'], 'Funcions'));
        $rules->add($rules->existsIn(['partido_id'], 'Partidos'));

        return $rules;
    }
    public function findPersonalData(Query $query, array $options)
    {
        $funcion_id = $options['funcion_id'];
        return $query->where(['funcion_id'=>$funcion_id])
                    ->select(['Candidatostwo.id','Candidatostwo.Nombre','Candidatostwo.url','Candidatostwo.funcion_id','Candidatostwo.partido_id'])
                     ->contain(['Mesas'=>function($q) use ($funcion_id)
                     {
                        return $q->select(['Mesas.id','Mesas.nombre_mesa','MesasCandidatostwo.votos']);
                     }])
                     ->contain(['Partidos' => function($q) {
                        return $q->select(['Partidos.id','Partidos.color_id'])
                        ->contain(['Colors'=>function($q){
                           return $q->select(['Colors.id','Colors.html'])->where(['Colors.delete'=>0]);
                        }]);
                    }])
                     ->toArray();
    }
    public function findPersonalMesaData(Query $query, array $options)
    {
        $funcion_id = $options['funcion_id'];
        $mesa_id = $options['mesa_id'];
        return $query->where(['funcion_id'=>$funcion_id])
                    ->select(['Candidatostwo.id','Candidatostwo.Nombre','Candidatostwo.funcion_id','Candidatostwo.partido_id'])
                     ->contain(['Mesas'=>function($q) use ($mesa_id)
                     {
                        return $q->select(['MesasCandidatostwo.votos','MesasCandidatostwo.mesa_id','MesasCandidatostwo.candidato_id'])
                                ->where(['MesasCandidatostwo.mesa_id'=>$mesa_id]);
                     }])
                     ->contain(['Partidos' => function($q) {
                        return $q->select(['Partidos.id','Partidos.color_id'])
                        ->contain(['Colors'=>function($q){
                           return $q->select(['Colors.id','Colors.html'])->where(['Colors.delete'=>0]);
                        }]);
                    }])
                     ->toArray();
    }
    public function findPersonalEstablecimientoData(Query $query, array $options)
    {
        $funcion_id = $options['funcion_id'];
        $establecimiento_id = $options['establecimiento_id'];
        return $query->where(['funcion_id'=>$funcion_id])
                    ->select(['Candidatostwo.id','Candidatostwo.Nombre','Candidatostwo.funcion_id','Candidatostwo.partido_id'])
                     ->contain(['Mesas'=>function($q) use ($establecimiento_id)
                     {
                        return $q->select(['MesasCandidatostwo.votos','MesasCandidatostwo.mesa_id','MesasCandidatostwo.candidato_id'])
                                ->where(['Mesas.establecimiento_id'=>$establecimiento_id]);
                     }])
                     ->contain(['Partidos' => function($q) {
                        return $q->select(['Partidos.id','Partidos.color_id'])
                        ->contain(['Colors'=>function($q){
                           return $q->select(['Colors.id','Colors.html'])->where(['Colors.delete'=>0]);
                        }]);
                    }])
                     ->toArray();
    }
}
