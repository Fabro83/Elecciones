<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Partido Entity
 *
 * @property int $id
 * @property string|null $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool|null $delete
 *
 * @property \App\Model\Entity\Candidato[] $candidatos
 */
class Partido extends Entity
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
        'name' => true,
        'created' => true,
        'modified' => true,
        'delete' => true,
        'candidatos' => true
    ];
    protected $_hidden = ['created','delete','modified'];
}
