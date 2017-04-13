<?php

    
    $scriptname = $_SERVER['SCRIPT_FILENAME'];

    defined("RESUME_PATH_BASE_URL") ? null : define("RESUME_PATH_BASE_URL", "tagwings-ajax/document/resume");
    
    defined("ATTACHMENT_PATH_BASE_URL") ? null : define("ATTACHMENT_PATH_BASE_URL", "tagwings-ajax/document/resume");
    
    
    defined('CONTACTUS_REPLY_ADD') ? null : define("CONTACTUS_REPLY_ADD", "no-reply@bolindiabol.news");
    defined('CONTACTUS_REPLY_NAME') ? null : define("CONTACTUS_REPLY_NAME", "Team BolIndiaBol");
    defined('CONTACTUS_FROM_ADD') ? null : define("CONTACTUS_FROM_ADD", "no-reply@bolindiabol.news");
    defined('CONTACTUS_FROM_NAME') ? null : define("CONTACTUS_FROM_NAME", "Team BolIndiaBol");    
    
    // Other configuration related to email
    // 1 : Use; 0: Use default php mail function settings
    defined('USE_SMTP_SERVER') ? null : define("USE_SMTP_SERVER", "0");
    defined('SMTP_HOST') ? null : define("SMTP_HOST", "");
    defined('SMTP_HOST_PORT') ? null : define("SMTP_HOST_PORT", "");
    defined('SMTP_HOST_USERNAME') ? null : define("SMTP_HOST_USERNAME", "");
    defined('SMTP_HOST_PASSWORD') ? null : define("SMTP_HOST_PASSWORD", "");
    // 1 = errors and messages; 2 = messages only
    defined('SMTP_DEBUGGING') ? null : define("SMTP_DEBUGGING", "2");
?>