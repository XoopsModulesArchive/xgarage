<?php
include_once '../../../include/cp_header.php';
include_once("functions.php");
		xoops_cp_header();
		adminMenu(0, _AM_XG_DOCUMENTATION);

echo "<h1>Garages Module for XOOPS 2.0 User's Manual </h1>
<hr>
<br /><br />
<a href=\"docs_credits.php\"><strong>Credits</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"docs_admin.php\"><strong>Administration</strong></a>
<br /><br />

<p>Add new garage: </p>
<p>Name and Description are required.<br>
  To upload an image, edit your garage afer its adde, if site allows image uploads. </p>
<p>Edit Garage:</p>
<p>In some web sites, changes must be requested.</p>
<p>&nbsp;  </p>";
echo("</div>");
xoops_cp_footer();
?>