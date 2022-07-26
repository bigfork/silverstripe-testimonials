<?php

namespace ilateral\SilverStripe\Testimonials\CMS;

use SilverStripe\Admin\ModelAdmin;
use ilateral\SilverStripe\Testimonials\Model\Testimonial;

class TestimonialsAdmin extends ModelAdmin 
{
    private static $menu_title = 'Testimonials';

    private static $url_segment = 'testimonials';

    private static $menu_icon_class = 'font-icon-comment';

    private static $managed_models = array(
        Testimonial::class
    );
}
