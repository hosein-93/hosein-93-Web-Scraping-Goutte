<?php

use Firebase\JWT\JWT;   // مرتبط با کتابخانه jwt
use Firebase\JWT\Key;   // مرتبط با کتابخانه jwt

use Controllers\Constants;

function isAjaxRequest()
{
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                return true;
        }
        return false;
}

function printResult(object $parameter): string
{
        $print = "<ul class='bg-dark text-warning p-3 rounded-3'>";
        foreach ($parameter as $key => $value) :
                if (is_object($value)) :
                        $print .= "<h5 class='text-light'><small>{$key}</small></h5>";
                        $print .= printResult($value);
                else :
                        if (!empty($value)) {
                                $print .= "<li class='px-3'><small>{$value}</small></li>";
                        }
                endif;
        endforeach;
        $print .=  "</ul>";
        return $print;
}

function convertToString(object $parameter): string
{
        $print = "";
        foreach ($parameter as $key => $value) :
                if (is_object($value)) :
                        $print .= PHP_EOL . "\t{$key}" . PHP_EOL;
                        $print .= convertToString($value);
                else :
                        if (!empty($value)) {
                                $print .= "\t\t{$value}" . PHP_EOL;
                        }
                endif;
        endforeach;
        return $print;
}

function filePutContents(string $string, string $url): string
{
        $folderPath = Constants::URL_PATH . Constants::RESOURCE['folder'];
        $filePath = $folderPath . Constants::RESOURCE['file'];
        $fileURL = Constants::URL . Constants::RESOURCE['folder'] . Constants::RESOURCE['file'];
        is_dir($folderPath) ? true : mkdir($folderPath, 0777, true);
        file_exists($filePath) ? unlink($filePath) : true;
        sleep(1); // جهت حذف فایل و تولید و نوشتن اطلاعات در آن نیاز به یک تاخیر کوچک هست
        file_put_contents($filePath, $url . PHP_EOL . PHP_EOL, FILE_APPEND);
        file_put_contents($filePath, $string . PHP_EOL, FILE_APPEND);
        return "<a href='{$fileURL}' target='_blank' class='d-block bg-dark text-warning text-center p-3 mb-3 rounded-3'>دانلود فایل تولید شده</a>";
}
