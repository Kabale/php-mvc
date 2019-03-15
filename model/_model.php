<?php
    include_once "./helper/DbHelper.php";

    class BaseModel
    {
        function save()
        {
            try
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
            catch(PDOException $e)
            {
                $message = new Message("SQL Error", $e, MessageStatus::Error);
                $message->setMessage();
                $result = null;
            }
        }

        function delete()
        {
            try
            {
                $dbHelper = new DbHelper();
                $table = strtolower(get_class($this))."s";

                if($this->getId() != null) {
                    
                    $dbHelper->delete($table, $this->getId());
                    //TODO: IF NOT SUCCESSFULL DELETE
                    $message = new Message("Delete", "Article deleted with success", MessageStatus::Success);
                    $message->setMessage();
                } 
            }
            catch(PDOException $e)
            {
                $message = new Message("SQL Error", $e, MessageStatus::Error);
                $message->setMessage();
                $result = null;
            }
        }
    }