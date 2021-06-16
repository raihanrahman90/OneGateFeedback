<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Format date</title>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/jquery-ui/jquery-ui.min.css">
  <script src="../assets/jquery-ui/external/jquery/jquery.js"></script>
  <script src="../assets/jquery-ui/jquery-ui.min.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
      $( "#datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
    $( "#format" ).on( "change", function() {
      $( "#datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yyyy" );
    });
  } );
  </script>
</head>
<body>
 
<p>Date: <input type="text" id="datepicker" size="30"></p>
 
<p>Format options:<br>
  <select id="format">
    <option value="mm/dd/yy">Default - mm/dd/yy</option>
    <option value="yy-mm-dd">ISO 8601 - yy-mm-dd</option>
    <option value="d M, y">Short - d M, y</option>
    <option value="d MM, y">Medium - d MM, y</option>
    <option value="DD, d MM, yy">Full - DD, d MM, yy</option>
    <option value="&apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy">With text - &apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy</option>
  </select>
</p>
 
 
</body>
</html>