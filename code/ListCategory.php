<?php

class ListCategory extends DataObject
{
    
    private static $db = array(
        'SortID' => 'Int',
        'Category' => 'Text',
        'Description' => 'HTMLText'
    );
    
    private static $has_one = array(
        'ListPage' => 'ListPage'
    );
    
    private static $has_many = array(
        "ListItems" => "ListItem"
    );

    private static $summary_fields = array(
        'Category' => 'Category',
        'DescriptionExcerpt' => 'Description'
   );

    public function canCreate($Member = null)
    {
        return true;
    }
    public function canEdit($Member = null)
    {
        return true;
    }
    public function canView($Member = null)
    {
        return true;
    }
    public function canDelete($Member = null)
    {
        return true;
    }

    private static $default_sort = 'SortID Asc';
    
    public function getCMSFields()
    {
        return new FieldList(
            TextField::create("Category"),
            HTMLEditorField::create("Description")
        );
    }

    public function DescriptionExcerpt($length = 300)
    {
        $text = strip_tags($this->Description);
        $length = abs((int)$length);
        if (strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return $text;
    }

    public function getTitle()
    {
        return $this->Category;
    }

    public function ListItems()
    {
        if ($this->getComponent('ListPage')->AlphabeticalOrder) {
            return $this->getComponents('ListItems')->sort('Title ASC')->filter('ListPageID', $this->getComponent('ListPage')->ID);
        } else {
            return $this->getComponents('ListItems')->filter('ListPageID', $this->getComponent('ListPage')->ID);
        }
    }
}
