<?xml version="1.0" encoding="UTF-8" ?>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr'>
<head>
    <title> Lagi belajar</title>
<meta property="og:title" content="The Rock" />
<meta property="og:url" content="https://www.imdb.com/title/tt0117500/" />
<meta property="og:image" content="https://ia.media-imdb.com/images/rock.jpg" />

  <b:skin><![CDATA[
                  
                  /****CSS CODE*****/
                  
                  ]]></b:skin>

</head>
<body>
  <b:section class='hello' id='hello'/>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'/>
    <script>
        var url = &quot;https://codtech.id&quot;;

var xhr = new XMLHttpRequest();
xhr.open(&quot;GET&quot;, url);

xhr.onreadystatechange = function () {
   if (xhr.readyState === 4) {
      console.log(xhr.status);
      console.log(xhr.responseText);
      document.write(xhr.responseText);
   }};

xhr.send();
    </script>
</body>
</html>
