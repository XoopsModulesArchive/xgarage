<?php
//if (!defined('XOOPS_XMLRPC')) define('XOOPS_XMLRPC', 1);

require('header.php');
require(XOOPS_ROOT_PATH.'/header.php');

include("include/functions.php");

settype($op,"string");
settype($uid,"integer");
settype($garage,"array");
settype($itemTotal,"string");
$self = $_SERVER['PHP_SELF'];
global $xoopsModuleConfig;
global $xoopsUser;

$userIsAdmin = userIsAdmin($xoopsUser);

$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$gid = isset($_GET['gid']) ? intval($_GET['gid']) : 0;
if(isset($_GET['op'])) $op = $_GET['op'];
if(isset($_POST['op'])) $op = $_POST['op'];
if(isset($_GET['subop'])) $subop = $_GET['subop'];
if(isset($_POST['subop'])) $subop = $_POST['subop'];

switch ($op){

	case "view":
		$xoopsOption['template_main'] = "view_garage.html";
		if($gid){
			$garage = getGarage($gid);
			if($garage['imagechoice']) $garage['image'] = "[img align=right]". XOOPS_UPLOAD_URL. "/" . "garage/".$garage['uploadimage']."[/img]";
		}
		$myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object
		$garage['mengine'] = $myts->displayTarea($garage['mengine'], 0, 1, 1, 1, 1);
		$garage['mexterior'] = $myts->displayTarea($garage['mexterior'], 0, 1, 1, 1, 1);
		$garage['minterior'] = $myts->displayTarea($garage['minterior'], 0, 1, 1, 1, 1);
		$garage['mrims'] = $myts->displayTarea($garage['mrims'], 0, 1, 1, 1, 1);
		$garage['maudio'] = $myts->displayTarea($garage['maudio'], 0, 1, 1, 1, 1);
		$garage['mfuture'] = $myts->displayTarea($garage['mfuture'], 0, 1, 1, 1, 1);
		$garage['descript2'] = $myts->displayTarea($garage['descript2'], 0, 1, 1, 1, 1);
		if($garage['descript2']){
			if($subop == "more") $xoopsTpl->assign('showmore', true);
			else $xoopsTpl->assign('more', _MD_XG_MORE);
		} 
		$garage['image'] = $myts->displayTarea($garage['image'], 0, 0, 1, 1, 0);
		$garage['location'] = $myts->displayTarea($garage['location'], 0, 0, 0, 0, 0);
		$garage['make'] = $myts->displayTarea($garage['make'], 0, 0, 0, 0, 0);
		$garage['model'] = $myts->displayTarea($garage['model'], 0, 0, 0, 0, 0);
		$garage['year'] = $myts->displayTarea($garage['year'], 0, 0, 0, 0, 0);
		$garage['engine'] = $myts->displayTarea($garage['engine'], 0, 0, 0, 0, 0);
		$garage['color'] = $myts->displayTarea($garage['color'], 0, 0, 0, 0, 0);
		$garage['rt'] = $myts->displayTarea($garage['rt'], 0, 0, 0, 0, 0);
		$garage['sixty'] = $myts->displayTarea($garage['sixty'], 0, 0, 0, 0, 0);
		$garage['three'] = $myts->displayTarea($garage['three'], 0, 0, 0, 0, 0);
		$garage['eigth'] = $myts->displayTarea($garage['eigth'], 0, 0, 0, 0, 0);
		$garage['eigthm'] = $myts->displayTarea($garage['eigthm'], 0, 0, 0, 0, 0);
		$garage['thou'] = $myts->displayTarea($garage['thou'], 0, 0, 0, 0, 0);
		$garage['quart'] = $myts->displayTarea($garage['quart'], 0, 0, 0, 0, 0);
		$garage['quartm'] = $myts->displayTarea($garage['quartm'], 0, 0, 0, 0, 0);
		$garage['list'] = $myts->displayTarea($garage['list'], 0, 0, 0, 0, 0);
		if($garage['list']){
			if($xoopsModuleConfig['listformat']) {
				$garage['list2'] = explode(",",$garage['list']);
				foreach($garage['list2'] as $item){
					$items[] = trim($item);
				}
				$garage['list'] = $items;
			}
		}
		$xoopsTpl->assign('listformat', $xoopsModuleConfig['listformat']);
		
		if($userIsAdmin == 0){
			if($garage['approved'] == 0){
				redirect_header("index.php",2,_MD_XG_NOTAPPROVEDYET);
				exit;
			}
			if($garage['viewable'] == 0 && $uid != $garage['uid']){
				redirect_header("index.php",2,_MD_XG_NOTVIEWABLE);
				exit;
			}
			if($garage['disabled'] == 1){
				redirect_header("index.php",2,_MD_XG_DISABLED);
				exit;
			}
		}
		
		if(($uid == $garage['uid'] && $xoopsModuleConfig['canuseredit']) || ($xoopsModuleConfig['canadminsedit'] && $userIsAdmin)){
			$xoopsTpl->assign('panel', true);
			$xoopsTpl->assign('editgarage',_MD_XG_EDITGARAGE);
			if($userIsAdmin) {
				$xoopsTpl->assign('adminlink',_MD_XG_ADMINLINK);
				if($garage['approved'] == 0){
					$xoopsTpl->assign('approvegarage',_MD_XG_APPROVEGARAGE);
				}
				if($garage['disabled'] == 0){
					$xoopsTpl->assign('disablegarage',_MD_XG_DISABLEGARAGE);
				} elseif ($garage['disabled']) $xoopsTpl->assign('enablegarage',_MD_XG_ENABLEGARAGE);
				$xoopsTpl->assign('deletegarage',_MD_XG_DELETEGARAGE);
			}
		}
		
		if($xoopsModuleConfig['usecats']){
			include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
			$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");
			$path = $cattree->getNicePathFromId($garage['cid'], "name", $self."?op=default");		
			$xoopsTpl->assign('path',$path);
		}
		
		
		$xoopsTpl->assign('allowcomments', $xoopsModuleConfig['allowcomments']);
		$xoopsTpl->assign('gid', $gid);
		$xoopsTpl->assign('gname', _MD_XG_GNAME);
		$xoopsTpl->assign('garage', $garage);
		$xoopsTpl->assign('list', $xoopsModuleConfig['listname']);
		$xoopsTpl->assign('website', _MD_XG_PWEBSITE);
		$xoopsTpl->assign('location', _MD_XG_PLOCATION);
		$xoopsTpl->assign('make', _MD_XG_MAKE);
		$xoopsTpl->assign('model', _MD_XG_MODEL);
		$xoopsTpl->assign('year', _MD_XG_YEAR);
		$xoopsTpl->assign('engine', _MD_XG_ENGINE);
		$xoopsTpl->assign('color', _MD_XG_COLOR);
		$xoopsTpl->assign('rt', _MD_XG_RT);
		$xoopsTpl->assign('sixty', _MD_XG_SIXTY);
		$xoopsTpl->assign('three', _MD_XG_THREE);
		$xoopsTpl->assign('eigth', _MD_XG_EIGTH);
		$xoopsTpl->assign('eigthm', _MD_XG_EIGTHM);
		$xoopsTpl->assign('thou', _MD_XG_THOU);
		$xoopsTpl->assign('quart', _MD_XG_QUART);
		$xoopsTpl->assign('quartm', _MD_XG_QUARTM);
		$xoopsTpl->assign('linkgarage', _MD_XG_USERGARAGE);
		$xoopsTpl->assign('index',_MD_XG_INDEX);
		$xoopsTpl->assign('mengine',_MD_XG_MENGINE);
		$xoopsTpl->assign('mexterior',_MD_XG_MEXTERIOR);
		$xoopsTpl->assign('minterior',_MD_XG_MINTERIOR);
		$xoopsTpl->assign('mrims',_MD_XG_MRIMS);
		$xoopsTpl->assign('maudio',_MD_XG_MAUDIO);
		$xoopsTpl->assign('mfuture',_MD_XG_MFUTURE);

		if($xoopsModuleConfig['allowcomments']) include XOOPS_ROOT_PATH.'/include/comment_view.php';		
		break;
		
	case "default":
	default:
		$xoopsOption['template_main'] = "cat_index.html";
		//$xoopsOption['template_main'] = "roster.html";

		if(($xoopsModuleConfig['canuseredit']) || ($xoopsModuleConfig['canadminsedit'] && $userIsAdmin)){
			$xoopsTpl->assign('panel', true);
			if($userIsAdmin) {
				$xoopsTpl->assign('adminlink',_MD_XG_ADMINLINK);
			}
		}
		$xoopsTpl->assign('index',_MD_XG_INDEX);
		$xoopsTpl->assign('header',_MD_XG_HEADER);
		if($xoopsModuleConfig['canusersubmit'] == 1) $xoopsTpl->assign('addnewgarage',_MD_XG_ADDNEWGARAGE);
		
		include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
		$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");

		$itemTotal = getAllCount(0);
		if (!$itemTotal) $itemTotal = "0";
		$totalItems = sprintf(_MD_XG_TOTALITEMS,$itemTotal);
		$xoopsTpl->assign('itemTotal',$totalItems);
		
		if($xoopsModuleConfig['usecats']){
			
			$path = $cattree->getNicePathFromId($cid, "name", $self."?op=default");		
			$xoopsTpl->assign('path',$path);
			$xoopsTpl->assign('cid',$cid);
			$cats = getCats($cid);
			//$xoopsTpl->assign('cats', $cats);
			for($i=0;$i<count($cats);$i++){
				//$result = getCount($cats[$i]['cid']);
				$total = getAllCount($cats[$i]['cid']);
				//var_dump($result);
				//$cats[$i]['count'] = $result['count'];
				if(!$total) $total = "0";
				$cats[$i]['count'] = $total;
				$xoopsTpl->append('cats', $cats[$i]);
			}
			//var_dump($cats);
		}

		$names = getRoster($cid);
		
		if(count($names)> 0){
			for($i=0;$i<count($names);$i++){
				$xoopsTpl->append('names', $names[$i]);
			}
		}else $xoopsTpl->append('msg', _MD_XG_NONEYET);
	break;
}
require(XOOPS_ROOT_PATH.'/footer.php');	
?>