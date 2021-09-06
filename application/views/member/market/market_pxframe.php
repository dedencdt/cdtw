<!-- <!DOCTYPE html>
<html>

<head>
    <meta name="robots" content="noindex"> -->

<!-- Facebook Pixel Code -->
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?= $row != '' ? $row->fbpx1 : null ?>');
    <?php if (isset($row->fbpx2)) : ?>
        fbq('init', '<?= $row != '' ? $row->fbpx2 : null ?>');
    <?php endif; ?>
    fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= $row != '' ? $row->fbpx1 : null ?>&ev=PageView&noscript=1" />
    <?php if (isset($row->fbpx2)) : ?>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= $row != '' ? $row->fbpx2 : null ?>&ev=PageView&noscript=1" />
    <?php endif; ?>
</noscript>
<!-- End Facebook Pixel Code
</head>

<body></body>

</html> -->