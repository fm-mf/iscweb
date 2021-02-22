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
 <title>ISC Language Courses Schedule</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="languages-schedule.css">
 </head>

<body>

<h3>ISC Language Courses</h3>
<p>International Student Club CTU in Prague offers, among many other activities, language courses. The courses are taught by native speakers - Erasmus and exchange students, Czech students and foreigners living in Prague. They are free of charge, fun, and no registration is needed. The courses usually begin in the 3rd week of semester. For more information visit the <a href="https://www.isc.cvut.cz/activities/language-programs#content">ISC Languages homepage</a>.</p>
<h4>Where can you find our rooms?</h4>
<ul>
<li><b>B305</b> is located on the 3rd floor of the <a href="https://goo.gl/maps/1h6dDpSfseR2" target="_blank">Masarykova dormitory</a> near ISC Point.
<li><b>R404</b> is located on the 4th floor of the <a href="https://goo.gl/maps/1h6dDpSfseR2" target="_blank">Masarykova dormitory</a>, same place as ISC Point, just one floor higher.
<li><b>Strahov room</b> is located on the 2nd floor in <a href="https://goo.gl/maps/R2wgZidRQ922" target="_blank">block 8</a> (mezzanine), near stairs.
</ul>
<p>
	<strong>Currently, the classes are taught online until the restrictions are lifted. Clicking on any of the classes will let you send an email to the teacher. Contact them so they know about you and can send you a link to the class and share with you any necessary materials.</strong>
</p>

<?php
	echo file_get_contents('https://www.isc.cvut.cz/languages/schedule.htm');
?>

</body>
</html>
