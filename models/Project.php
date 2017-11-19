<?php namespace Opiy\Company\Models;

/**
 * Project Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'opiy_company_projects';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'properties' => [
            'Opiy\Company\Models\Property',
            'table' => 'opiy_company_pivots',
        ],
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'services' => [
            'Opiy\Company\Models\Service',
            'table' => 'opiy_company_pivots',
        ],
        'tags' => [
            'Opiy\Company\Models\Tag',
            'table' => 'opiy_company_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
        'extra_pictures' => ['System\Models\File'],
        'files' => ['System\Models\File'],
    ];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->services()->detach();
    }

}
