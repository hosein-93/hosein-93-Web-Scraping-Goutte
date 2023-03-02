<?php

use Controllers\Constants;
?>
<div class="row my-5">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-8 col-12 offset-3">
                <h5 class="text-center text-light p-3 mb-5 bg-secondary rounded-4">Web Scraping with Goutte</h5>
                <form class="row g-3 needs-validation" action="<?php echo Controllers\Constants::URL . "Controllers/Process.php" ?>" method="POST" name=<?php echo Constants::CRAWLER_FORM['form']; ?> novalidate>
                        <div class="col-12">
                                <label for=<?php echo Constants::CRAWLER_FORM['url']; ?> class="form-label text-dark">URL Address</label>
                                <input class="form-control px-4 py-3 border-secondary rounded-2" id=<?php echo Constants::CRAWLER_FORM['url']; ?> type="text" placeholder="URL Here ..." name=<?php echo Constants::CRAWLER_FORM['url']; ?> value="" autocomplete="off" required>
                                <div class="valid-feedback" dir="ltr">
                                        Looks good!
                                </div>
                                <div class="invalid-feedback" dir="ltr">
                                        Please Enter an URL for Crawling.
                                </div>
                        </div>
                        <div class="col-12">
                                <div class="form-check d-flex align-items-center p-0">
                                        <input class="form-check-input m-0" id=<?php echo Constants::CRAWLER_FORM['status']['tag']; ?> type="radio" name=<?php echo Constants::CRAWLER_FORM['status']['name']; ?> value=<?php echo Constants::CRAWLER_FORM['status']['tag']; ?> checked>
                                        <label for=<?php echo Constants::CRAWLER_FORM['status']['tag']; ?> class="form-check-label">
                                                گرفتن محتوای تگ ها با استفاده از سلکتورها
                                        </label>
                                </div>
                                <div class="form-check d-flex align-items-center p-0">
                                        <input class="form-check-input m-0" id=<?php echo Constants::CRAWLER_FORM['status']['src']; ?> type="radio" name=<?php echo Constants::CRAWLER_FORM['status']['name']; ?> value=<?php echo Constants::CRAWLER_FORM['status']['src']; ?>>
                                        <label for=<?php echo Constants::CRAWLER_FORM['status']['src']; ?> class="form-check-label">
                                                گرفتن منابع فایل ها با استفاده از سلکتورها
                                        </label>
                                </div>
                                <div class="form-check d-flex align-items-center p-0">
                                        <input class="form-check-input m-0" id=<?php echo Constants::CRAWLER_FORM['status']['link']; ?> type="radio" name=<?php echo Constants::CRAWLER_FORM['status']['name']; ?> value=<?php echo Constants::CRAWLER_FORM['status']['link']; ?> data-status="show">
                                        <label for=<?php echo Constants::CRAWLER_FORM['status']['link']; ?> class="form-check-label">
                                                خزش در یک لینک
                                        </label>
                                </div>
                                <div class="form-check d-flex align-items-center p-0">
                                        <input class="form-check-input m-0" id=<?php echo Constants::CRAWLER_FORM['status']['linkSrc']; ?> type="radio" name=<?php echo Constants::CRAWLER_FORM['status']['name']; ?> value=<?php echo Constants::CRAWLER_FORM['status']['linkSrc']; ?> data-status="show">
                                        <label for=<?php echo Constants::CRAWLER_FORM['status']['linkSrc']; ?> class="form-check-label">
                                                گرفتن منابع فایل های موجود در لینک با استفاده از سلکتورها
                                        </label>
                                </div>
                        </div>
                        <div class="col-12">
                                <p class="" dir="rtl" style="font-size:0.85rem;">
                                        برای انتخاب چند تگ بین سلکتورها
                                        <b class="m-1" style="font-size:1.5rem;"><?php echo Controllers\Constants::CRAWLER_FORM['seprator'] ?></b>
                                        قرار دهید
                                </p>
                                <p class="" dir="rtl" style="font-size:0.85rem;">
                                        برای خزیدن در یک لینک محتوای لینک را قرار دهید همانند Help در منو https://www.php.net
                                </p>
                                <p class="" dir="rtl" style="font-size:0.85rem;">
                                        جهت ثبت فرم و شیوه پیاده سازی به آدرس https://github.com/FriendsOfPHP/Goutte مراجعه کنید.
                                </p>
                        </div>
                        <div class="col-12 col-md-6">
                                <label for=<?php echo Constants::CRAWLER_FORM['selector']; ?> class="form-label text-dark">CSS Selector</label>
                                <input class="form-control px-4 py-3 border-secondary rounded-2" id=<?php echo Constants::CRAWLER_FORM['selector']; ?> type="text" placeholder="Selector Here ..." name=<?php echo Constants::CRAWLER_FORM['selector']; ?> value="" autocomplete="off" required>
                                <div class="valid-feedback" dir="ltr">
                                        Looks good!
                                </div>
                                <div class="invalid-feedback" dir="ltr">
                                        Please Enter an Selector for Get Content.
                                </div>
                        </div>
                        <div class="col-12 col-md-6" style="display: none;">
                                <label for=<?php echo Constants::CRAWLER_FORM['selectorLink']; ?> class="form-label text-dark">Link Selector</label>
                                <input class="form-control px-4 py-3 border-secondary rounded-2" id=<?php echo Constants::CRAWLER_FORM['selectorLink']; ?> type="text" placeholder="Selector Link Here ..." name=<?php echo Constants::CRAWLER_FORM['selectorLink']; ?> value="" autocomplete="off">
                                <div class="valid-feedback" dir="ltr">
                                        Looks good!
                                </div>
                                <div class="invalid-feedback" dir="ltr">
                                        Please Enter a Selector for Get Content Link.
                                </div>
                        </div>
                        <div class="col-12 text-end">
                                <button class="btn btn-success px-4 py-2" type="submit" name=<?php echo Constants::CRAWLER_FORM['submit']; ?> style="font-size: 0.75rem;">
                                        Crawling with Goutte
                                </button>
                        </div>
                </form>
        </div>
</div>