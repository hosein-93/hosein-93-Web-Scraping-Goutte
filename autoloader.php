<?php

session_start();

function myAutoloader($class) {
        $classFile = __DIR__ . "/{$class}.php";
        if(file_exists($classFile) && is_readable($classFile)) {
                include $classFile;
        } elseif (strpos($classFile, "Client")){         // برای این که گووته به درستی اجرا شود در اجراکننده اتوماتیک خود گفته شد اجرا نشود چون مسیر فایل آن در وندور است و با پیش فرض ما مسیر غلط حاصل می شود
                return true;
        } 
        else {
                die("<div class='bg-dark p-3 my-5 rounded-2' dir='ltr'><h4 class='text-danger'>Could not load file : </h4><p class='text-warning mx-3 my-0'>{$classFile}</p></div>");
        }
}
spl_autoload_register('myAutoloader');