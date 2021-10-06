
        // Second JS
        function sendJson() {

            let settings = {
                // Sesuaikan url dengan REST API
                "url": "http://localhost/cdtmember/api/sendtracking/" + frameid + "/?key=DAp2GwaOhI",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": data
            };

            $.ajax(settings).done(function(response) {
                let row = response.data.track
                console.log(row);
                $('.cdt-keyword').html(row.hidden_key);
                
       
                $('#fbx').append(`
                      
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
        }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        //Insert Your Facebook Pixel ID below. 
        fbq('init', '${row.fbpx1}');
        fbq('init', '${row.fbpx2}');
        fbq('track', 'PageView');
        fbq('trackCustom', 'Prelander');
    
    `); // tutup fb
                $('#fbx').after(` <noscript>
                <img class="img-fb" height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=${row.fbpx1}&ev=PageView&noscript=1" />
                <img class="img-fb" height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=${row.fbpx2}&ev=PageView&noscript=1" />
            </noscript>
`);
                // tutup fungsi json
            });



        }

