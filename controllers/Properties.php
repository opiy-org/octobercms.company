<?php namespace Opiy\Company\Controllers;

use BackendMenu;
use Flash;
use Opiy\Company\Models\Property;
use Lang;

/**
 * Properties Back-end Controller
 */
class Properties extends Controller
{

    public $requiredPermissions = ['opiy.company.access_properties'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Opiy.Company', 'company', 'properties');
    }

    /**
     * Deleted checked properties.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $propertyId) {
                if (!$property = Property::find($propertyId)) {
                    continue;
                }

                $property->delete();
            }

            Flash::success(Lang::get('opiy.company::lang.properties.delete_selected_success'));
        } else {
            Flash::error(Lang::get('opiy.company::lang.properties.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
