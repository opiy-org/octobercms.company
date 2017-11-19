<?php namespace Opiy\Company\Controllers;

use BackendMenu;
use Flash;
use Opiy\Company\Models\Service;
use Lang;

/**
 * Services Back-end Controller
 */
class Services extends Controller
{

    public $requiredPermissions = ['opiy.company.access_services'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Opiy.Company', 'company', 'services');
    }

    /**
     * Deleted checked services.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $serviceId) {
                if (!$service = Service::find($serviceId)) {
                    continue;
                }

                $service->delete();
            }

            Flash::success(Lang::get('opiy.company::lang.services.delete_selected_success'));
        } else {
            Flash::error(Lang::get('opiy.company::lang.services.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
