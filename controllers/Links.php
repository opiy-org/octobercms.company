<?php namespace Opiy\Company\Controllers;

use BackendMenu;
use Flash;
use Lang;
use Opiy\Company\Models\Link;

/**
 * Links Back-end Controller
 */
class Links extends Controller
{

    public $requiredPermissions = ['opiy.company.access_links'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Opiy.Company', 'company', 'links');
    }

    /**
     * Deleted checked links.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $linkId) {
                if (!$link = Link::find($linkId)) continue;
                $link->delete();
            }

            Flash::success(Lang::get('opiy.company::lang.links.delete_selected_success'));
        } else {
            Flash::error(Lang::get('opiy.company::lang.links.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
