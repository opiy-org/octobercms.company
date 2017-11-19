<?php namespace Opiy\Company\Components;

use Illuminate\Support\Facades\Lang;
use Opiy\Company\Models\PropertyValue;
use Opiy\Company\Models\Tag;

class PropertyValues extends Component
{

    public $table = 'opiy_company_properties_values';

    public function componentDetails()
    {
        return [
            'property' => 'opiy.company::lang.components.propertyvalues.property',
            'value' => 'opiy.company::lang.components.propertyvalues.value',
        ];
    }

    public function onRun()
    {
        $this->page['propertyvalue'] = $this->propertyvalue();
        $this->page['propertyvalues'] = $this->propertyvalues();
    }

    public function propertyvalue()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Propertyvalue::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('property', 'project', 'picture', 'pictures', 'files')
                ->first();
        }
    }

    public function propertyvalues()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;

            $propertyvalues = Propertyvalue::published()->with('property', 'project', 'picture', 'pictures', 'files');


            $propertyvalues = $propertyvalues->orderBy(
                $this->property('orderBy', 'id'),
                $this->property('sort', 'desc'))->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $propertyvalues->paginate($this->property('perPage'), $this->property('page')) :
                $propertyvalues->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();

        return $properties;
    }

}
