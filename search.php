<?php include '_/common_html/head.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function showResult(str) {
          if (str.length == 0) {
            document.getElementById("livesearch").innerHTML = "";
            document.getElementById("livesearch").style.border = "0px";
            return;
          }
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("livesearch").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET", "_/search/livesearch.php?s=" + str, true);
          xmlhttp.send();
        }
    </script>
    <link rel="stylesheet" href="_/search/search.css">

    <title>Search</title>
</head>
  <body>

    <?php include '_/common_html/nav.php'; ?>

<br><br><br><br><br><br>

    <div class="container">
      <input
        type="search"
        class="form-control"
        id="search-box"
        placeholder="what are you looking for?"
        onkeyup="showResult(this.value)"
      />
  
    <div id="livesearch" class="bg-light">
      <!-- THIS WILL CONTAIN THE SEARCH RESULTS GENERATED BY PHP -->
    </div>


    </div>
    <script>
      // opens and closes the search bar 
      $(".search-button").click(function () {
        $(this).parent().toggleClass("open");
      });
    </script>

    <style>
    /* adjust font size of nav bar links */
    .display-4{
      font-size : 12px !important;
    }
    </style>
  </body>
</html>
