<?php

namespace Controllers\Validation;

use Controllers\Constants;      // فرآحوانی کلاس ثابت ها

use Firebase\JWT\JWT;   // مرتبط با کتابخانه jwt
use Firebase\JWT\Key;   // مرتبط با کتابخانه jwt

class Validation
{
        private $data;
        private $jwtValue = Constants::JWT_VALUES;

        public function __construct($value)
        {
                return $this->data = $value;
        }

        private function crawlerUrl()
        {
                if (!isset($this->data['CrawlerUrl']) || empty($this->data['CrawlerUrl'])) {
                        return false;
                }
                // برای صحت درست بودن آن که در ورودی یک آدرس اینترنتی وارد شده است از regex استفاده کردیم
                $pattern = "/((http|ftp|https):\/\/){0,1}([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])/";
                $subject = $this->data['CrawlerUrl'];
                // مقدار برگشتی تابع زیر یک آرایه است که عنصر اول آن آدرس اینترنتی است
                preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);
                return !empty($matches[0]) ? implode('', $matches[0]) : false;    // یک آرایه یک عنصری است که آن را به یک رشته تبدیل کردیم
        }

        private function crawlerStatus()
        {
                if (isset($this->data['CrawlerStatus']) || !empty($this->data['CrawlerStatus'])) {
                        return in_array($this->data['CrawlerStatus'], Constants::CRAWLER_FORM['status'], true) ? true : false;
                }
                return false;
        }

        private function crawlerSelector()
        {
                return isset($this->data['CrawlerSelector']) || !empty($this->data['CrawlerSelector']) ? true : false;
        }

        private function crawlerLinkSelector()
        {
                if (!isset($this->data['CrawlerLinkSelector']) || empty($this->data['CrawlerLinkSelector'])) {
                        return false;
                }
                $pattern = '/([a-zA-Z0-9 \/\!\@\#$\%\^|&\*\(\)\_\-\+\=\-\/\[\]\{\}\;\:\'"\?\.\,\<\>]*(~~~){1}[a-zA-Z0-9 \/\!\@\#$\%\^|&\*\(\)\_\-\+\=\-\/\[\]\{\}\;\:\'"\?\.\,\<\>]*)|[a-zA-Z0-9 \/\!\@\#$\%\^|&\*\(\)\_\-\+\=\-\/\[\]\{\}\;\:\'"\?\.\,\<\>]*/';
                $subject = $this->data['CrawlerLinkSelector'];
                preg_match_all($pattern, $subject, $matches, PREG_PATTERN_ORDER);
                return ($matches[0][0] === $subject) ? true : false;
        }

        public function get_data()
        {
                if ($this->crawlerUrl() && $this->crawlerStatus() && $this->crawlerSelector()) :
                        $payload = [
                                'iss' => 'Exporter : Hosein Abdollahpoor',      // صادر کننده
                                'aud' => 'Receiver : web crawling Goutte',      // موضوع
                                'iat' => time(),        // زمان ایجاد
                                'exp' => time() + 600000,       // زمان انقضا
                                'url' => $this->data['CrawlerUrl'],
                                'status' => $this->data['CrawlerStatus'],
                                'selector' => $this->data['CrawlerSelector'],
                        ];
                        if (
                                $this->data['CrawlerStatus'] === Constants::CRAWLER_FORM['status']['link']
                                || $this->data['CrawlerStatus'] === Constants::CRAWLER_FORM['status']['linkSrc']
                        ) :
                                if (empty($this->crawlerLinkSelector())) { return false; }
                                $payload['selectorLink'] = $this->data['CrawlerLinkSelector'];
                        endif;

                        $jwt = JWT::encode($payload, $this->jwtValue['key'], $this->jwtValue['algorithm']);
                        // $decoded = JWT::decode($jwt, new Key($this->jwtValue['key'], $this->jwtValue['algorithm']);
                        return $jwt;
                endif;
                return false;
        }
}
