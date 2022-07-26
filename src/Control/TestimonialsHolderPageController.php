<?php

namespace ilateral\SilverStripe\Testimonials\Control;

use PageController;
use SilverStripe\ORM\PaginatedList;

class TestimonialsHolderPageController extends PageController
{   
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
