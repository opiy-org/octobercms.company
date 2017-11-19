<?php namespace Opiy\Company\Components;

use Illuminate\Support\Facades\Lang;
use Opiy\Company\Models\Property;

class Properties extends Component
{

    public $table = 'opiy_company_properties';

    public function componentDetails()
    {
        return [
            'name' => 'opiy.company::lang.components.properties.name',
            'value' => 'opiy.company::lang.components.properties.value',
        ];
    }

    public function onRun()
    {
        $this->page['property'] = $this->property();
        $this->page['properties'] = $this->properties();
    }

    public function property()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Property::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('project', 'picture', 'pictures', 'files')
                ->first();
        }
    }

    public function properties()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;

            $properties = Property::published()->with('project', 'picture', 'pictures', 'files');

            $properties = $properties->orderBy(
                $this->property('orderBy', 'id'),
                $this->property('sort', 'desc'))->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $properties->paginate($this->property('perPage'), $this->property('page')) :
                $properties->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();
        return $properties;
    }

}
