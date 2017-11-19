<?php namespace Opiy\Company\Components;

use Opiy\Company\Models\Employee;
use Illuminate\Support\Facades\Lang;
use Opiy\Company\Models\Role;

class Employees extends Component
{
    public $table = 'opiy_company_employees';

    public function componentDetails()
    {
        return [
            'name' => 'opiy.company::lang.components.employees.name',
            'description' => 'opiy.company::lang.components.employees.description',
        ];
    }

    public function onRun()
    {
        $this->page['employee'] = $this->employee();
        $this->page['employees'] = $this->employees();
    }

    public function employee()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Employee::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture')
                ->first();
        }
    }

    public function employees()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;

            $employees = Employee::published()->with('picture');

            if ($this->property('filterRole')) {
                $id_attribute = $this->property('roleIdentifier', 'id');
                $employees->whereHas('roles', function ($query) use ($id_attribute) {
                    $query->where($id_attribute, '=', $this->property('filterRole'));
                })->with('roles');
            }

            $employees = $employees->orderBy(
                $this->property('orderBy', 'id'),
                $this->property('sort', 'desc'))->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $employees->paginate($this->property('perPage'), $this->property('page')) :
                $employees->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();
        $properties['roleIdentifier'] = [
            'title' => 'opiy.company::lang.roles.role_identifier',
            'description' => 'opiy.company::lang.descriptions.role_identifier',
            'type' => 'dropdown',
            'options' => ['id' => 'id', 'slug' => 'slug'],
            'default' => 'id',
            'group' => 'opiy.company::lang.labels.filters',
        ];
        $properties['filterRole'] = [
            'title' => 'opiy.company::lang.roles.menu_label',
            'description' => 'opiy.company::lang.descriptions.filter_roles',
            'type' => 'dropdown',
            'group' => 'opiy.company::lang.labels.filters',
        ];
        return $properties;
    }

    public function getFilterRoleOptions()
    {
        $options = [Lang::get('opiy.company::lang.labels.show_all')];
        $roles = Role::has('employees')->get();
        $id_attribute = $this->property('roleIdentifier', 'id');
        $options += $roles->lists('name', $id_attribute);

        return $options;
    }
}
