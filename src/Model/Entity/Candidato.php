<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidato Entity
 *
 * @property int $id
 * @property string|null $Nombre
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $delete
 *
 * @property \App\Model\Entity\Mesa[] $mesas
 */
class Candidato extends Entity
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
        'Nombre' => true,
        'created' => true,
        'modified' => true,
        'delete' => true,
        'mesas' => true
    ];
}
