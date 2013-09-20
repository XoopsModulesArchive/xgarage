<?php
include_once '../../../include/cp_header.php';
include_once("functions.php");

settype($op,"string");
if(!isset($_POST['op']) && isset($_GET['op']) ) {
	$op = $_GET['op'] ;
}
if (!isset($op)) {
	$op = '';
}

//$op = isset($_GET['op']) ? $_GET['op'] : $_POST['op'];
if(!isset($_POST['cid']) && isset($_GET['cid']) ) {
	$cid = intval($_GET['cid']);
}
//$op = isset($_POST['op']) ? $_POST['op'] : '';
//$cid = isset($_GET['cid']) ? $_GET['cid'] : $_POST['cid'];
//$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$pick = isset($_POST['pick']) ? intval($_POST['pick']) : 0;
$statussel = isset($_POST['statussel']) ? intval($_POST['statussel']) : 0;
$sortsel = isset($_POST['sortsel']) ? $_POST['sortsel'] : 'id';
$ordersel = isset($_POST['ordersel']) ? $_POST['ordersel'] : 'DESC';
$gid = isset($_GET['gid']) ? intval($_GET['gid']) : 0;
$self = $_SERVER['PHP_SELF'];



global $xoopsDB, $xoopsUser, $xoopsConfig, $xoopsModuleConfig, $xoopsModule, $cattree;


$myts = &MyTextSanitizer::getInstance();

//echo("Hellow World.");

switch($op){
	case "approve":

		//if($userIsAdmin) {
			$success = approveGarage($gid);
			if($success) redirect_header(xoops_getenv('HTTP_REFERER'),2,_AM_APPROVESUCCESS);
			else redirect_header(xoops_getenv('HTTP_REFERER'),2,_AM_APPROVEFAILURE);
		//}
	
	break;

	case "disable":
		//if($userIsAdmin) {
			$success = disableGarage($gid);
			if($success) redirect_header(xoops_getenv('HTTP_REFERER'),2,_AM_GARAGEDISABLED);
			else redirect_header(xoops_getenv('HTTP_REFERER'),2,_AM_DISBALEFAILURE);
		//} redirect_header("index.php",2,_MD_XG_MUSTLOGADMIND);
	break;

	case "enable":
		//if($userIsAdmin) {
			$success = enableGarage($gid);
			if($success) redirect_header(xoops_getenv('HTTP_REFERER'),2,_AM_GARAGEENABLED);
			else redirect_header(xoops_getenv('HTTP_REFERER'),2,_AM_ENBALEFAILURE);
		//} redirect_header("index.php",2,_MD_XG_MUSTLOGADMINE);
	break;

	case "delgarage":
		
		
		//verify delete
			if (isset($_GET['gid'])) {
				$gid = $_GET['gid'];
			}
			if (isset($_POST['gid'])) {
				$gid = $_POST['gid'];
			}
			if (isset($_POST['subop'])) {
				$subop = $_POST['subop'];
			}
			if ($subop == "delok") {
				
				$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("garage"), $gid);
				
				if ($xoopsDB->query($sql)) {
					// delete comments for the garage being deleted
					xoops_comment_delete($xoopsModule->getVar('mid'), $gid);
					redirect_header("index.php", 3, _AM_ITEMDELETED);
					//echo "deleted";
				} else {
					redirect_header("index.php", 3, _AM_ITEMNOTDELETED);
					//echo "not deleted";
				} 
			} // end if
			else {
				xoops_cp_header();
				adminMenu(1, _AM_GARAGES_INDEX);
				echo "<div style='height:25px;'>&nbsp;</div>";
				xoops_confirm(array('op' => 'delgarage', 'gid' => $gid, 'subop' => 'delok'), 'index.php', _AM_CONFIRMDELETE);
			}
			echo "</p>";
		break;


	case "view_new":
		xoops_cp_header();
		adminMenu(2, _AM_GARAGES_APPROVE);
		//get list of all diabled garage
		$names = getNewGarages();
		
		//print them out with links
		if(count($names) > 0)
			for($x=0;$x<count($names);$x++){
				echo("<div style=\"margin-left:100px;\"><a href=\"../index.php?op=view&gid=".$names[$x]['id']."\">".$names[$x]['name']."</a></div>");
			}
		else echo "<div>"._AM_NONENEW."</div>";
		break;
	
	case "view_disabled":
		xoops_cp_header();
		adminMenu(3, _AM_GARAGES_DISABLED);
		//get list of all diabled garage
		$names = getDisabledGarages();
		
		//print them out with links
		if(count($names) > 0)
			for($x=0;$x<count($names);$x++){
				echo("<div style=\"margin-left:100px;\"><a href=\"../index.php?op=view&gid=".$names[$x]['id']."\">".$names[$x]['name']."</a></div>");
			}
		else echo("<div>"._AM_NONEDISABLED."</div>");
		break;
	case "add_cat":
		//echo("testing123");
		//adminMenu(4, _AM_GARAGES_CATEGORIES);
		if($_POST['catname']) {
			$success = addCat($_POST['catname'],$_POST['gid']);
			if ($success) {
				redirect_header("index.php?op=cats&amp;cid=$cid", 1, _AM_CATEGORYADDED);
				exit;
			} else {
			redirect_header("index.php?op=cats&amp;cid=$cid", 5, _AM_CATEGORYADDERROR);
			}
		}
		break;
	case "move_cat":
		//echo("testing123");
		//adminMenu(4, _AM_GARAGES_CATEGORIES);
		if($_POST['gid'] != $_POST['cid']){
			include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
			$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");
			$children = $cattree->getChildTreeArray($_POST['cid']);
			//var_dump($children);
			foreach($children as $child){
				$cc[] = $child['cid'];
			}
			if(!in_array($_POST['gid'],$cc)){
				$success = moveCat($_POST['cid'],$_POST['gid']);
				if($success){
					redirect_header("index.php?op=cats&cid=$cid", 1, _AM_CATEGORYMOVED);
					exit;
				} else redirect_header("index.php?op=cats&cid=$cid", 1, _AM_CATEGORYMOVEERROR);
			} else redirect_header("index.php?op=cats&cid=$cid", 1, _AM_CATEGORYMOVEINTO);
		} else redirect_header("index.php?op=cats&cid=$cid", 1, _AM_MOVENO);
		
		break;
	case "rename_cat":
		//echo("testing123");
		//adminMenu(4, _AM_GARAGES_CATEGORIES);
		$success = renameCat($_POST['cid'],$_POST['catname']);
		if($success){
			redirect_header("index.php?op=cats&cid=$cid", 1, _AM_CATEGORYRENAMED);
			exit;
		} else redirect_header("index.php?op=cats&cid=$cid", 1, _AM_CATEGORYRENAMEERROR);
		break;
		
	case "del_cat":
	
		
		//verify delete
			
			if (isset($_POST['cid'])) {
				$cid = $_POST['cid'];
			}
			if (isset($_POST['subop'])) {
				$subop = $_POST['subop'];
			}
			if (isset($subop) && $subop == "delok") {
				//get all cats

				include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
				$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");
				$cats = $cattree->getChildTreeArray($cid,"name");
				$WHERE = "WHERE cid = $cid";
				foreach($cats as $cat){
					$WHERE .= " OR cid=".$cat['cid'];
				}
				
				$sql = sprintf("DELETE FROM %s %s", $xoopsDB->prefix("garage_cats"), $WHERE);
				
				if ($xoopsDB->query($sql)) {
					// delete comments for the garage being deleted
					//xoops_comment_delete($xoopsModule->getVar('mid'), $gid);
					redirect_header("index.php", 3, _AM_CATDELETED);
					//echo "deleted";
				} else {
					redirect_header("index.php", 3, _AM_CATNOTDELETED);
					//echo "not deleted";
				} 
			} // end if
			else {
				include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
				$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");
				$cats = $cattree->getChildTreeArray($cid,"name");
				$catlist[] = getName($cid);
				$content = 0;
				$c = check4Content($cid);
				$content = $content + $c;
				
				foreach($cats as $cat){
					$c = check4Content($cat['cid']);
					$content = $content + $c;
					$catlist[] = getName($cat['cid']);
				}
				if($content){
					$msg = sprintf(_AM_CONTENTEXISTS,$content);
					redirect_header("index.php?op=cats&cid=$cid", 5, $msg);
					exit;
				} else {
					xoops_cp_header();
					adminMenu(4, _AM_GARAGES_CATEGORIES);
					echo("<div style='height:25px;'>&nbsp;</div>");

					$clist = join($catlist,", ");
					$delmsg = _AM_CONFIRMDELCATS."<br/>".$clist;
					xoops_confirm(array('op' => 'del_cat', 'cid' => $cid, 'subop' => 'delok'), 'index.php', $delmsg);
				}
			}	
		break;
		
	case "cats":
		xoops_cp_header();
		adminMenu(4, _AM_GARAGES_CATEGORIES);
		include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
	
		$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");
		
		if(!$cid) $cid = '0';
		$path = $cattree->getNicePathFromId($cid, "name", $self."?op=cats");
		echo "<a href='index.php?op=cats&cid=0'><img src='../images/icons/index.png' align='middle' title='"._AM_GARAGES_INDEX."' alt='"._AM_GARAGES_INDEX."'></a> ".$path;

		$cats = getCats($cid);
		//echo("<table width='100%' align='center'>");
		//echo("");
		//echo("<form method='post'>");
		for($x=0;$x < count($cats);$x++){
			//echo("<div style='left-margin:50px;'><input type='checkbox' name='cats[]' value='".$cats[$x]['cid']."'><a href='index.php?op=cats&cid=".$cats[$x]['cid']."'>".$cats[$x]['name']."</a></div>");
			echo("<div style='left-margin:50px;'><a href='index.php?op=cats&cid=".$cats[$x]['cid']."'>".$cats[$x]['name']."</a></div>");
		}
		//echo("<input type='hidden' name='op' value='delcats'>");
		//echo("<input type='submit' value='"._AM_DELETE."'>");
		//echo("</form>");
		//echo("</table>");
		// add new cat
		echo("<div style='padding:10px;width:50%;text-align:right;background-color:#cccccc;border-right: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>");
		echo("<form method='post' action='index.php'>");
			echo(""._AM_NEWCATNAME."<input type='text' name='catname'><br/>"._AM_PARENT);
			$cattree->makeMySelBox("name","",$cid, true,"gid");
			echo("<input type='hidden' name='cid' value='$cid' />");
			echo("<input type='hidden' name='op' value='add_cat' />");
			echo("<br/><input type='submit' value='"._AM_ADDNEWCAT."' />");
		echo("</form>");
		echo("</div>");
		echo("<br/>");
		
		if($cid){
			echo("<div style='padding:10px;width:50%;text-align:right;background-color:#cccccc;border-right: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>");
			echo("<form method='post' action='index.php'>");
				echo(""._AM_MOVECAT."<br/>"._AM_PARENT."");
				$cattree->makeMySelBox("name","",$cid,true,"gid");
				echo("<input type='hidden' name='cid' value='$cid'>");
				echo("<input type='hidden' name='op' value='move_cat'>");
				echo("<br/><input type='submit' value='"._AM_MOVECATSUBMIT."'>");
			echo("</form>");
			echo("</div>");
			echo("<br/>");
			echo("<div style='padding:10px;width:50%;text-align:right;background-color:#cccccc;border-right: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>");
			echo("<form method='post' action='index.php'>");
				echo(_AM_RENAMECAT);
				$catname = getName($cid);
				echo("<input type='text' name='catname' value='$catname'>");
				echo("<input type='hidden' name='cid' value='$cid'>");
				echo("<input type='hidden' name='op' value='rename_cat'>");
				echo("<br/><input type='submit' value='"._AM_RENAME."'>");
			echo("</form>");
			echo("</div>");
			echo("<br/>");
			echo("<div style='padding:10px;width:50%;text-align:right;background-color:#cccccc;border-right: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-bottom: 1px solid #000000;'>");
			echo("<form method='post' action='index.php'>");
				echo(_AM_DELETECAT);
				$catname = getName($cid);
				echo(" $catname");
				echo("<input type='hidden' name='cid' value='$cid'>");
				echo("<input type='hidden' name='op' value='del_cat'>");
				echo("<br/><input type='submit' value='"._AM_DELETE."'>");
			echo("</form>");
			echo("</div>");
		}
		break;
	case "documentation":
		xoops_cp_header();
		adminMenu(5, _AM_GARAGES_DOCUMENTATION);

		echo("<div style='text-align:center;'>"._AM_DOCS."<br/><br/><br/>");

		echo("<br/><br/><br/><a href='http://www.xgarage.org'>Live Docs and support at X-Garage</a>");
		
		
		echo("</div>");
		
		break;
	
	case "support":
		xoops_cp_header();
		adminMenu(5, _AM_GARAGES_SUPPORT);
		
		echo("<div style='text-align:center;'>"._AM_SUPPORT."<br/><br/><br/>"._AM_SUPPORT_REGISTERED);
		
		echo("<br/><br/><br/><a href='http://www.xgarage.org/modules/newbb/'>Garages Module for XOOPS Support Forum</a>");
		
		
		echo("</div>");
		
		break;
	
	case "donations":
		xoops_cp_header();
		adminMenu(6, _AM_GARAGES_DONATIONS);
		
		echo "<div style='text-align:center;'>"._AM_INTRO."<br/><br/><br/>";
		
		echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-butcc-donate.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
</form>';
		
		
		
		
		break;
	
	default:
		xoops_cp_header();
		adminMenu(1, _AM_GARAGES_INDEX);
		
		$names = getActiveGarages();
		if(count($names) > 0)
			for($x=0;$x<count($names);$x++){
				if($names[$x]['viewable']) $viewable="color:#000000;";
				else $viewable="color:#cccccc;";
				echo "<div style=\"margin-left:100px;\"><a style='$viewable' href=\"../index.php?op=view&gid=".$names[$x]['id']."\">".$names[$x]['name']."</a></div>";
			}
		else echo "<div>"._AM_NONEACTIVE."</div>";
		break;
		
}
xoops_cp_footer();
?>