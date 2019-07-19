<?php

namespace Inferno\InfernoElemental\Element;

use Colymba\BulkManager\BulkManager;
use Colymba\BulkUpload\BulkUploader;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;
use SilverStripe\View\Requirements;
use SilverStripe\Security\PermissionProvider;

class ElementMyGalleryExtension extends BaseElement {

    private static $db = array(
        'WidthHeight' => 'Varchar'
    );

    private static $has_one = array(

    );

    // One gallery page has many gallery images

    private static $has_many = array(

        'MyGalleryImages' => MyGalleryImage::class

    );

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

        $widthHeight = [ 160 => '6', '133' => '7', '114' => '8', '99' => '9', '87' => '10'];

        $fields = new FieldList(

            DropdownField::create('WidthHeight', 'How many images in row',$widthHeight),
            GridField::create(
                'MyGalleryImages',
                'Gallery Images',
                $this->MyGalleryImages(),
                GridFieldConfig_RecordEditor::create()
            ));

        return $fields;

    }

}

