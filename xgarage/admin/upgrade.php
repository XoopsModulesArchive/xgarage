<?php

include_once '../../../include/cp_header.php';
xoops_cp_header();
include_once XOOPS_ROOT_PATH.'/modules/garage/include/functions.php';


if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
	$errors=0;
	
	// 2.1) Add the new fields to the topic table
	if (!garage_FieldExists('racing',$xoopsDB->prefix('garage_cats'))) {
		garage_AddField("racing TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER name",$xoopsDB->prefix('garage_cats'));
	}
	
    // At the end, if there was errors, show them or redirect user to the module's upgrade page
	if($errors) {
		echo '<H1>' . _AM_XG_UPGRADEFAILED . '</H1>';
		echo '<br />' . _AM_XG_UPGRADEFAILED0;
	} else {
		echo _AM_XG_UPGRADECOMPLETE." - <a href='".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op=update&module=garage'>"._AM_XG_UPDATEMODULE."</a>";
	}
} else {
	printf("<h2>%s</h2>\n",_AM_NEWS_UPGR_ACCESS_ERROR);
}
xoops_cp_footer();
?>
