<?php

namespace ilateral\SilverStripe\Testimonials\Model;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Security\Permission;
use ilateral\SilverStripe\Testimonials\Model\TestimonialsHolderPage;
use SilverStripe\Security\Security;

class Testimonial extends DataObject
{
    private static $table_name = "Testimonial";

    private static $singular_name = "Testimonial";

    private static $plural_name = "Testimonials";

    private static $db = array(
        'Content' => 'Text',
        'Name' => 'Varchar',
        'Business' => 'Varchar',
        'Date' => 'Date',
        'Hidden' => 'Boolean',
    );

    private static $has_one = array(
        'Image' => Image::class,
        'Member' => Member::class
    );

    private static $owns = [
        'Image'
    ];

    private static $summary_fields = array(
        'Business',
        'Name',
        'Date'
    );

    private static $searchable_fields = [
        'Name',
        'Business',
        'Date'
    ];

    private static $default_sort = "Date DESC";

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->addFieldToTab("Root.Main",
                DropdownField::create(
                    "MemberID",
                    "Member",
                    Member::get()->map("ID","Name")->toArray()
                )->setEmptystring(_t("Testimonials.NoName", "No Name Left"))
            );
        });

        return parent::getCMSFields();
    }

    public function getFrontEndFields($params = null)
    {
        $fields = $this->scaffoldFormFields($params);

        $fields->removeByName('Date');
        $fields->removeByName('Hidden');

        if (!$this->isInDB()) {
            $fields->removeByName('Image');
        }

        if (isset($params['Testimonial']) && $params['Testimonial']->MemberID) {
            $fields->removeByName("Name");
        }

        $fields->removeByName("MemberID");

        $this->extend('updateFrontEndFields', $fields);

        return $fields;
    }

    public function Link()
    {
        if ($page = TestimonialsHolderPage::get()->first()) {
            return $page->Link().'#Testimonial'.$this->ID;
        }
    }

    public function Image()
    {
        $member = $this->Member();
        if($member->exists() && $member->ImageID){
            return $member->Image();
        }
        return $this->getComponent("Image");
    }

    public function Name()
    {
        if($this->Member()->exists()){
            return $this->Member()->Name;
        }
        return $this->getField("Name");
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if(!$this->Date) {
            $this->Date = date('Y-m-d H:i:s');
        }
    }

    public static function get_random($limit = 3)
    {
        return Testimonial::get()->sort("RAND()")->limit($limit);
    }

    public function canCreate($member = null, $context = array())
    {
        if(!$member) $member = Security::getCurrentUser();

        return (boolean)$member;
    }

    public function canEdit($member = null)
    {
        if(!$member) $member = Security::getCurrentUser();

        return Permission::check("CMS_ACCESS_CMSMain") || ($member && $this->MemberID == $member->ID);
    }

    public function canDelete($member = null) {
        if(!$member) $member = Security::getCurrentUser();

        return Permission::check("CMS_ACCESS_CMSMain") || ($member && $this->MemberID == $member->ID);
    }

    public function canView($member = null) {
        return true;
    }

}
