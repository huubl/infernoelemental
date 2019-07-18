<?php
namespace Inferno\InfernoElemental\Element;

    use DNADesign\Elemental\Models\BaseElement;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Assets\Image;
    use SilverStripe\Control\Controller;
    use SilverStripe\Forms\DropdownField;
    use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
    use SilverStripe\Forms\TextField;
    use SilverStripe\UserForms\Control\UserDefinedFormController;
    use SilverStripe\UserForms\Form\UserForm;
    use SilverStripe\UserForms\Model\UserDefinedForm;
    use TractorCow\Colorpicker\Forms\ColorField;

    /**
 * @package elemental
 */
class ElementContentExtension extends BaseElement
{
    private static $title = "Custom Content Block";
    private static $table_name = 'ElementContentExtension';

    private static $description = "Block of text with heading, blockquote, list and paragraph styles";
	private static $db = array(
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
		'BackgroundColor'=>'Color',
		'TextColor'=>'Color',
		'BackgroundImagePos'=>'Varchar',
		'BackgroundSize'=>'Varchar',
		'FormPosition' => 'Varchar',
		'FormText' => 'Varchar',
		'HTML' => 'HTMLText',
		'RowBackground' => 'Varchar',
		/*'DisplayTestimonials'=>'Varchar',*/
	);
    private static $has_one = array(
	    'BackgroundImage' => Image::class,
        'Form' => UserDefinedForm::class


	);
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Custom Content');
    }
    private static $has_many = array(//'Gallery'=>'Gallery'
);
	 public function getCMSFields()
    {
		 $fields = parent::getCMSFields();
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
    $RowBackgroundArray = ['container' => 'Container', 'container-fluid' => 'Container Fluid'];
		$FormPositionArray = array('0' => 'No form','1'=>'Left Side','2' => 'Right Side');
	$fields->addFieldToTab('Root.Main',new DropdownField('FormPosition','Choose Form Position',$FormPositionArray));
	$fields->addFieldToTab('Root.Main',new TextField('FormText','Choose form header to dispay'));
	$fields->addFieldToTab('Root.Background', DropdownField::create('RowBackground','Size of background for row',$RowBackgroundArray));
	$fields->addFieldToTab('Root.Background',new ColorField('BackgroundColor','Choose Background Color'));
	$fields->addFieldToTab('Root.Background',new UploadField('BackgroundImage','Choose Background Image'));
		 $PositionArray = array('center center'=>'center','center top'=>'center top','center bottom'=>'center bottom','left top'=>'left top','left center'=>'Left center','left bottom'=> 'left bottom','right top'=>'right top','right center ' =>'right center','right bottom'=>'right bottom');
	$fields->addFieldToTab('Root.Background',new DropdownField('BackgroundImagePos','Choose Background Image Positioning',$PositionArray));

		$backgroundSizeArray = array('auto' => 'Auto','length'=>'Length','percentage'=>'Percentage','cover'=>'Cover','contain'=>'Contain');
	$fields->addFieldToTab('Root.Background',new DropdownField('BackgroundSize','Choose Background Image Size',$backgroundSizeArray));
		$TestimonialsArray = array('0'=>'No','1'=>'Yes');

	$fields->addFieldsToTab('Root.Main', HTMLEditorField::create('HTML', 'Content'));
        return $fields;
    }
public function ElementForm()
    {
        if ($this->Form()->exists()) {
            $controller = new UserDefinedFormController($this->Form());

            $current = Controller::curr();

            if ($current && $current->getAction() == 'finished') {
                return $controller->renderWith('ReceivedFormSubmission');
            }

            $form = $controller->Form();

            return $form;
        }
    }


}

