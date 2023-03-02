<?php

include '../vendor/autoload.php';
Sentry\init(['dsn' => 'https://9feacd4b0dfd496c915b3336a5683aa2@o4504634853752832.ingest.sentry.io/4504735491293184']);
include '../autoloader.php';
include './Utility.php';

use Controllers\Validation\Validation;
use Controllers\Constants;

if (
        !isAjaxRequest()
        || $_SERVER["REQUEST_METHOD"] !== "POST"
) {
        die("<p class='bg-dark text-warning text-center rounded-2 p-3 my-0'>درخواست یک ایجکس نیست</p>");
}

parse_str($_POST["data"], $formInformation);

if (
        !isset($formInformation['CrawlerUrl'])
        || !isset($formInformation['CrawlerSelector'])
        || empty($formInformation['CrawlerStatus'])
        || empty($formInformation['CrawlerSelector'])
        || !in_array($formInformation['CrawlerStatus'], Constants::CRAWLER_FORM['status'])
) {
        die("<p class='bg-dark text-warning text-center rounded-2 p-3 my-0'>اعتبار سنجی فرم با خطا مواجه شد.</p>");
}

$formValid = new Validation($formInformation);
$formValid->get_data() ? true : die("<p class='bg-dark text-warning text-center rounded-2 p-3 my-0'>اعتبار سنجی فرم با خطا مواجه شد.</p>");

$classNameCreate = 'Controllers\Crawler\\' . $formInformation['CrawlerStatus'];
$className = new $classNameCreate($formValid->get_data());
$className->get_data();
$resultObject = ($className->content());

if (!is_object($resultObject)) {
        die("<p class='bg-dark text-warning rounded-2 p-3 my-0'>محتوایی با تگ مورد نظر پیدا نشد</p>");
}

echo filePutContents(convertToString($resultObject), $className->get_data()->url);
echo printResult($resultObject);

session_unset();
session_destroy();
