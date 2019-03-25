<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mesa Entity
 *
 * @property int $id
 * @property string|null $nombre_mesa
 * @property string|null $fiscal
 * @property string|null $contacto
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $delete
 * @property int|null $establecimiento_id
 *
 * @property \App\Model\Entity\Candidato[] $candidatos
 */
class Mesa extends Entity
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
        'nombre_mesa' => true,
        'fiscal' => true,
        'contacto' => true,
        'created' => true,
        'modified' => true,
        'delete' => true,
        'total_votantes' => true,
        'parcial_votantes' => true,
        'total_impugnados' => true,
        'total_escrutados' => true,
        'establecimiento_id' => true
    ];
    protected $_hidden = ['created','delete','modified'];
}
