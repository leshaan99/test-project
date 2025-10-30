<?php

class DocumentController extends TableController
{




    public function __construct(Database $database)
    {

        $this->set_connection($database->get_connection());
        $this->set_table("documents");
        $this->set_primary_key("id");
        $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);
    }



    public function get_my_documents($user_id)
    {

        return $this->get_by_foreignKey('user', $user_id, 'created_date DESC');
    }
}
