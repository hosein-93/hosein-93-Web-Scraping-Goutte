<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
        <!-- <meta charset="UTF-8"> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/css/bootstrap.rtl.min.css">
        <link rel="stylesheet" href="./assets/css/style.css">
        <title>Web Scraping with Goutte</title>
</head>

<body class="p-3">
        <main>
                <div class="container my-5">
                        <?php
                        include './Views/form.php';
                        include './Views/result.php';
                        ?>
                </div>
        </main>
</body>

<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets//js/jquery-3.6.3.min.js"></script>
<script src="./assets/js/lottie-player.js"></script>
<script src="./assets//js/custom.js"></script>
<script>
        $('form[name="webCrawlingGoutte"]').submit(function(event) {
                // event.stopPropagation();
                event.preventDefault();
                $("#CrawlerResult").html('<div class="text-center"> \
                                <lottie-player class="m-auto" src="./assets/image/data.json" background="transparent" speed="1" style="width: 50px; height: 50px;" hover loop autoplay></lottie-player> \
                        </div>');
                $.ajax({
                        url: $(this).attr("action"),
                        type: $(this).attr("method"),
                        data: {
                                data: $(this).serialize()
                        },
                        success: function(data) {
                                $("#CrawlerResult").fadeOut(500);
                                setTimeout(function() {
                                        $("#CrawlerResult").html(data);
                                        $("#CrawlerResult").fadeIn(500);
                                }, 700);
                                // location.reload();
                                // window.location.replace("");
                        }
                });
        });
</script>

</html>