<?php namespace Opiy\Company\Controllers;

use BackendMenu;
use Flash;
use Opiy\Company\Models\PropertyValue;
use Lang;

/**
 * PropertyValues Back-end Controller
 */
class PropertyValues extends Controller
{

    public $requiredPermissions = ['opiy.company.access_propertyvalues'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Opiy.Company', 'company', 'propertyvalues');
    }

    /**
     * Deleted checked propertyvalues.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $propertyvalueId) {
                if (!$propertyvalue = PropertyValue::find($propertyvalueId)) {
                    continue;
                }

                $propertyvalue->delete();
            }

            Flash::success(Lang::get('opiy.company::lang.propertyvalues.delete_selected_success'));
        } else {
            Flash::error(Lang::get('opiy.company::lang.propertyvalues.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
