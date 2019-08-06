<?php

namespace Inferno\InfernoElemental\Element;

use Colymba\BulkManager\BulkManager;
use Colymba\BulkUpload\BulkUploader;
use DNADesign\Elemental\Models\BaseElement;
use Inferno\InfernoGallery\Gallery\GalleryImage;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;
use SilverStripe\View\Requirements;
use SilverStripe\Security\PermissionProvider;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class ElementMyGalleryExtension extends ElementContentExtension {

    private static $db = array(
        'WidthHeight' => 'Varchar',
        'ImageHeight' => 'Int',
        'ImageWidth' => 'Int'
    );

    private static $has_one = array(

    );

    // One gallery page has many gallery images

    private static $has_many = array(
        'GalleryImage' => GalleryImage::class
    );
    private static $owns = [
        'GalleryImage'
    ];

    // Add CMS description

    private static $description = "Add a Photo Gallery to the site";

    private static $singular_name = 'Photo Gallery';

    private static $table_name = 'Gallery new';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Gallery');
    }

    // Set Permissions

    public function getCMSFields() {

        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.ImageGallery', TextField::create('ImageHeight', 'Height for images'));
        $fields->addFieldToTab('Root.ImageGallery', TextField::create('ImageWidth', 'Width for images'));
        // Customise gridfield
        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent(new \Colymba\BulkUpload\BulkUploader());
        $gridFieldConfig->addComponent(new \Colymba\BulkManager\BulkManager());
        $gridFieldConfig->removeComponentsByType('GridFieldPaginator'); // Remove default paginator
        $gridFieldConfig->addComponent(new GridFieldPaginator(50)); // Add custom paginator
        $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $gridFieldConfig->removeComponentsByType('GridFieldAddNewButton'); // We only use bulk upload button

        $gridField = new GridField("GalleryImage", "Gallery Images", $this->owner->GalleryImage()->sort("SortOrder"), $gridFieldConfig);
        $fields->addFieldToTab("Root.ImageGallery", $gridField);


        return $fields;

    }

}

