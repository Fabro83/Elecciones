<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Funcione Entity
 *
 * @property int $id
 * @property string|null $nombre
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool|null $delete
 */
class Funcione extends Entity
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
        'nombre' => true,
        'created' => true,
        'modified' => true,
        'delete' => true
    ];
    protected $_hidden = ['created','delete','modified'];
}
