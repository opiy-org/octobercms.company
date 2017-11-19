<?php namespace Opiy\Company\Models;

/**
 * Property Model
 */
class Property extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'opiy_company_properties';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
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
