<?php
/**
 * Created by PhpStorm.
 * User: vereshchagina
 * Date: 13.04.18
 * Time: 11:55
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class CategoryListObject extends BaseObject
{

    /**
     * @var CategoryObject[]
     */
    public $categories;

    public $root;

    protected function fromXml($data)
    {
        foreach ($data->row as $categoryData) {
            $category                                = new CategoryObject($categoryData);
            $this->categories[$category->categoryid] = $category;
        }
        $this->getHierarchy();
    }

    public function getHierarchy()
    {
        foreach ($this->categories as $categoryId => $category) {
            $parentId = $category->parentcategoryid;

            if ($parentId) {
                $this->categories[$parentId]->childrens[] = $category;
            }
            else{
                $this->root[] = $category;
            }
        }
    }

    /**
     * @param $selectedCategoryId
     *
     * @return CategoryObject|null
     */
    public function setSelected($selectedCategoryId)
    {
        if (isset($this->categories[$selectedCategoryId])){
            $this->categories[$selectedCategoryId]->selected = true;
            return $this->categories[$selectedCategoryId];
        }
        return null;
    }
}