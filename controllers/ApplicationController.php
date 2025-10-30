<?php

class ApplicationController extends TableController
{

    public function __construct(Database $database)
    {
        $this->set_connection($database->get_connection());
        $this->set_table("applications");
        $this->set_primary_key("id");
        $this->set_foreign_keys(['user','course','value']);
        parent::__construct($database, $this->table);
    }



    public function get_my_applications($user_id)
    {
        return $this->get_by_foreignKey('user', $user_id);
    }

    public function register_applications($data)
    {
        $check_keys=['user','course'];
        $result = array();
        if($this->is_registerd($data, $check_keys))
        {
            $result['error'] = "Already registered";
         
        
        }else
        {
            $result = $this->register($data);
            $result['message'] = "Successfully registered";
        }


        return $result;
    }

    




 }
