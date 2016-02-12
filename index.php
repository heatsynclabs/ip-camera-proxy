<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
  <script type="text/javascript" src="jquery-2.2.0.min.js"></script>
  <script type="text/javascript">
    function refresh() {
      document.getElementById("livestream1").src = "snapshot.php?camera=1&"+Math.round(Math.random()*1000000);
      document.getElementById("livestream2").src = "snapshot.php?camera=2&"+Math.round(Math.random()*1000000);
      document.getElementById("livestream3").src = "snapshot.php?camera=3&"+Math.round(Math.random()*1000000);
      document.getElementById("livestream4").src = "snapshot.php?camera=4&"+Math.round(Math.random()*1000000);
    }
    function pageLoad() {
      setInterval( "refresh()", 10000 );
    }

    $.getJSON("https://members.heatsynclabs.org/macs.json", function(data){
      $("#computerlist").html("<ul></ul>");
      $.each(data, function(i, o){
        if (o.note.startsWith("@")) {
          $("#computerlist ul").append("<li><a href='https://twitter.com/"+o.note.substr(1)+"'>"+o.name+" ("+o.note+")</a></li>");
        } else if (o.note.length > 0) {
          $("#computerlist ul").append("<li>"+o.name+" ("+o.note+")</li>");
        } else {
          $("#computerlist ul").append("<li>"+o.name+"</li>");
        }
      });
    });
  </script>
  <style type="text/css">
    body { background-color: #2C2C29; color: #2C2C29; font-family: Tahoma; font-size: 11px; margin: 0; padding: 0; }

    #wrapper { width: 811px; margin: 0 auto; }
    #top span { display: none; }
    #content { background-color: #fff; padding: 1em; font-size: 1.2em; }
    #chatbox { position: absolute; top: 0px; right: 0px; }

    .caption {
      background-color: #F3F3F3;
      border: 1px solid #DDD;
      padding: 4px;
      margin: 0 0 0 30px;
      width: 320px;
      display: inline-block;
    }
    
    .footer {
      clear: both;
    }

    h2 {
      font-family: Helvetica, Georgia;
      font-size: 24px;
      letter-spacing: -1px;
      margin: 10px 0px 3px;
      border-bottom: 1px solid #DCDCDB;
    }
  </style>
</head>

<body onLoad="pageLoad()">
<div id="wrapper">
  <a href="http://www.heatsynclabs.org"><img src="hsl-logo.png" height="116" /></a>

  <div id="content">
    <h2>HeatSync Labs Live Webcams</h2>
    <p>See if there are people in the lab!<br/>The camera views refresh at least every 10 seconds, though you may not be able to tell if nothing's moving.<br/> 
    If the cameras are broken, please tweet @willbradley or email will at heatsynclabs dot org.</p>
    <p>Nobody here? Check the <a href="http://twitter.com/heatsyncstatus">HeatSyncStatus</a> feed. See when the next event is scheduled at the <a href="http://www.heatsynclabs.org">HeatSync Website</a>.</p>

    <div class="caption">
      <img id="livestream1" src="snapshot.php?camera=1" width="320" height="240" />
    </div>

    <div class="caption">
      <img id="livestream2" src="snapshot.php?camera=2" width="320" height="240" />
    </div>

    <div class="caption">
      <img id="livestream3" src="snapshot.php?camera=3" width="320" height="240" />
    </div>

    <div class="caption">
      <img id="livestream4" src="snapshot.php?camera=4" width="320" height="240" />
    </div>

    <h2>Who's Here?</h2>
    <p id="computerlist"></p>
    <i>To add your computer, go to <a href="https://members.heatsynclabs.org/macs">https://members.heatsynclabs.org/macs</a></i>

  </div>

</div>
</body>
</html>
