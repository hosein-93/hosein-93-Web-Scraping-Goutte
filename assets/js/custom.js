// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                }

                form.classList.add('was-validated')
        }, false)
})

// ============================================================
// ============================================================
// ============================================================

// زمانی که خزش بخواهد در لینکی اتفاق بیفتد input را نمایش بدهد
$('input[name="CrawlerStatus"]').click(function (e) {
        var linkSelector = $("#CrawlerLinkSelector");
        var linkSelectorParent = linkSelector.closest("div");
        if (e.target.attributes['data-status']) {
                linkSelectorParent.show(500);
                linkSelector.prop('required', true);
        } else {
                linkSelectorParent.hide(500);
                linkSelector.removeAttr("required");
        }
});

// ============================================================
// ============================================================
// ============================================================
