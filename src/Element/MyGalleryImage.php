<?php

namespace Inferno\InfernoElemental\Element;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class MyGalleryImage extends DataObject {

    private static $db = array(
        'Title' => 'Varchar',
        'Description' => 'Varchar(500)'
    );

    // One-to-one relationship with gallery page
    private static $has_one = array(
        'Image' => Image::class,
        'ElementMyGalleryExtension' => ElementMyGalleryExtension::class,
    );
    private static $owns = ['Image'];

    // Add fields to dataobject
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields = new FieldList(
            new TextField('Title','Image Title'),
            new TextareaField('Description','Photo Description (Max 500 Charachters)'),
            new UploadField('Image','Photo')
        );
        return $fields;
    }



    // Tell the datagrid what fields to show in the table

    // this function creates the thumnail for the summary fields to use

    public function onAfterWrite()
    {
        if ($this->owner->ImageID) {
            $this->owner->Image()->publishSingle();
        }
    }


}



