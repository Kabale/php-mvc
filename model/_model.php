<?php
    include_once "./helper/DbHelper.php";

    class BaseModel
    {

        function __construct($filter)
        {
            $this->__constructcontext->setFilter($filter);
        }

        function save()
        {
            $dbHelper = new DbHelper();
            $table = strtolower(get_class($this))."s";
            if($this->getId() != null)
                //UPDATE
                $dbHelper->update($table, $this, $this->getId());
            else
                //CREATE
                $dbHelper->add($table, $this);
        }

        function delete()
        {
            $dbHelper = new DbHelper();
            $table = strtolower(get_class($this))."s";

            if($this->getId() != null) {
                
                $dbHelper->delete($table, $this->getId());
                //TODO: IF SUCCESSFULL DELETE
                $message = new Message("Delete", "Article deleted with success", MessageStatus::Success);
                $message->setMessage();
            } 
        }
    }