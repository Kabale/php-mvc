<?php
    include_once "./model/enum/basic.php";

    abstract class MessageStatus extends BasicEnum
    {
        const Info = "alert-info";
        const Success = "alert-success";
        const Warning = "alert-warning";       
        const Error = "alert-danger"; 
    }
?>