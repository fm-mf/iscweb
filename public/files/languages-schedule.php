<?php
//Set no caching. See: http://james.cridland.net/code/caching.html
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
 <title>ESN Language Courses Schedule</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="languages-schedule.css">
 </head>

<body>

<h3>ESN Language Courses</h3>
<p>Erasmus Student Network CTU in Prague offers, among many other activities, language courses. The courses are taught by native speakers - Erasmus and exchange students, Czech students and foreigners living in Prague. They are free of charge, fun, and no registration is needed. The courses usually begin in the 3rd week of semester. For more information visit the <a href="https://www.esn.cvut.cz/activities/language-programs#content">ESN Languages homepage</a>.</p>
<h4>Where can you find our rooms?</h4>
<ul>
<li><b>B305</b> is located on the 3rd floor of the <a href="https://goo.gl/maps/1h6dDpSfseR2" target="_blank">Masarykova dormitory</a> near ESN Point.
<li><b>R404</b> is located on the 4th floor of the <a href="https://goo.gl/maps/1h6dDpSfseR2" target="_blank">Masarykova dormitory</a>, same place as ESN Point, just one floor higher.
<li><b>Strahov room</b> is located on the 2nd floor in <a href="https://goo.gl/maps/R2wgZidRQ922" target="_blank">block 8</a> (mezzanine), near stairs.
</ul>

<?php
	echo file_get_contents('https://www.esn.cvut.cz/languages/schedule.htm');
?>

</body>
</html>
