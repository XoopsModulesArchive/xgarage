<?php
function getCats($gid){
	global $xoopsDB;
	$sql = ("SELECT cid,name FROM " . $xoopsDB->prefix("garage_cats") . " WHERE gid = '$gid' ORDER BY name");
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: getCats($gid)");
		} else {
			$rows = array();
			while($row = $xoopsDB->fetchArray($result)) {
				$rows[] = $row;
			}
			return ($rows);
		}
}
function getName($cid){
	global $xoopsDB;
	$sql = "SELECT name FROM " . $xoopsDB->prefix("garage_cats") . " WHERE cid = $cid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: getName($cid)");
		} else {
			$row = $xoopsDB->fetchArray($result);
			$name = $row['name'];
			return ($name);
		}
}
function addCat($name,$gid) {
	global $xoopsDB;
	$sql = $xoopsDB->query("INSERT INTO ".$xoopsDB->prefix("garage_cats")." VALUES ('','$name','$gid')");
		if (!$result = $sql) {
			exit("$sql > SQL Error in function :: addCat($name,$gid)");
			return 0;
		}else{
			return 1;
		}
}

function moveCat($cid,$gid){
	global $xoopsDB;
	$sql = "UPDATE  " . $xoopsDB->prefix("garage_cats") . " SET gid = $gid WHERE cid = $cid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: moveCat($cid,$gid)");
			return 0;
		} else {
			return 1;
		}
	
}

function check4Content($cid){
	global $xoopsDB;
	$sql = "SELECT  count(*) as count FROM " . $xoopsDB->prefix("garage") . " WHERE cid = $cid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: check4Content($cid)");
			return 0;
		} else {
			$row = $xoopsDB->fetchArray($result);
			return $row['count'];
		}
	
}

function renameCat($cid,$catname){
	global $xoopsDB;
	$sql = "UPDATE  " . $xoopsDB->prefix("garage_cats") . " SET name = '$catname' WHERE cid = $cid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: renameCat($cid,$catname)");
			return 0;
		} else {
			return 1;
		}
}

function approveGarage($gid){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET approved=1 WHERE id = $gid";
		if ( !$result = $xoopsDB->queryF($sql) ) {
			exit("$sql > SQL Error in function :: approveGarage($gid)");
		} else {
			return 1;
		}
}

function disableGarage($gid){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET disabled=1 WHERE id = $gid";
		if ( !$result = $xoopsDB->queryF($sql) ) {
			exit("$sql > SQL Error in function :: disableGarage($gid)");
		} else {
			return 1;
		}
}

function enableGarage($gid){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET disabled=0 WHERE id = $gid";
		if ( !$result = $xoopsDB->queryF($sql) ) {
			exit("$sql > SQL Error in function :: enableGarage($gid)");
		} else {
			return 1;
		}
}
function getActiveGarages(){
	global $xoopsDB;
	$sql = ("SELECT id,name,viewable FROM " . $xoopsDB->prefix("garage") . " WHERE disabled=0 AND approved=1 ORDER BY name");
	$result=$xoopsDB->query($sql);
	$rows = array();
	while($row = $xoopsDB->fetchArray($result)) {
		$rows[] = $row;
	}
	return ($rows);
}

function getNewGarages(){
	global $xoopsDB;
	$sql = ("SELECT id,name FROM " . $xoopsDB->prefix("garage") . " WHERE approved=0 ORDER BY name");
	$result=$xoopsDB->query($sql);
	$rows = array();
	while($row = $xoopsDB->fetchArray($result)) {
		$rows[] = $row;
	}
	return ($rows);
}

function getDisabledGarages(){
	global $xoopsDB;
	$sql = ("SELECT id,name FROM " . $xoopsDB->prefix("garage") . " WHERE disabled=1 ORDER BY name");
	$result=$xoopsDB->query($sql);
	$rows = array();
	while($row = $xoopsDB->fetchArray($result)) {
		$rows[] = $row;
	}
	return ($rows);
}

function adminMenu ($currentoption = 0, $breadcrumb = '')
{
	
	/* Nice buttons styles */
	echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/garage/admin/images/bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/garage/admin/images/left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/garage/admin/images/right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#buttonbar a span {float:none;}
		/* End IE5-Mac hack */
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
	
	// global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
	global $xoopsModule, $xoopsConfig;
	
	$myts =& MyTextSanitizer::getInstance();
	
	$tblColors = Array();
	$tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = '';
	$tblColors[$currentoption] = 'current';
	echo "<div id='buttontop'>";
	echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
	//echo "<td style=\"width: 45%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\"><a class=\"nobutton\" href=\"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoopsModule->getVar('mid') . "\">" . _AM_SCLIENT_OPTS . "</a> | <a href=\"../index.php\">" . _AM_SCLIENT_GOMOD . "</a> | <a href=\"import.php\">" . _AM_SCLIENT_IMPORT . "</a> | <a href='" . smartclient_getHelpPath() ."' target=\"_blank\">" . _AM_SCLIENT_HELP . "</a> | <a href=\"about.php\">" . _AM_SCLIENT_ABOUT . "</a></td>";
	echo "<td style=\"width: 70%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\"><a class=\"nobutton\" href=\"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoopsModule->getVar('mid') . "\">" . _AM_GARAGES_OPTS . "</a> | <a href=\"../index.php\">" . _AM_GARAGES_GOMOD . "</a> | <a href=\"index.php?op=documentation\">" . _AM_GARAGES_DOCS . "</a> | <a href=\"index.php?op=support\">" . _AM_GARAGES_SUPPORT . "</a> | <a href=\"index.php?op=donations\">" . _AM_GARAGES_DONATIONS . "</a></td>";
	echo "<td style=\"width: 30%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>" . $myts->displayTarea($xoopsModule->name()) . " " . _AM_GARAGES_MODADMIN . "</b> " . $breadcrumb . "</td>";
	echo "</tr></table>";
	echo "</div>";
	echo "<div id='buttonbar'>";
	echo "<ul>";
	echo "<li id='" . $tblColors[0] . "'><a href=\"../garage.php?op=add\"><span>" . _AM_GARAGES_ADDNEWGARAGE . "</span></a></li>";
	echo "<li id='" . $tblColors[1] . "'><a href=\"index.php\"><span>" . _AM_GARAGES_INDEX . "</span></a></li>";
	echo "<li id='" . $tblColors[2] . "'><a href=\"index.php?op=view_new\"><span>" . _AM_GARAGES_APPROVE . "</span></a></li>";
	echo "<li id='" . $tblColors[3] . "'><a href=\"index.php?op=view_disabled\"><span>" . _AM_GARAGES_DISABLED . "</span></a></li>";
	echo "<li id='" . $tblColors[4] . "'><a href=\"index.php?op=cats\"><span>" . _AM_GARAGES_CATEGORIES . "</span></a></li>";
	echo "</ul></div>";
}

?>