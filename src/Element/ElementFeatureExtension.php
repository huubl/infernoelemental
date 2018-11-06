<?php
namespace Inferno\InfernoElemental\Element;

use DNADesign\Elemental\Models\BaseElement;
use Inferno\InfernoFeature\Feature\FeatureHead;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Form\UserForm;
use SilverStripe\UserForms\Model\UserDefinedForm;
use TractorCow\Colorpicker\Forms\ColorField;
/**
 * @package elemental
 */
class ElementFeatureExtension extends ElementContentExtension
{
    private static $title = "Feature Block";
    private static $table_name = 'ElementFeatureExtension';
    private static $description = "Block for displaying features";
    private static $singular_name = 'Feature Block';

    private static $plural_name = 'Feature Blocks';

    private static $db = array(

		//Features
        'AmountFeatures' => 'Varchar',
		'FirstFeature'=>'Varchar',
		'SecondFeature'=>'Varchar',
		'ThirdFeature'=>'Varchar',
		'FourthFeature'=>'Varchar',
		'FeatureText' => 'Varchar',
		//Feature with Extra
		'FirstFeatureExtra'=>'Varchar',
		'SecondFeatureExtra'=>'Varchar',
		'ThirdFeatureExtra'=>'Varchar',
		'FourthFeatureExtra'=>'Varchar',
		'FeatureTextExtra' => 'Varchar',
		//Links
		'FirstFeatureLink' => 'Varchar(255)',
		'SecondFeatureLink' => 'Varchar(255)',
		'ThirdFeatureLink' => 'Varchar(255)',
		'FourthFeatureLink' => 'Varchar(255)',

	);
    private static $has_one = array(
	'BackgroundImage' => Image::class,

	);
    private static $has_many = array(
	'HeaderTitles' => FeatureHead::class,

);
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Feature block');
    }
	 public function getCMSFields()
    {
		 $fields = parent::getCMSFields();
        $fields->removeByName("HeaderTitles");
		 //Features tab
		 $AmountFeatureArray = array('0'=>'None','2' => 'Two Columns','3' => 'Three Columns','4' => 'Four Columns');
		 $fields->addFieldToTab('Root.Features', new DropdownField('AmountFeatures','How many Header Rows?',$AmountFeatureArray));
		  $fields->addFieldsToTab("Root.Features", array(
		TextField::create('FeatureText','Features Header')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('FirstFeature','First Heading')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('FirstFeatureExtra','First Heading Extra')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('SecondFeature','Second Heading')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('SecondFeatureExtra','Second Heading Extra')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('ThirdFeature','Third Heading')->hideIf("AmountFeatures")->isEqualTo(1)->orIf()->isEqualTo(2)->end(),
		TextField::create('ThirdFeatureExtra','Third Heading Extra')->hideIf("AmountFeatures")->isEqualTo(1)->orIf()->isEqualTo(2)->end(),
		TextField::create('FourthFeature','Fourth Heading')->hideIf("AmountFeatures")->isEqualTo(1)->orIf()->isEqualTo(2)->orIf()->isEqualTo(3)->end(),
		TextField::create('FourthFeatureExtra','Fourth Heading Extra')->hideIf("AmountFeatures")->isEqualTo(1)->orIf()->isEqualTo(2)->orIf()->isEqualTo(3)->end(),

		 ));

		$gridFieldConfig=GridFieldConfig_RelationEditor::create(10);

		//$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
		$gridField = GridField::create("HeaderTitles", "Feature Rows", $this->owner->HeaderTitles(), $gridFieldConfig);

		$fields->addFieldToTab("Root.Features", $gridField);

		  $fields->addFieldsToTab("Root.Features", array(

		TextField::create('FirstFeatureLink','First Feature Link')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('SecondFeatureLink','Second Feature Link')->hideIf("AmountFeatures")->isEqualTo(0)->end(),
		TextField::create('ThirdFeatureLink','Third Feature Link')->hideIf("AmountFeatures")->isEqualTo(1)->orIf()->isEqualTo(2)->end(),
		TextField::create('FourthFeatureLink','Fourth Feature Link')->hideIf("AmountFeatures")->isEqualTo(1)->orIf()->isEqualTo(2)->orIf()->isEqualTo(3)->end(),

		 ));

        return $fields;
    }
	function getFeatures() {
	$page = $this->owner;
	$RowFeatures = $this->owner->HeaderTitles();

	return $RowFeatures;

	}

// public function canEdit($member = null)
//    {
//        return Permission::check('ADMIN') || Permission::check('BLOCK_EDIT');
//    }
//
//    public function canDelete($member = null)
//    {
//        return Permission::check('ADMIN') || Permission::check('BLOCK_DELETE');
//    }
//
//    public function canCreate($member = null)
//    {
//        return Permission::check('ADMIN') || Permission::check('BLOCK_CREATE');
//    }
//
//    public function canPublish($member = null)
//    {
//        return Permission::check('ADMIN') || Permission::check('BLOCK_PUBLISH');
//    }

}
