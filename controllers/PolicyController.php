<?php

class PolicyController extends TableController
{

  
    public function __construct(Database $database)
    {
        $this->set_connection($database->get_connection());
        $this->set_table("policies");
        $this->set_primary_key("id");
        parent::__construct($database, $this->table);
    }

 }
