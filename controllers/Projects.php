<?php namespace Opiy\Company\Controllers;

use BackendMenu;
use Flash;
use Opiy\Company\Models\Project;
use Lang;

/**
 * Projects Back-end Controller
 */
class Projects extends Controller
{

    public $requiredPermissions = ['opiy.company.access_projects'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Opiy.Company', 'company', 'projects');
    }

    /**
     * Deleted checked projects.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $projectId) {
                if (!$project = Project::find($projectId)) {
                    continue;
                }

                $project->delete();
            }

            Flash::success(Lang::get('opiy.company::lang.projects.delete_selected_success'));
        } else {
            Flash::error(Lang::get('opiy.company::lang.projects.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
