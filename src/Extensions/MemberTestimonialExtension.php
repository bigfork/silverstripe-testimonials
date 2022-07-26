<?php

namespace ilateral\SilverStripe\Testimonials\Extensions;

use SilverStripe\ORM\DataExtension;

/**
* MemberTestimonialExtension
*/
class MemberTestimonialExtension extends DataExtension 
{
    
    private static $belongs_to = array(
        'Testimonial' => 'Testimonial'
    );

}