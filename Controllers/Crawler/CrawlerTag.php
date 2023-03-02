<?php

namespace Controllers\Crawler;

use Controllers\Crawler\Crawler;

use Goutte\Client;      // مرتبط با کتابخانه goutte

final class CrawlerTag extends Crawler
{
        private function singleSelector($parameter_S)
        {
                $client = new Client();
                $crawler = $client->request('GET', $this->data->url);

                $crawler->filter($parameter_S)->each(function ($node) {
                        if (!empty($node->text())) {    // از مقادیر خالی گذر می کند
                                array_push($this->tagContent, $node->text());
                        }
                });

                $this->tagContent =
                        empty($this->tagContent)
                        ? "با توجه به سلکتور ({$parameter_S}) انتخاب شده، محتوایی یافت نشد."
                        : $this->tagContent;

                return (object)$this->tagContent;
        }

        private function multiSelector($parameter_S)
        {
                $client = new Client();
                $crawler = $client->request('GET', $this->data->url);

                foreach ($parameter_S as $key => $value) :

                        $_SESSION['counter'] = $value;
                        $this->tagContent[$value] = [];

                        $crawler->filter($value)->each(function ($node) {
                                array_push($this->tagContent[$_SESSION['counter']], $node->text());
                        });

                        $this->tagContent[$value] =
                                empty($this->tagContent[$value])
                                ? "با توجه به سلکتور ({$value}) انتخاب شده، محتوایی یافت نشد."
                                : (object)$this->tagContent[$value];

                endforeach;
                
                return (object)$this->tagContent;
        }

        public function content()
        {
                if (is_string($this->data->selectors)) {
                        return $this->singleSelector($this->data->selectors);
                } elseif (is_object($this->data->selectors)) {
                        return $this->multiSelector($this->data->selectors);
                } else {
                        return 'مقدار برگشتی یک رشته و یا آبجکت نمی باشد';
                }
        }
}
