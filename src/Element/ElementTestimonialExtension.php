<?php
namespace Inferno\InfernoElemental\Element;

use DNADesign\Elemental\Models\BaseElement;
use Inferno\InfernoTestimonial\Testimonial\Testimonials;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Form\UserForm;
use SilverStripe\UserForms\Model\UserDefinedForm;
use TractorCow\Colorpicker\Forms\ColorField;
/**
 * @package elemental
 */
class ElementTestimonialExtension extends ElementContentExtension
{
	 private static $title = "Custom Testimonial Block";
    private static $table_name = 'ElementTestimonialExtension';
    private static $description = "A block with testimonials";
    private static $singular_name = 'Testimonial block';

    private static $plural_name = 'Testimonial blocks';


    private static $db = array(
		'Columns'=>'Varchar',
		'DisplayImages' => 'Varchar',
		'ImagePosition'=>'Varchar',
		'PaddingOptions' => 'Varchar',
		'Padding'=>'Varchar',
		'TopPadding'=>'Varchar',
		'RightPadding'=>'Varchar',
		'LeftPadding'=>'Varchar',
		'BottomPadding'=>'Varchar',
		'MarginOptions' => 'Varchar',
		'Margin' => 'Varchar',
		'TopMargin'=>'Varchar',
		'RightMargin'=>'Varchar',
		'LeftMargin'=>'Varchar',
		'BottomMargin'=>'Varchar',
		'MarginOptions' => 'Varchar',
		'BackgroundColor'=>'Color',
		'TextColor'=>'Color',
		'ArrowColor'=>'Color',
		'ArrowSize'=>'Varchar'


		);
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Testimonial Block');
    }
		 public function getCMSFields()
    {
		 $fields = parent::getCMSFields();
			 $ColumnArray = array('1'=>'Full width','2' => '2 col','3' =>'3 col','4' => '4 col');
			   $fields->addFieldToTab('Root.Main',new DropdownField('Columns','Choose column width',$ColumnArray),'HTML');

			 $DisplayArray = array('0' => 'No','1' => 'Yes');
			 $fields->addFieldToTab('Root.Main',new DropdownField('DisplayImages','Display Images',$DisplayArray),'HTML');
			 $DisplayLocationArray = array('0' => 'Left','1' =>'Right');
			 $fields->addFieldToTab('Root.Main',new DropdownField('ImagePosition','Display Images Position',$DisplayLocationArray),'HTML');
			 $fields->addFieldToTab('Root.Background',new ColorField('ArrowColor','Choose Arrow Color'));
			 $fields->addFieldToTab('Root.Background',new TextField('ArrowSize','Choose Arrow Size'));
			 $PaddingOptionsarray = array('0'=> 'All around','1' => 'Specific');
    $fields->addFieldToTab('Root.Settings',new DropdownField('PaddingOptions','Choose Padding options',$PaddingOptionsarray));
		 $fields->addFieldsToTab("Root.Settings", array(
		TextField::create('Padding','Choose amount of padding')->hideIf("PaddingOptions")->isEqualTo(1)->end(),
		TextField::create('TopPadding','Choose amount of top padding')->hideIf("PaddingOptions")->isEqualTo(0)->end(),
		TextField::create('RightPadding','Choose amount of right padding')->hideIf("PaddingOptions")->isEqualTo(0)->end(),
		TextField::create('BottomPadding','Choose amount of bottom padding')->hideIf("PaddingOptions")->isEqualTo(0)->end(),
		TextField::create('LeftPadding','Choose amount of left padding')->hideIf("PaddingOptions")->isEqualTo(0)->end(),
		 ));

	$MarginOptionsarray = array('0'=> 'All around','1' => 'Specific');
    $fields->addFieldToTab('Root.Settings',new DropdownField('MarginOptions','Choose Margin options',$MarginOptionsarray));
		 $fields->addFieldsToTab("Root.Settings", array(
		TextField::create('Margin','Margin','Choose amount of margin')->hideIf("MarginOptions")->isEqualTo(1)->end(),
		TextField::create('TopMargin','Choose amount of top margin')->hideIf("MarginOptions")->isEqualTo(0)->end(),
		TextField::create('RightMargin','Choose amount of right margin')->hideIf("MarginOptions")->isEqualTo(0)->end(),
		TextField::create('BottomMargin','Choose amount of bottom margin')->hideIf("MarginOptions")->isEqualTo(0)->end(),
		TextField::create('LeftMargin','Choose amount of left margin')->hideIf("MarginOptions")->isEqualTo(0)->end(),
		 ));
	$fields->addFieldToTab('Root.Background',new ColorField('TextColor','Choose Text Color'));
	$fields->addFieldToTab('Root.Background',new ColorField('BackgroundColor','Choose Background Color'));

			 return $fields;
		 }
	public function Testimonials(){
		$Testimonials = Testimonials::get();
		return $Testimonials;

	}
//	 public function canEdit($member = null)
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
