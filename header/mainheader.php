<!DOCTYPE html>
<html lang="ur">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جامعہ علوم اسلامیہ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- BX Slider CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Noto Nastaliq Urdu', serif; direction: rtl; }
        .top { background: #f8f9fa; padding: 10px 0; }
        .arabic { font-size: 1.5em; margin: 0; }
        .langauge { display: inline-block; margin-left: 15px; }
        .news-ticker { background: #e9ecef; padding: 10px 0; }
        .islam-arkan { padding: 40px 0; }
        .islam-box { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .media { display: flex; margin-bottom: 20px; }
        .media-left { margin-left: 15px; }
        .media img { width: 100px; height: 100px; object-fit: cover; border-radius: 5px; }
        .video-wrapper {
      position: relative;
      width: 100%;
      padding-bottom: 56.25%; /* 16:9 aspect ratio */
      height: 0;
      overflow: hidden;
      background: #000;
    }

    .video-wrapper iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }

    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll("oembed[url]").forEach(function (element) {
        const url = element.getAttribute("url");

        const videoIdMatch = url.match(/(?:youtu\.be\/|youtube\.com\/watch\?v=|youtube\.com\/embed\/)([^&\s]+)/);
        if (videoIdMatch && videoIdMatch[1]) {
          const videoId = videoIdMatch[1];
          const iframe = document.createElement("iframe");
          iframe.setAttribute("src", "https://www.youtube.com/embed/" + videoId);
          iframe.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
          iframe.setAttribute("allowfullscreen", "");

          const wrapper = document.createElement("div");
          wrapper.className = "video-wrapper";
          wrapper.appendChild(iframe);

          element.parentNode.replaceChild(wrapper, element);
        }
      });
    });
  </script>


</head>

<body>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.home-banner').bxSlider({
            auto: true,
            pause: 5000,
            mode: 'fade'
        });
        
        $('.news').bxSlider({
            mode: 'vertical',
            auto: true,
            pause: 4000,
            controls: false
        });
    });
    </script>