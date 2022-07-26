<?php

namespace ilateral\SilverStripe\Testimonials\Control;

use PageController;
use SilverStripe\ORM\PaginatedList;
use ilateral\SilverStripe\Testimonials\Model\Testimonial;

class TestimonialsHolderPageController extends PageController
{
    public function getTestimonials()
    {
        return Testimonial::get();
    }
    
    public function PaginatedTestimonials($page_length = 10)
    {
        $list = PaginatedList::create(
            $this->getTestimonials(),
            $this->request
        );
        $list->setPageLength($page_length);
        
        return $list;
    }
}
