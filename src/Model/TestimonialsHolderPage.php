<?php

namespace ilateral\SilverStripe\Testimonials\Model;

use ilateral\SilverStripe\Testimonials\Control\TestimonialsHolderPageController;
use Page;
use SilverStripe\Forms\GridField\GridField;
use ilateral\SilverStripe\Testimonials\Model\Testimonial;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class TestimonialsHolderPage extends Page 
{
    private static $table_name = "TestimonialsHolder";

    private static $controller_name = TestimonialsHolderPageController::class;

    private static $icon_class = 'font-icon-comment';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            "Root.Testimonials",
            GridField::create(
                "Testimonials",
                "Testimonials",
                Testimonial::get(),
                GridFieldConfig_RecordEditor::create()
            )
        );

        return $fields;
    }
}
