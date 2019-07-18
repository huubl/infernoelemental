<?php
namespace Inferno\InfernoElemental\Element;

use DNADesign\Elemental\Models\BaseElement;
use Inferno\InfernoSlider\Slider\RotatingBanners;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Form\UserForm;
use SilverStripe\UserForms\Model\UserDefinedForm;
use TractorCow\Colorpicker\Forms\ColorField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

/**
 * @package elemental
 */
class ElementSliderExtension extends ElementContentExtension
{
	 private static $title = "Custom Slider Block";
    private static $table_name = 'ElementSliderExtension';
    private static $description = "A block with sliders";
    private static $singular_name = 'Slider block';

    private static $plural_name = 'Slider blocks';

    private static $db = array(
	'Interval'=>'Varchar(10)',
	'Swipe'=>'Varchar(10)',
	'IconColor' => 'Color',

	);

    private static $has_one = array();

    private static $has_many = array(
	'Banners'=>RotatingBanners::class
	);
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Slider block');
    }

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main", "HTML");
		$fields->removeByName("Banners");

		$fields->addFieldToTab("Root.Settings", new ColorField('IconColor', 'Icon colors'));
		$gridFieldConfig= GridFieldConfig_RelationEditor::create(10);
		$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));

		$GridField = new GridField("Banners", "Recursive Rotating Banners", $this->owner->Banners()->sort("SortOrder"), $gridFieldConfig);
	$fields->addFieldToTab("Root.Main", $GridField);
	return $fields;


	}

}
