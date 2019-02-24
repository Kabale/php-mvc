<?php
    include_once "./model/enum/baseEnum.php";

    abstract class MessageStatus extends BaseEnum
    {
        const Info = "alert-info";
        const Success = "alert-success";
        const Warning = "alert-warning";       
        const Error = "alert-danger"; 
    }
?>