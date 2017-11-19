<?php namespace Opiy\Company\Models;

/**
 * PropertyValue Model
 */
class PropertyValue extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'opiy_company_properties_values';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'property' => [
            'Opiy\Company\Models\Property',
            'table' => 'opiy_company_pivots',
        ],
        'project' => [
            'Opiy\Company\Models\Project',
            'table' => 'opiy_company_pivots',
        ],
    ];
    public $belongsToMany = [

    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
        'files' => ['System\Models\File'],
    ];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->projects()->detach();
    }

}
