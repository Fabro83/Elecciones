<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Establecimiento Entity
 *
 * @property int $id
 * @property string|null $nombre_establecimiento
 * @property string|null $fiscal
 * @property string|null $contacto
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $delete
 *
 * @property \App\Model\Entity\Mesa[] $mesas
 */
class Establecimiento extends Entity
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
        'nombre_establecimiento' => true,
        'fiscal' => true,
        'contacto' => true,
        'created' => true,
        'modified' => true,
        'delete' => true,
        'mesas' => true
    ];
    protected $_hidden = ['created','delete','modified'];
}
