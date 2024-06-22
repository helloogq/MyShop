<?php
namespace App\Models;


class AreaList {
    private $areas = [];

    public function __construct($areas) {
        $this->areas = $areas;
    }

    public function getAreaTree($areaId) {
        $area_tree = [];
        foreach ($this->areas as $area) {
            if ($area['parent_id'] == $areaId) {
                $children = $this->getAreaTree($area['id']);
                if (!empty($children)) {
                    $area['children'] = $children;
                }
                $area_tree[] = $area;
            }
        }
        return $area_tree;
    }
}
