<?php

class ListItem extends DataObject
{
  
    private static $db = array(
    'SortID' => 'Int',
    'Title' => 'Text',
    'Content' => 'HTMLText',
    'LinkType' => "Enum('Link, Resource', 'Link')",
    'Link' => 'Text'
  );
  
    private static $has_one = array(
    'ListPage' => 'ListPage',
    'ListCategory' => 'ListCategory',
    'Photo' => 'Image',
    'Resource' => 'File'
  );

    private static $summary_fields = array(
    'Thumbnail' => 'Photo',
    'Title' => 'Title',
    'Link' => 'Link',
    'ContentExcerpt' => 'Content',
    'Category' => 'Category'
  );

    private static $defaults = array(
    'LinkType' => 'Link'
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
        if ($this->ID == 0) {
            $categorydropdown = TextField::create('CategoryDisclaimer')->setTitle('Category')->setDisabled(true)->setValue('You can assign a category once you have saved the record for the first time.');
        } else {
            $categories = ListCategory::get()->filter("ListPageID", "$this->ListPageID")->sort("Category ASC");
            $map = $categories ? $categories->map('ID', 'Category', 'Please Select') : array();
            if ($map) {
                $categorydropdown = new DropdownField('ListCategoryID', 'Category', $map);
                $categorydropdown->setEmptyString("-- Please Select --");
            } else {
                $categorydropdown = new DropdownField('ListCategoryID', 'Category', $map);
                $categorydropdown->setEmptyString("There are no categories created yet");
            }
        }
        $ImageField = UploadField::create('Photo')->setDescription('(Allowed filetypes: jpg, jpeg, png, gif)');
        $ImageField->folderName = 'ListPage';
        $ImageField->getValidator()->allowedExtensions = array('jpg','jpeg','gif','png');
        $DocumentField = UploadField::create('Resource')->setTitle('Resource/Document')->setDescription('(Allowed filetypes: pdf, doc, docx, txt, ppt, or pptx)');
        $DocumentField->folderName = "ListPage";
        $DocumentField->getValidator()->allowedExtensions = array('pdf','doc','docx','txt','ppt','pptx');
        $LinkField = TextField::create('Link')->setTitle('Link URL');
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', array(
      $categorydropdown,
      TextField::create('Title'),
      OptionSetField::create('LinkType')->setTitle('')->setSource($this->dbObject('LinkType')->enumValues()),
      TextField::create('Link')->setTitle('Link URL')->displayIf('LinkType')->isEqualTo('Link')->andIf('LinkType')->isNotEqualTo('Resource')->end(),
      DisplayLogicWrapper::create($DocumentField)->displayIf('LinkType')->isEqualTo('Resource')->andIf('LinkType')->isNotEqualTo('Link')->end(),
      $ImageField,
     HTMLEditorField::create('Content')
    ));
        return $fields;
    }

    public function Category()
    {
        $category = $this->ListCategory()->Category;
        if ($category != null) {
            return $category;
        } else {
            return "Other";
        }
    }

    public function Thumbnail()
    {
        $Image = $this->Photo();
        if ($Image) {
            return $Image->CMSThumbnail();
        } else {
            return null;
        }
    }
  
    public function ContentExcerpt($length = 100)
    {
        $text = strip_tags($this->Content);
        $length = abs((int)$length);
        if (strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return $text;
    }

    public function PhotoSized()
    {
        if ($this->Photo()->exists()) {
            $PhotoWidth = $this->Photo()->getWidth;
            if ($this->getComponent('ListPage')->PhotoMaxWidth) {
                $MaxPhotoWidth = $this->getComponent('ListPage')->PhotoMaxWidth;
            } else {
                $MaxPhotoWidth = 200;
            }
            if ($PhotoWidth > $MaxPhotoWidth) {
                return $this->Photo();
            } else {
                return $this->Photo()->setWidth($MaxPhotoWidth);
            }
        }
    }

    public function Link()
    {
        if ($this->Link) {
            return $this->Link;
        } elseif ($this->getComponent('Resource')->exists()) {
            return $this->getComponent('Resource')->URL;
        } else {
            return false;
        }
    }

    public function LinkExists()
    {
        if ($this->Link || $this->getComponent('Resource')->exists()) {
            return true;
        }
    }

    public function ToggleEffectItems()
    {
        if ($this->getComponent('ListPage')->ToggleEffectItems == true) {
            return true;
        }
    }
}
