<?php

class ListPage extends Page
{
    
    private static $db = array(
    'ToggleEffect' => 'Boolean',
    'ToggleEffectItems' => 'Boolean',
    'StartToggleClosed' => 'Boolean',
    'AlphabeticalOrder' => 'Boolean',
    'AlphaOrderCategories' => 'Boolean',
    'BottomContent' => 'HTMLText',
    'PhotoMaxWidth' => 'Int'
  );
    
    private static $has_many = array(
    'ListItems' => 'ListItem',
    'ListCategories' => 'ListCategory'
  );

    private static $defaults = array(
    'ToggleEffect' => true,
    'ToggleEffectItems' => true,
    'StartToggleClosed' => true,
    'AlphabeticalOrder' => false,
    'AlphaOrderCategories' => false,
    'PhotoMaxWidth' => '300'
  );
    
    private static $icon = "listpage/images/listpage";
   
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('BottomContent')->setTitle('Content for below the list items'), 'Metadata');
        $fields->addFieldToTab('Root.ListItems', GridField::create(
      'ListItems',
      'List Items',
      $this->ListItems(),
      GridFieldConfig_RecordEditor::create('50')->addComponent($sortableitems = new GridFieldSortableRows('SortID'))
    ));
        $sortableitems->setAppendToTop(true);

        $fields->addFieldToTab('Root.ListCategories', GridField::create(
      'ListCategories',
      'List Categories',
      $this->ListCategories(),
      GridFieldConfig_RecordEditor::create('50')->addComponent($sortablecategories = new GridFieldSortableRows('SortID'))
    ));
        $sortablecategories->setAppendToTop(true);
        $fields->addFieldToTab('Root.Config', HeaderField::create('ListItemsDesc')->setTitle('List Items Options'));
        $fields->addFieldToTab('Root.Config', CheckboxField::create('AlphabeticalOrder')->setTitle('Alphabetical Order for List Items')->setDescription('Show in alphabetical order (By the list item title, overwrites drag and drop order)'));
        $fields->addFieldToTab('Root.Config', CheckboxField::create('ToggleEffectItems')->setTitle('Toggle Effect for List Items')->setDescription('Set toggle effect on list items'));
        $fields->addFieldToTab("Root.Config", SliderField::create("PhotoMaxWidth", "Max Photo Width", 50, 1600)->setDescription('For photo that is associated with list items'));
        $fields->addFieldToTab('Root.Config', HeaderField::create('ListCategoriesDesc')->setTitle('List Categories Options'));
        $fields->addFieldToTab('Root.Config', CheckboxField::create('AlphaOrderCategories')->setTitle('Alphabetical Order for List Categories')->setDescription('Show in alphabetical order (By the list category title, overwrites drag and drop ordering)'));
        $fields->addFieldToTab('Root.Config', CheckboxField::create('ToggleEffect')->setTitle('Toggle Effect for List Cateogries')->setDescription('Set toggle effect on list categories'));
        $fields->addFieldToTab('Root.Config', CheckboxField::create('StartToggleClosed')->setTitle('Start Toggle Closed for List Categories')->setDescription('The toggle for all catogries will start closed, if off the first category toggle will be open'));
        return $fields;
    }
}

class ListPage_Controller extends Page_Controller
{

    public static function load_requirements()
    {
        Requirements::css("listpage/css/listpage.css");
        Requirements::javascript(FRAMEWORK_DIR .'/thirdparty/jquery/jquery.js');
        Requirements::javascript("listpage/js/functionality.listpage.js");
    }

    public function init()
    {
        parent::init();
        self::load_requirements();
    }

    public function ListCategories()
    {
        $listcategoriesfiltered = new ArrayList();
        if ($this->AlphaOrderCategories) {
            $listcategories = $this->getComponents('ListCategories')->sort('Category ASC');
        } else {
            $listcategories = $this->getComponents('ListCategories');
        }
        if ($listcategories) {
            foreach ($listcategories as $listcategory) {
                if ($listcategory->getComponents('ListItems')->count() > 0) {
                    $listcategoriesfiltered->push($listcategory);
                }
            }
        }
        return $listcategoriesfiltered;
    }

    public function UncategorizedListItems()
    {
        $uncategorizedlistitems = new ArrayList();
        if ($this->AlphabeticalOrder) {
            $listitems = $this->getComponents('ListItems')->sort("Title ASC");
        } else {
            $listitems = $this->getComponents('ListItems');
        }
        if ($listitems) {
            foreach ($listitems as $listitem) {
                if ($listitem->Category() == "Other") {
                    $uncategorizedlistitems->push($listitem);
                }
            }
        }
        return $uncategorizedlistitems;
    }

    public function MoreThanOneListCategory()
    {
        if ($this->ListCategories()->count()) {
            return true;
        }
    }

    public function ToggleEffect()
    {
        if ($this->ToggleEffect == true and $this->ListCategories()->count() > 0) {
            return true;
        }
    }
}
