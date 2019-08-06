<?php
namespace Inferno\InfernoElemental\Element;

use DNADesign\Elemental\Models\BaseElement;
use Inferno\InfernoGallery\Gallery\GalleryImage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Form\UserForm;
use SilverStripe\UserForms\Model\UserDefinedForm;
use TractorCow\Colorpicker\Forms\ColorField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

/**
 * @package elemental
 */
class ElementGalleryExtension extends ElementContentExtension
{
	 private static $title = "Custom Gallery Block";
    private static $table_name = 'ElementGalleryExtension';
    private static $description = "A block with Galleries";
    private static $singular_name = 'Gallery block';

    private static $plural_name = 'Gallery blocks';


    private static $db = array(

		//Gallery options
		'GalFolder' => 'Varchar(100)',
		'GalEffect' => 'Varchar(30)',
		'GalSorting' => 'Varchar(30)',
		'GalDirection' => 'Varchar(30)',
        'ImageHeight' => 'Int',
        'ImageWidth' => 'Int'

		);

	private static $has_many = array(
    'GalleryImages' => GalleryImage::class
  	);
	private static $owns = [
	    'GalleryImages'
    ];
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Gallery block');
    }

		 public function getCMSFields()
    {
		 $fields = parent::getCMSFields();
			  $fields->removeByName("GalleryImages");

		// GridField configs
	$gridFieldConfig = GridFieldConfig_RecordEditor::create();

	$gridFieldConfig->addComponent(new \Colymba\BulkUpload\BulkUploader());
	$gridFieldConfig->addComponent(new \Colymba\BulkManager\BulkManager());

	if ($this->owner->GalFolder){
		$setgalfolder = '-' . $this->owner->GalFolder;
	}
	else {$setgalfolder = null;};

	//Set folder name and sequential uploads
//	$gridFieldConfig->getComponentByType(new GridFieldBulkUpload())
//    ->setUfSetup('setFolderName', 'Galleries/' . $this->owner->ID . $setgalfolder)
//    ->setUfConfig('sequentialUploads', true);

    $fields->addFieldToTab('Root.ImageGallery', TextField::create('ImageHeight', 'Height for images'));
    $fields->addFieldToTab('Root.ImageGallery', TextField::create('ImageWidth', 'Width for images'));
	// Customise gridfield
	$gridFieldConfig->removeComponentsByType('GridFieldPaginator'); // Remove default paginator
	$gridFieldConfig->addComponent(new GridFieldPaginator(50)); // Add custom paginator
	$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
	$gridFieldConfig->removeComponentsByType('GridFieldAddNewButton'); // We only use bulk upload button

	$gridField = new GridField("GalleryImages", "Gallery Images", $this->owner->GalleryImages()->sort("SortOrder"), $gridFieldConfig);

	//Start fields


	$fields->addFieldToTab("Root.ImageGallery", TextField::create('GalFolder', 'Gallery Folder'));

	$fields->addFieldToTab("Root.ImageGallery", $gridField);


			 return $fields;
		 }


	public function updateCMSFields(FieldList $fields) {



	return $fields;

	}

}

