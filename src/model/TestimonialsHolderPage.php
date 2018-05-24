<?php

namespace ilateral\SilverStripe\Testimonials\Model;

use Page;
use PageController;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Forms\GridField\GridField;
use ilateral\SilverStripe\Testimonials\Model\Testimonial;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class TestimonialsHolderPage extends Page 
{
    private static $icon = 'resources/i-lateral/silverstripe-testimonials/client/dist/images/testimonials-icon.png';
    private static $table_name = "TestimonialsHolder";

    function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab("Root.Testimonials",
            GridField::create("Testimonials","Testimonials", Testimonial::get(),
                GridFieldConfig_RecordEditor::create()
            )
        );
        return $fields;
    }

}

class TestimonialsHolderPageController extends PageController
{

    function getTestimonials(){
        return Testimonial::get();
    }
    
    function PaginatedTestimonials($page_length = 10) {
        $list = PaginatedList::create(
            $this->getTestimonials(),
            $this->request
        );
        $list->setPageLength($page_length);
        
        return $list;
    }
}
