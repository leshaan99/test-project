<?php

class AboutController extends TableController
{


 
    public function __construct(Database $database)
    {
  

        $this->set_connection($database->get_connection());
        $this->set_table("abouts");
        $this->set_primary_key("id");
        parent::__construct($database, $this->table);

        
    }

 }
