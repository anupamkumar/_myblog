<!DOCTYPE html>
<html>
<head>
  <title>Forex Exchange Rates Map</title>
  <link rel="stylesheet" href="jquery-jvectormap-2.0.1.css" type="text/css" media="screen"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="jquery-jvectormap-2.0.1.min.js"></script>
  <script src="jquery-jvectormap-world-mill-en.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" media="screen"/>
  <link href="assets/img/cringe.ico" rel="icon">
</head>
<body>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>  
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <script src="myData.js"></script>
<section class="container">  
  <div class="content row" id="showing"><h3>Showing value of One <b id="cur">US Dollar</b> across the world</h3></div>  
  <div class="content row" id="world-map" style="width: 1200px; height: 800px"></div>
  <div class="content row" id="controls"><h4>Select a currency:</h4><select id="curlist" class="form-control"></select></div>
  <script>
  var stdata;
  var rates;
  var asks;
  var bids;
  var cnames;  
  var basecur;
  $.ajax({
    url: "load.php",
    cache: false,
    success: function(html){      
      $("#curlist").append(html);
      $('#curlist option[value=USD]').attr('selected',true);      
      $.ajax({
        url: "getstdata.php?bc=US",
        cache: false,
        success: function(res) {          
          stdata=jQuery.parseJSON( res );;          
          rates = stdata.rates;    
          asks = stdata.ask;
          bids = stdata.bid;
          cnames = stdata.cname;     
          basecur = stdata.base; 
          refreshmap();
        }
      });
    }
  });    
  $( "#curlist" ).change(function() {
    $.ajax({
        url: "getstdata.php?bc="+$('#curlist').val(),
        cache: false,
        success: function(res) {          
          stdata=jQuery.parseJSON( res );; 
          rates = stdata.rates;           
          $('#cur').empty();
          $('#cur').append($('#curlist option:selected').text());
          refreshmap();
        }
      });
  });

  function clickUpdate(code) {         
    $( "div" ).remove( ".jvectormap-tip" );
    $.ajax({
        url: "getstdata.php?bc="+code,
        cache: false,
        success: function(res) {          
          stdata=jQuery.parseJSON( res );; 
          rates = stdata.rates;    
          asks = stdata.ask;
          bids = stdata.bid;
          cnames = stdata.cname;     
          basecur = stdata.base;      
          $('#cur').empty();
          $('#cur').append(basecur);
          refreshmap();
        }
      });
  }
  
  function refreshmap() {  
  $('#world-map').empty();     
  $('#world-map').vectorMap({
      map: 'world_mill_en',
      series: {
        regions: [{
          values: rates,
          scale: ['#f5f5dc', '#8b7d6b'],
          normalizeFunction: 'polynomial'
        }]
      },
      onRegionTipShow: function(e, el, code){
        el.html(el.html() + ' <br/>Rate:'+rates[code] +' <small><small>'+cnames[code]+'</small></small><br/>Ask:'+asks[code]+' <small><small>'+cnames[code]+'</small></small><br/>Bid:'+bids[code]+' <small><small>'+cnames[code]+'</small></small>');
        
      },
      onRegionClick: function(e, code) {   
        clickUpdate(code);
      },
    });
    
  } 
  </script>
  </section>
</body>
</html>