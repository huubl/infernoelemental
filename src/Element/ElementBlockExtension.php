<?php
namespace Inferno\InfernoElemental\Element;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use Inferno\InfernoBlocks\Blocks\Blocks;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class ElementBlockExtension extends BaseElement{
    private static $title = "Custom Multi block Row";
    private static $table_name = 'ElementMultiBlockExtension';

    private static $description = "Add multi block row with own styling";

    private static $db = [];

    private static $has_one = [];

    private static $has_many = ['Blocks' => Blocks::class];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Multi block Row');
    }
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();


        $fields->addFieldsToTab('Root.Main', HTMLEditorField::create('HTML', 'Content'));

        $gridFieldConfig= GridFieldConfig_RelationEditor::create(10);
        $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));


        $fields->addFieldToTab('Root.Main', GridField::create("Blocks", "Add Blocks to row",
            $this->owner->Blocks()->sort("SortOrder"), $gridFieldConfig));



        return $fields;
    }

}

