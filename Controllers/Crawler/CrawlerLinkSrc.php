<?php

namespace Controllers\Crawler;

use Controllers\Crawler\Crawler;

use Goutte\Client;      // مرتبط با کتابخانه goutte

final class CrawlerLinkSrc extends Crawler
{
        private function singleSelector_singleLink($parameter_S, $parameter_L)
        {
                $client = new Client();
                $crawler = $client->request('GET', $this->data->url);

                $link = $crawler->selectLink($parameter_S)->link();
                $crawlerNew = $client->click($link);
                $crawlerNew->filter($parameter_L)->each(function ($node) {
                        array_push($this->linkContent, $node->attr('src'));
                });

                $this->linkContent =
                        empty($this->linkContent)
                        ? "در لینک ({$parameter_S}) هدف، با توجه به سلکتور ({$parameter_L}) انتخاب شده منابعی یافت نشد."
                        : $this->linkContent;

                return (object)$this->linkContent;
        }

        private function singleSelector_multiLink($parameter_S, $parameter_L)
        {
                $client = new Client();
                $crawler = $client->request('GET', $this->data->url);

                $crawlerNew = [];

                foreach ($parameter_L as $key => $value) :

                        $_SESSION['counter'] = $value;
                        $this->linkContent[$value] = [];

                        $link[$key] = $crawler->selectLink($this->data->selectors)->link();
                        $crawlerNew = $client->click($link[$key]);
                        $crawlerNew->filter($value)->each(function ($node) {
                                array_push($this->linkContent[$_SESSION['counter']], $node->attr('src'));
                        });

                        $this->linkContent[$value] =
                                empty($this->linkContent[$value])
                                ? "در لینک ({$parameter_S}) هدف، با توجه به سلکتور ({$value}) انتخاب شده منابعی یافت نشد."
                                : (object)$this->linkContent[$value];
                endforeach;

                return (object)$this->linkContent;
        }

        private function multiSelector_singleLink($parameter_S, $parameter_L)
        {
                $client = new Client();
                $crawler = $client->request('GET', $this->data->url);

                foreach ($parameter_S as $key => $value) :

                        $_SESSION['counter'] = $value;
                        $this->linkContent[$value] = [];

                        $link = $crawler->selectLink($value)->link();
                        $crawlerNew = $client->click($link);
                        $crawlerNew->filter($parameter_L)->each(function ($node) {
                                array_push($this->linkContent[$_SESSION['counter']], $node->attr('src'));
                        });

                        $this->linkContent[$value] =
                                empty($this->linkContent[$value])
                                ? "در لینک ({$value}) هدف، با توجه به سلکتور ({$parameter_L}) انتخاب شده منابعی یافت نشد."
                                : (object)$this->linkContent[$value];

                endforeach;

                return (object)$this->linkContent;
        }


        private function multiSelector_multiLink($parameter_S, $parameter_L)
        {
                $client = new Client();
                $crawler = $client->request('GET', $this->data->url);

                foreach ($parameter_S as $key => $value) :

                        $_SESSION['counter'] = $value;
                        $this->linkContent[$value] = [];

                        $link = $crawler->selectLink($value)->link();
                        $crawlerNew = $client->click($link);

                        foreach ($parameter_L as  $keyLink => $valueLink) :

                                $_SESSION['counterLink'] = $valueLink;
                                $this->linkContent[$value][$valueLink] = [];

                                $crawlerNew->filter($valueLink)->each(function ($node) {
                                        array_push($this->linkContent[$_SESSION['counter']][$_SESSION['counterLink']], $node->attr('src'));
                                });

                                $this->linkContent[$value][$valueLink] =
                                        empty($this->linkContent[$value][$valueLink])
                                        ? "در لینک هدف ({$value}) ، با توجه به سلکتور ({$valueLink}) انتخاب شده منابعی یافت نشد."
                                        : (object)$this->linkContent[$value][$valueLink];

                        endforeach;

                        $this->linkContent[$value] =
                                empty($this->linkContent[$value])
                                ? "در لینک هدف ({$value}) ، منابعی یافت نشد."
                                : (object)$this->linkContent[$value];

                endforeach;

                return (object)$this->linkContent;
        }

        public function content()
        {
                if (is_string($this->data->selectors) && is_string($this->data->selectorLinks)) {
                        return $this->singleSelector_singleLink($this->data->selectors, $this->data->selectorLinks);
                } elseif (is_string($this->data->selectors) && is_object($this->data->selectorLinks)) {
                        return $this->singleSelector_multiLink($this->data->selectors, $this->data->selectorLinks);
                } elseif (is_object($this->data->selectors) && is_string($this->data->selectorLinks)) {
                        return $this->multiSelector_singleLink($this->data->selectors, $this->data->selectorLinks);
                } elseif (is_object($this->data->selectors) && is_object($this->data->selectorLinks)) {
                        return $this->multiSelector_multiLink($this->data->selectors, $this->data->selectorLinks);
                } else {
                        return 'مقدار برگشتی یک رشته و یا آبجکت نمی باشد';
                }
        }
}
