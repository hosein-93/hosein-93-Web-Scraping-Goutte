<?php

namespace Controllers\Crawler;

use Controllers\Constants;      // فرآحوانی کلاس ثابت ها

use Firebase\JWT\JWT;   // مرتبط با کتابخانه jwt
use Firebase\JWT\Key;   // مرتبط با کتابخانه jwt

use Goutte\Client;      // مرتبط با کتابخانه goutte

class Crawler
{
        protected $jwtValue = Constants::JWT_VALUES;
        protected $data;
        protected $tagContent = [];
        protected $linkContent = [];

        public function __construct($value)
        {
                $this->data = JWT::decode($value, new Key($this->jwtValue['key'], $this->jwtValue['algorithm']));
        }

        public function get_data()
        {
                $selectorArray = explode(Constants::CRAWLER_FORM['seprator'], $this->data->selector);
                if (count($selectorArray) > 1) :
                        $this->data->selectors = [];
                        foreach($selectorArray as $key => $value) :
                                $this->data->selectors[$key] = $value;
                        endforeach;
                        $this->data->selectors = (object)$this->data->selectors;
                 else :
                        $this->data->selectors = $this->data->selector;
                 endif;

                if (
                        $this->data->status === Constants::CRAWLER_FORM['status']['link']
                        || $this->data->status === Constants::CRAWLER_FORM['status']['linkSrc']
                ) :
                        $selectorLinkArray = explode(Constants::CRAWLER_FORM['seprator'], $this->data->selectorLink);
                        if (count($selectorLinkArray) > 1) {
                                $this->data->selectorLinks = [];
                                foreach ($selectorLinkArray as $key => $value) :
                                        $this->data->selectorLinks[$key] = $value;
                                endforeach;
                                $this->data->selectorLinks = (object)$this->data->selectorLinks;
                        } else {
                                $this->data->selectorLinks = $this->data->selectorLink;
                        }
                endif;

                return $this->data;
        }

        public function content()
        {
                return die("<p class='bg-dark text-warning rounded-2 p-3 my-0'>متد content موجود در کلاس Crawler باید در کلاس فرزند overwrite شود</p>");
        }
}
