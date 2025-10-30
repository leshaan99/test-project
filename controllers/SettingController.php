<?php
class SettingController extends TableController
{

    public function __construct(Database $database)
    {
        $this->set_connection($database->get_connection());
        $this->set_table("settings");
        $this->set_primary_key("id");
        // $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);
    }
    public function getSettings($element)
    {
        switch ($element) {
            case 'f1':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?   "System Name" :  $this->get_one_by_id(1)['data']['f1'];
                break;
            case 'f2':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ? "System Short Name" : $this->get_one_by_id(1)['data']['f2'];
                break;
            case 'f3':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Admin Email" : $this->get_one_by_id(1)['data']['f3'];
                break;
            case 'f4':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Phone Number" : $this->get_one_by_id(1)['data']['f4'];
                break;
            case 'f5':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ? "Email" : $this->get_one_by_id(1)['data']['f5'];
                break;
            case 'f6':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "App URL" : $this->get_one_by_id(1)['data']['f6'];
                break;
            case 'f7':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Location" : $this->get_one_by_id(1)['data']['f7'];
                break;
            case 'f8':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "About Us" : $this->get_one_by_id(1)['data']['f8'];
                break;
            case 'f9':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Home,/, About Us, About us, Courses,courses, Events,events, Scholarships,schloarships,Blogs,blogs, Contact Us,contactus" : $this->get_one_by_id(1)['data']['f9'];
                break;
            case 'f10':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "facebook" : $this->get_one_by_id(1)['data']['f10'];
                break;
            case 'f11':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Twitter" : $this->get_one_by_id(1)['data']['f11'];
                break;
            case 'f12':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "LinkedIn" : $this->get_one_by_id(1)['data']['f12'];
                break;
            case 'img1':
                return (isset($element, $this->get_one_by_id(1)['data'])) ?  "favicon" : $this->get_one_by_id(1)['data']['img1'];
                break;
            case 'img2':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Header Logo" : $this->get_one_by_id(1)['data']['img2'];
                break;
            case 'img3':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ? "Footer Logo" : $this->get_one_by_id(1)['data']['img3'];
                break;
            case 'img4':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Backend Logo" : $this->get_one_by_id(1)['data']['img4'];
                break;
            case 'img5':
                return (in_array($element, $this->get_one_by_id(1)['data'])) ?  "Backend Nav Logo" : $this->get_one_by_id(1)['data']['img5'];
                break;
            default:
                return (in_array($element, $this->get_one_by_id(1)['data'])) ? "" : $this->get_one_by_id(1)['data'][$element];
        }
    }
}
