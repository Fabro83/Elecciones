<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidatostwo Entity
 *
 * @property int $id
 * @property string $Nombre
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool|null $delete
 * @property string|null $url
 * @property int $funcion_id
 * @property int $partido_id
 *
 * @property \App\Model\Entity\Funcion $funcion
 * @property \App\Model\Entity\Partido $partido
 */
class Candidatostwo extends Entity
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
        'url' => true,
        'funcion_id' => true,
        'partido_id' => true,
        'funcion' => true,
        'partido' => true
    ];
}
