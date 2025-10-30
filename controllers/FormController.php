<?php

class FormController extends TableController
{




    public function __construct(Database $database)
    {


        $this->set_connection($database->get_connection());
        $this->set_table("branch_forms");
        $this->set_primary_key("id");
        $this->set_foreign_keys(['branch']);
        parent::__construct($database, $this->table);
    }
}
