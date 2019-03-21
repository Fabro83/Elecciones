<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MesasCandidato Entity
 *
 * @property int $id
 * @property int $candidato_id
 * @property int $mesa_id
 * @property int $votos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenDate $modified
 * @property bool $delete
 *
 * @property \App\Model\Entity\Candidato $candidato
 * @property \App\Model\Entity\Mesa $mesa
 */
class MesasCandidato extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'candidato_id' => true,
        'mesa_id' => true,
        'votos' => true,
        'created' => true,
        'modified' => true,
        'delete' => true,
        'candidato' => true,
        'mesa' => true
    ];
    protected $_hidden = ['created','delete','modified'];
}
