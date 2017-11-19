<?php namespace Opiy\Company\Components;

use Opiy\Company\Models\Project;
use Illuminate\Support\Facades\Lang;
use Opiy\Company\Models\Tag;

class Projects extends Component
{

    public $table = 'opiy_company_projects';

    public function componentDetails()
    {
        return [
            'name' => 'opiy.company::lang.components.projects.name',
            'description' => 'opiy.company::lang.components.projects.description',
        ];
    }

    public function onRun()
    {
        $this->page['project'] = $this->project();
        $this->page['projects'] = $this->projects();
    }

    public function project()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Project::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture', 'pictures', 'files')
                ->first();
        }
    }

    public function projects()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;

            $projects = Project::published()->with('picture', 'pictures', 'files');

            if ($this->property('filterTag')) {
                $id_attribute = $this->property('tagIdentifier', 'id');
                $projects->whereHas('tags', function ($query) use ($id_attribute) {
                    $query->where($id_attribute, '=', $this->property('filterTag'));
                })->with('tags');
            }

            $projects = $projects->orderBy(
                $this->property('orderBy', 'id'),
                $this->property('sort', 'desc'))->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $projects->paginate($this->property('perPage'), $this->property('page')) :
                $projects->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();
        $properties['tagIdentifier'] = [
            'title' => 'opiy.company::lang.tags.tag_identifier',
            'description' => 'opiy.company::lang.descriptions.tag_identifier',
            'type' => 'dropdown',
            'options' => ['id' => 'id', 'slug' => 'slug'],
            'default' => 'id',
            'group' => 'opiy.company::lang.labels.filters',
        ];
        $properties['filterTag'] = [
            'title' => 'opiy.company::lang.tags.menu_label',
            'description' => 'opiy.company::lang.descriptions.filter_tags',
            'type' => 'dropdown',
            'depends' => ['tagIdentifier'],
            'group' => 'opiy.company::lang.labels.filters',
        ];
        return $properties;
    }

    public function getFilterTagOptions()
    {
        $options = [Lang::get('opiy.company::lang.labels.show_all')];
        $tags = Tag::has('projects')->get();
        $id_attribute = $this->property('tagIdentifier', 'id');
        $options += $tags->lists('name', $id_attribute);

        return $options;
    }
}
