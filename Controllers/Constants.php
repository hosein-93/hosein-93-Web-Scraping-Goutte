<?php

namespace Controllers;

class Constants
{
        const URL = 'http://localhost/script.ac/Web-Scraping-with-Goutte/';
        const URL_PATH = 'C:\xampp\htdocs\script.ac\Web-Scraping-with-Goutte/';
        const CRAWLER_FORM = [
                'form' => 'webCrawlingGoutte',
                'url' => 'CrawlerUrl',
                'status' => [
                        'name' => 'CrawlerStatus',
                        'tag' => 'CrawlerTag',
                        'src' => 'CrawlerSrc',
                        'link' => 'CrawlerLink',
                        'linkSrc' => 'CrawlerLinkSrc'
                ],
                'selector' => 'CrawlerSelector',
                'selectorLink' => 'CrawlerLinkSelector',
                'submit' => 'CrawlerSubmit',
                'seprator' => '~~~'
        ];
        const JWT_VALUES = [
                'key' => 'web crawling with goutte',
                'algorithm' => 'HS256'
        ];
        const RESOURCE = [
                'folder'=> 'CrawlerResult', 
                'file'=> '/resource.txt'
        ];
}
