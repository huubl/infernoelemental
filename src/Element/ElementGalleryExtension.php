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

		);

	private static $has_many = array(
    'GalleryImages' => GalleryImage::class
  	);
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

	// Customise gridfield
	$gridFieldConfig->removeComponentsByType('GridFieldPaginator'); // Remove default paginator
	$gridFieldConfig->addComponent(new GridFieldPaginator(50)); // Add custom paginator
	$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
	$gridFieldConfig->removeComponentsByType('GridFieldAddNewButton'); // We only use bulk upload button

	$gridField = new GridField("GalleryImages", "Gallery Images", $this->owner->GalleryImages()->sort("SortOrder"), $gridFieldConfig);

	//Start fields
	$fields->addFieldToTab("Root.ImageGallery", DropdownField::create('GalSorting', 'Sorting by', array(
		'Created' => 'Date Created',
		'Title' => 'Image Name',
		'SortOrder' => 'SortOrder'
		)));

	$fields->addFieldToTab("Root.ImageGallery", DropdownField::create('GalDirection', 'Sorting Direction', array(
		'ASC' => 'Ascending',
		'DESC' => 'Descending',
		)));

	$fields->addFieldToTab("Root.ImageGallery", DropdownField::create('GalEffect', 'Transition Effect', array(
		'lg-fade' => 'lg-fade',
        'lg-zoom-in' => 'lg-zoom-in',
		'lg-zoom-in-big' => 'lg-zoom-in-big',
		'lg-zoom-out' => 'lg-zoom-out',
		'lg-zoom-out-big' => 'lg-zoom-out-big',
		'lg-zoom-out-in' => 'lg-zoom-out-in',
		'lg-zoom-in-out' => 'lg-zoom-in-out',
		'lg-soft-zoom' => 'lg-soft-zoom',
		'lg-scale-up' => 'lg-scale-up',
		'lg-slide-circular' => 'lg-slide-circular',
		'lg-slide-circular-vertical' => 'lg-slide-circular-vertical',
		'lg-slide-vertical' => 'lg-slide-vertical',
		'lg-slide-vertical-growth' => 'lg-slide-vertical-growth',
		'lg-slide-skew-only' => 'lg-slide-skew-only',
		'lg-slide-skew-only-rev' => 'lg-slide-skew-only-rev',
		'lg-slide-skew-only-y' => 'lg-slide-skew-only-y',
		'lg-slide-skew-only-y-rev' => 'lg-slide-skew-only-y-rev',
		'lg-slide-skew' => 'lg-slide-skew',
		'lg-slide-skew-rev' => 'lg-slide-skew-rev',
		'lg-slide-skew-cross'  => 'lg-slide-skew-cross',
		'lg-slide-skew-cross-rev' => 'lg-slide-skew-cross-rev',
		'lg-slide-skew-ver' => 'lg-slide-skew-ver',
		'lg-slide-skew-ver-rev' => 'lg-slide-skew-ver-rev',
		'lg-slide-skew-ver-cross' => 'lg-slide-skew-ver-cross',
		'lg-slide-skew-ver-cross-rev' => 'lg-slide-skew-ver-cross-rev',
		'lg-lollipop' => 'lg-lollipop',
		'lg-lollipop-rev' => 'lg-lollipop-rev',
		'lg-rotate' => 'lg-rotate',
		'lg-rotate-rev' => 'lg-rotate-rev',
		'lg-tube' => 'lg-tube',
		)));

	$fields->addFieldToTab("Root.ImageGallery", TextField::create('GalFolder', 'Gallery Folder'));

	$fields->addFieldToTab("Root.ImageGallery", $gridField);


			 return $fields;
		 }


	public function updateCMSFields(FieldList $fields) {



	return $fields;

	}

}

