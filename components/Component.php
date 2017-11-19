<?php namespace Opiy\Company\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Opiy\Company\Models\Tag;
use Opiy\Company\Models\Role;

class Component extends ComponentBase
{

    public $item;
    public $list;
    public $table;

    public function componentDetails()
    {
    }

    public function defineProperties()
    {
        return [
            'itemId' => [
                'title' => 'opiy.company::lang.labels.item_id',
                'description' => 'opiy.company::lang.descriptions.item_id',
                'default' => '{{ :model }}',
            ],
            'modelIdentifier' => [
                'title' => 'opiy.company::lang.misc.model_identifier',
                'description' => 'opiy.company::lang.descriptions.model_identifier',
                'type' => 'dropdown',
                'options' => ['id' => 'id', 'slug' => 'slug'],
                'default' => 'id',
            ],
            'maxItems' => [
                'title' => 'opiy.company::lang.labels.max_items',
                'description' => 'opiy.company::lang.descriptions.max_items',
                'default' => 36,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy' => [
                'title' => 'opiy.company::lang.labels.order_by',
                'description' => 'opiy.company::lang.descriptions.order_by',
                'type' => 'dropdown',
                'default' => 'id',
                'group' => 'opiy.company::lang.labels.order',
            ],
            'sort' => [
                'title' => 'opiy.company::lang.labels.sort',
                'description' => 'opiy.company::lang.descriptions.sort',
                'type' => 'dropdown',
                'default' => 'desc',
                'group' => 'opiy.company::lang.labels.order',
            ],
            'paginate' => [
                'title' => 'opiy.company::lang.labels.paginate',
                'description' => 'opiy.company::lang.descriptions.paginate',
                'type' => 'checkbox',
                'default' => false,
                'group' => 'opiy.company::lang.labels.paginate',
            ],
            'page' => [
                'title' => 'opiy.company::lang.labels.page',
                'description' => 'opiy.company::lang.descriptions.page',
                'type' => 'string',
                'default' => '1',
                'validationPattern' => '^[0-9]+$',
                'group' => 'opiy.company::lang.labels.paginate',
            ],
            'perPage' => [
                'title' => 'opiy.company::lang.labels.per_page',
                'description' => 'opiy.company::lang.descriptions.per_page',
                'type' => 'string',
                'default' => '12',
                'validationPattern' => '^[0-9]+$',
                'group' => 'opiy.company::lang.labels.paginate',
            ],
        ];
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('opiy.company::lang.labels.descending'),
            'asc' => Lang::get('opiy.company::lang.labels.ascending'),
        ];
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing($this->table);
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}
