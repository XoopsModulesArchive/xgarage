<?php
include_once '../../../include/cp_header.php';
include_once("functions.php");
		xoops_cp_header();
		adminMenu(0, _AM_XG_DOCUMENTATION);
echo "
<h1>Garages Module for XOOPS 2.0 Administration Manual </h1>
<hr />
<br /><br />
<a href=\"docs_credits.php\"><strong>Credits</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"docs_user.php\"><strong>Users</strong></a>
<br /><br />

<p><b>Setting up the Garage Module</b>
<ul>
  <li>Once installed go into the module preferences and set them to your liking.</li>
  <li>If you set it to use categories in the preferences, the next thing you need to do is add your categories.</li>
  <li>After you create the categories you must go to the permissions section of the modules admin and set the permissions by group and category.<br /> There are 2 permissions to set for each category in each group, 'view permissions' and 'submit permissions'.</li>
</ul>
</p><br />

<p><b>Creating Categories</b><br /><br />
<ul>
  <li>Right now there is only one option when creating a category, that is whether or not you want to show the race times in this category. There may be more in the future.</li>
</ul>
</p><br />

<p><b>Setting Permissions</b><br /><br />
<ul>
  <li>If you are using categories you will see a tab for Permissions, click on it.
<br />You will see a drop down box that says view permissions and all the categories you created.
<br />Check the categories you want to have view permissions for each group.</li>
<li>Next you need to change the drop down box so it reads 'submit permissions'.
<br />Check the categories you want to have submit permissions for each group.
</ul>
</p><br />


<p><b>Other admin functions</b><br /><br />
<ul>
  <li>Approving New Garages</li><br>
  <li>Disable Garage</li><br>
  <li>Enable Garage</li><br>
</p>";
xoops_cp_footer();
?>