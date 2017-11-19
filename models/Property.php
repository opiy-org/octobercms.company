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
    public $belongsTo = [];
    public $belongsToMany = [
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
    ];
    public $attachMany = [
    ];


}
