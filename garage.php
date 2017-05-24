<?php
include("header.php");

$mydirname = basename( dirname( __FILE__ ) ) ;

require_once( XOOPS_ROOT_PATH."/modules/$mydirname/include/gtickets.php" ) ;

$myts = MyTextSanitizer::getInstance();
$module_id = $xoopsModule->getVar('mid');

if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}

$gperm_handler =& xoops_gethandler('groupperm');

if (isset($_POST['item_id'])) {
    $perm_itemid = intval($_POST['item_id']);
} else {
    $perm_itemid = 0;
}
//If no access
if (!$gperm_handler->checkRight("garage_submit", $perm_itemid, $groups, $module_id)) {
    redirect_header(XOOPS_URL."/index.php", 3, _NOPERM);
    exit();
}
	
// End Group Perms

require(XOOPS_ROOT_PATH.'/header.php');

include("include/functions.php");

settype($uid, "string");
settype($xgid, "string");
settype($cid, "integer");
settype($cats, "array");
settype($url, "string");
settype($name, "string");
settype($image, "string");
settype($imagechoice, "string");//jlm69
settype($uploadimage, "string");//jlm69
settype($location, "string");
settype($year, "string");
settype($make, "string");
settype($model, "string");
settype($style, "string");
settype($engine, "string");
settype($color, "string");
settype($rt, "string");
settype($sixty, "string");
settype($three, "string");
settype($eigth, "string");
settype($eigthm, "string");
settype($thou, "string");
settype($quart, "string");
settype($quartm, "string");
settype($list, "string");
settype($mengine, "string");
settype($mexterior, "string");
settype($minterior, "string");
settype($mrims, "string");
settype($maudio, "string");
settype($mfuture, "string");
settype($msg, "string");
settype($errmsg, "string");
settype($notifypub, "string");
settype($nohtml, "string");
settype($nosmiley, "string");
settype($descript2, "string");//jlm69
settype($linkgarage, "string");//jlm69

$userIsAdmin = userIsAdmin($xoopsUser);
if(!$xoopsUser) redirect_header("/user.php",2,_MD_XG_MUSTLOGIN);
$uid = $xoopsUser->uid();

if ( isset($_POST['preview'] )) {
	$op = 'preview';
} elseif ( isset($_POST['post']) ) {
	$op = 'post';
} elseif ( isset($_POST['update']) ) {
	$op = 'update';
} 
if(isset($_GET['cid'])) $cid = $_GET['cid'];
if(isset($_POST['cid'])) $cid = $_POST['cid'];
$gid = isset($_GET['gid']) ? intval($_GET['gid']) : 0;
if(isset($_GET['op'])) $op = $_GET['op'];
if(isset($_POST['op'])) $op = $_POST['op'];

//include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
//$cattree = new XoopsTree($xoopsDB->prefix("garages_cat"),"cid","gid");
//$path = $cattree->getPathFromId($cid, "title");


switch ($op){

	case "preview":
		$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
	break;
	
	case "post":

		if($xoopsModuleConfig['canusersubmit'] == 1 || $userIsAdmin == 1){
			
			$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
			
			$a = $myts->makeTboxData4Save($_POST['aa']);
			$cid = $myts->makeTboxData4Save($_POST['cid']);
			$name = $myts->makeTboxData4Save($_POST['name']);
			$image = $myts->makeTboxData4Save($_POST['image']);
			$imagechoice = $myts->makeTboxData4Save($_POST['imagechoice']);
			$url = $myts->makeTboxData4Save($_POST['url']);
			$location = $myts->makeTboxData4Save($_POST['location']);
			$year = $myts->makeTboxData4Save($_POST['year']);
			$make = $myts->makeTboxData4Save($_POST['make']);
			$model = $myts->makeTboxData4Save($_POST['model']);
			$style = $myts->makeTboxData4Save($_POST['style']);
			$engine = $myts->makeTboxData4Save($_POST['engine']);
			$color = $myts->makeTboxData4Save($_POST['color']);
			$rt = $myts->makeTboxData4Save($_POST['rt']);
			$sixty = $myts->makeTboxData4Save($_POST['sixty']);
			$three = $myts->makeTboxData4Save($_POST['three']);
			$eigth = $myts->makeTboxData4Save($_POST['eigth']);
			$eigthm = $myts->makeTboxData4Save($_POST['eigthm']);
			$thou = $myts->makeTboxData4Save($_POST['thou']);
			$quart = $myts->makeTboxData4Save($_POST['quart']);
			$quartm = $myts->makeTboxData4Save($_POST['quartm']);
			$list = $myts->makeTboxData4Save($_POST['list']);
			$mengine = $myts->makeTareaData4Save($_POST['mengine']);
			$mexterior = $myts->makeTareaData4Save($_POST['mexterior']);
			$minterior = $myts->makeTareaData4Save($_POST['minterior']);
			$mrims = $myts->makeTareaData4Save($_POST['mrims']);
			$maudio = $myts->makeTareaData4Save($_POST['maudio']);
			$mfuture = $myts->makeTareaData4Save($_POST['mfuture']);
			if($xoopsModuleConfig['usedescript2']) $descript2 = $myts->makeTareaData4Save($_POST['descript2']);
			if($xoopsModuleConfig['linkgarage']) $linkgarage = $myts->makeTareaData4Save($_POST['linkgarage']);
			if($url == "http://") $url = "";
			if($image) $image = "[img align=right]".$image."[/img]";
			
			include("image_uploader.php");
			
			$success = addGarage($a,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage);

//jlm69
if($success) {
$notification_handler =& xoops_gethandler('notification');
$id = $xoopsDB->getInsertId();
$cid = $_POST['cid'];
$tags=array();
$tags['YEAR'] = $year;
$tags['MAKE'] = $make;
$tags['MODEL'] = $model;
$tags['LINK_URL'] = XOOPS_URL . '/modules/garage/index.php?op=view&gid=' . addslashes($id);
$sql = "SELECT name FROM " . $xoopsDB->prefix("garage_cats") . " WHERE cid=" . addslashes($_POST['cid']);
$result2 = $xoopsDB->query($sql);
$row = $xoopsDB->fetchArray($result2);

$tags['CATEGORY_TITLE'] = $row['name'];
$tags['CATEGORY_URL'] = XOOPS_URL . '/modules/garage/index.php?cid="' . addslashes($cid);
$notification_handler =& xoops_gethandler('notification');
$notification_handler->triggerEvent('global', 0, 'new_listing', $tags);
$notification_handler->triggerEvent('category', $cid, 'new_listing', $tags);
$notification_handler->triggerEvent ('listing', $gid, 'new_listing', $tags );


}//end jlm69

			if($success) redirect_header("index.php",2,_MD_XG_ADDSUCCESS);
			else redirect_header("index.php",2,_MD_XG_ADDFAILURE);
		} else redirect_header("index.php",2,_MD_XG_ADDFAILURE);
	break;

	case "update":
		$xoopsOption['template_main'] = "edit_garage.html";
		//var_dump($_FILES);
		//var_dump($_POST);
		
		$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
		
		$gid = $_POST['gid'];
		
		$garage = getGarage($gid);
		$puid = $garage['uid'];

		if ($xoopsModuleConfig['usecats'] != 0) {
			$catopts = getCatOptions($cid);
			$timetrials = $catopts['racing'];
		} else {
			$timetrials = '';
			}
		$ouid = $myts->makeTboxData4Save($_POST['ouid']);
		$viewable = $myts->makeTboxData4Save($_POST['viewable']);
		$cid = $myts->makeTboxData4Save($_POST['cid']);
		$name = $myts->makeTboxData4Save($_POST['name']);
		$image = $myts->makeTboxData4Save($_POST['image']);
		$imagechoice = $myts->makeTboxData4Save($_POST['imagechoice']);
		if(!$imagechoice) $imagechoice = "0";
		$url = $myts->makeTboxData4Save($_POST['url']);
		$location = $myts->makeTboxData4Save($_POST['location']);
		$year = $myts->makeTboxData4Save($_POST['year']);
		$make = $myts->makeTboxData4Save($_POST['make']);
		$model = $myts->makeTboxData4Save($_POST['model']);
		$style = $myts->makeTboxData4Save($_POST['style']);
		$engine = $myts->makeTboxData4Save($_POST['engine']);
		$color = $myts->makeTboxData4Save($_POST['color']);

		if(isset($timetrials)) {
		$rt = $myts->makeTboxData4Save($_POST['rt']);
		$sixty = $myts->makeTboxData4Save($_POST['sixty']);
		$three = $myts->makeTboxData4Save($_POST['three']);
		$eigth = $myts->makeTboxData4Save($_POST['eigth']);
		$eigthm = $myts->makeTboxData4Save($_POST['eigthm']);
		$thou = $myts->makeTboxData4Save($_POST['thou']);
		$quart = $myts->makeTboxData4Save($_POST['quart']);
		$quartm = $myts->makeTboxData4Save($_POST['quartm']);

		} else {
		$rt = '';
		$sixty = '';
		$three = '';
		$eigth = '';
		$eigthm = '';
		$thou = '';
		$quart = '';
		$quartm = '';
		}

		$list = $myts->makeTboxData4Save($_POST['list']);
		$mengine = $myts->makeTareaData4Save($_POST['mengine']);
		$mexterior = $myts->makeTareaData4Save($_POST['mexterior']);
		$minterior = $myts->makeTareaData4Save($_POST['minterior']);
		$mrims = $myts->makeTareaData4Save($_POST['mrims']);
		$maudio = $myts->makeTareaData4Save($_POST['maudio']);
		$mfuture = $myts->makeTareaData4Save($_POST['mfuture']);
		if($xoopsModuleConfig['usedescript2']) $descript2 = $myts->makeTareaData4Save($_POST['descript2']);
		if($xoopsModuleConfig['linkgarage']) $linkgarage = $myts->makeTareaData4Save($_POST['linkgarage']);
		if($url == "http://") $url = "";
		if($image) $image = "[img align=right]".$image."[/img]";

		include("image_uploader.php");
		//check if user can edit this garage.
		if($errmsg) $wtime = 15;
		else $wtime = 3;
		if(($uid == $puid && $xoopsModuleConfig['canuseredit']) || $userIsAdmin){
			if($msg) $success = updateGaragePlusUpload($gid,$ouid,$cid,$viewable,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage);
			else $success = updateGarage($gid,$ouid,$cid,$viewable,$name,$image,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage);

			if($success) redirect_header("index.php?op=view&gid=$gid",$wtime,_MD_XG_UPDATESUCCESS.$errmsg.$msg);
			else redirect_header("index.php?op=view&gid=$gid",$wtime,_MD_XG_UPDATEFAILURE.$errmsg.$msg);
		} else redirect_header("index.php?op=view&gid=$gid",$wtime,_MD_XG_UPDATEFAILURE.$errmsg.$msg);
		
	break;

	case "add":
		if(!$userIsAdmin){
			if(!$xoopsModuleConfig['canusersubmit']){
				if($xoopsModuleConfig['howtoaddgarage']){
					$redirect_url = $xoopsModuleConfig['howtoaddgarage'];
					$redirect_msg = _MD_XG_HOWTOADDGARAGE;
				} else {
					$redirect_url = "index.php";
					$redirect_msg = _MD_XG_USERCANNOTSUBMIT;
				}
				
				redirect_header($redirect_url,2,$redirect_msg);
				exit;
			}
		
			if($xoopsModuleConfig['multiplegarage'] = 1){


				if($gid = doesGarageExist($uid)) {
					$redirect_url = "index.php?op=view&gid=$uid";
					$redirect_msg = _MD_XG_CANNOTADDMULTIPLE;
					redirect_header($redirect_url,2,$redirect_msg);
					exit;
				}
			}
		}
		if(!$url) $url = "http://";
		include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
		$sform = new XoopsThemeForm(_MD_XG_ADDGARAGE, "garageform", xoops_getenv('PHP_SELF'));
		$sform->setExtra("enctype='multipart/form-data'");
		$sform->addElement(new XoopsFormHidden('aa',$xoopsModuleConfig['autoapprove']), false);
		$sform->addElement(new XoopsFormHidden('op','post'), false);
		if ($xoopsModuleConfig['usecats'] != 0) {
			$catopts = getCatOptions($cid);
			$timetrials = $catopts['racing'];

			include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
			$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");
			//$sform->addElement(new XoopsFormSelect(_MD_XG_CATEGORY, 'cid', $cid, 3), true);
			ob_start();
    		//$sform->addElement(new XoopsFormHidden('cid', 'gid'));
		    $cattree->makeMySelBox('name', 'name', $cid, 1,'cid');
		    $sform->addElement(new XoopsFormLabel(_MD_XG_CATEGORY, ob_get_contents()));
   			ob_end_clean();
		} else $sform->addElement(new XoopsFormHidden('cid',0), false);
		$timetrials = '';
		$sform->addElement(new XoopsFormText(_MD_XG_NAME, 'name', 50, 50, $name), true);
		if($xoopsModuleConfig['addimages']){
			$sform->addElement(new XoopsFormText(_MD_XG_IMAGE, 'image', 50, 255, $image), false);
			if ($xoopsModuleConfig['useruploads'] || $userIsAdmin)
    		{
        		$sform->addElement(new XoopsFormFile(_MD_XG_UPLOADIMAGE, 'uploadimage', 0), false);
    			$img_choice = new XoopsFormRadio(_MD_XG_IMAGECHOICE,'imagechoice',$imagechoice);
				$img_choice->addOption(0,_MD_XG_USEURL);
				$img_choice->addOption(1,_MD_XG_USEUPLOAD);
				$sform->addElement($img_choice);
			}
		}
		$sform->addElement(new XoopsFormText(_MD_XG_URL, 'url', 50, 255, $url), false);
		$sform->addElement(new XoopsFormText(_MD_XG_LOCATION, 'location', 50, 75, $location), false);
		$sform->addElement(new XoopsFormText(_MD_XG_YEAR, 'year', 50, 75, $year), false);
		$sform->addElement(new XoopsFormText(_MD_XG_MAKE, 'make', 50, 75, $make), false);
		$sform->addElement(new XoopsFormText(_MD_XG_MODEL, 'model', 50, 75, $model), false);
		$sform->addElement(new XoopsFormText(_MD_XG_STYLE, 'style', 50, 75, $style), false);
		$sform->addElement(new XoopsFormText(_MD_XG_ENGINE, 'engine', 50, 75, $engine), false);
		$sform->addElement(new XoopsFormText(_MD_XG_COLOR, 'color', 50, 75, $color), false);

	if($timetrials) {
		$sform->addElement(new XoopsFormText(_MD_XG_RT, 'rt', 50, 75, $rt), false);
		$sform->addElement(new XoopsFormText(_MD_XG_SIXTY, 'sixty', 50, 75, $sixty), false);
		$sform->addElement(new XoopsFormText(_MD_XG_THREE, 'three', 50, 75, $three), false);
		$sform->addElement(new XoopsFormText(_MD_XG_EIGTH, 'eigth', 50, 75, $eigth), false);
		$sform->addElement(new XoopsFormText(_MD_XG_EIGTHM, 'eigthm', 50, 75, $eigthm), false);
		$sform->addElement(new XoopsFormText(_MD_XG_THOU, 'thou', 50, 75, $thou), false);
		$sform->addElement(new XoopsFormText(_MD_XG_QUART, 'quart', 50, 75, $quart), false);
		$sform->addElement(new XoopsFormText(_MD_XG_QUARTM, 'quartm', 50, 75, $quartm), false);

		} else {

		$sform->addElement(new XoopsFormHidden('rt',$rt), false);
		$sform->addElement(new XoopsFormHidden('sixty',$sixty), false);
		$sform->addElement(new XoopsFormHidden('three',$three), false);
		$sform->addElement(new XoopsFormHidden('eigth',$eigth), false);
		$sform->addElement(new XoopsFormHidden('eigthm',$eigthm), false);
		$sform->addElement(new XoopsFormHidden('thou',$thou), false);
		$sform->addElement(new XoopsFormHidden('quart',$quart), false);
		$sform->addElement(new XoopsFormHidden('quartm',$quartm), false);
}




		$sform->addElement(new XoopsFormText($xoopsModuleConfig['listname'], 'list', 50, 255, $list), false);
		$sform->addElement(getEditor(_MD_XG_MENGINE, 'mengine', $mengine, 10, 40), false);
		$sform->addElement(getEditor(_MD_XG_MEXTERIOR, 'mexterior', $mexterior, 10, 40), false);
		$sform->addElement(getEditor(_MD_XG_MINTERIOR, 'minterior', $minterior, 10, 40), false);
		$sform->addElement(getEditor(_MD_XG_MRIMS, 'mrims', $mrims, 10, 40), false);
		$sform->addElement(getEditor(_MD_XG_MAUDIO, 'maudio', $maudio, 10, 40), false);
		$sform->addElement(getEditor(_MD_XG_MFUTURE, 'mfuture', $mfuture, 10, 40), false);
		if($xoopsModuleConfig['usedescript2'])  $sform->addElement(getEditor(_MD_XG_DESCRIPT2, 'descript2', $descript2, 10, 40), false);

		if($xoopsModuleConfig['linkgarage']){
			$linkgarage_choice = new XoopsFormRadio(_MD_XG_LINKGARAGE,'linkgarage',$linkgarage);
			$linkgarage_choice->addOption(0,_MD_XG_NOLINKTOUSER);
			$linkgarage_choice->addOption(1,_MD_XG_LINKTOUSER);
			$sform->addElement($linkgarage_choice);
		}
		$button_tray = new XoopsFormElementTray('' ,'');
		//$button_tray->addElement(new XoopsFormButton('', 'preview', _PREVIEW, 'submit'));
		$button_tray->addElement(new XoopsFormButton('', 'post', _MD_XG_SUBMIT, 'submit'));
		$sform->addElement($button_tray);
		$sform->display();
	
	break;

	case "edit":
		$gid = $_GET['gid'];
		$garage = getGarage($gid);
		$viewable = $garage['viewable'];
		$puid = $garage['uid'];
		$cid = $garage['cid'];
		$name = $garage['name'];
		$image = $garage['image'];
		$image = preg_replace("/\[img align=right\]/i","",$image);
		$image = preg_replace("/\[\/img\]/i","",$image);
		$uploadimage = $garage['uploadimage'];
		$imagechoice = $garage['imagechoice'];
		$url = $garage['url'];
		$location = $garage['location'];
		$year = $garage['year'];
		$make = $garage['make'];
		$model = $garage['model'];
		$style = $garage['style'];
		$engine = $garage['engine'];
		$color = $garage['color'];
		$rt = $garage['rt'];
		$sixty = $garage['sixty'];
		$three = $garage['three'];
		$eigth = $garage['eigth'];
		$eigthm = $garage['eigthm'];
		$thou = $garage['thou'];
		$quart = $garage['quart'];
		$quartm = $garage['quartm'];
		$list = $garage['list'];
		$mengine = $garage['mengine'];
		$mexterior = $garage['mexterior'];
		$minterior = $garage['minterior'];
		$mrims = $garage['mrims'];
		$maudio = $garage['maudio'];
		$mfuture = $garage['mfuture'];
		if($xoopsModuleConfig['usedescript2']) $descript2 = $garage['descript2'];
		if($xoopsModuleConfig['linkgarage']) $linkgarage = $garage['linkgarage'];
		//check if user can edit this garage.
		if(($uid == $puid && $xoopsModuleConfig['canuseredit']) || $userIsAdmin){
			if(!$url) $url = "http://";
			include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
			$sform = new XoopsThemeForm(_MD_XG_EDITGARAGE, "garageform", xoops_getenv('PHP_SELF'),"post");
			$sform->setExtra("enctype='multipart/form-data'");
			$sform->addElement(new XoopsFormHidden('gid',$gid), false);
			$sform->addElement(new XoopsFormHidden('op','update'), false);
			if ($userIsAdmin) $sform->addElement(new XoopsFormText(_MD_XG_OWNERUID, 'ouid', 50, 50, $puid), true);
			else $sform->addElement(new XoopsFormHidden('ouid',$puid), true);
			$sform->addElement(new XoopsFormRadioYN(_MD_XG_VIEWABLE, 'viewable',$viewable), true);
			if ($xoopsModuleConfig['usecats'] != 0) {//$sform->addElement(new XoopsFormSelect(_MD_XG_CATEGORY, 'cid', $cid, 3), true);
				$catopts = getCatOptions($cid);
				$timetrials = $catopts['racing'];
				include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
				$cattree = new XoopsTree($xoopsDB->prefix("garage_cats"),"cid","gid");

				ob_start();
				//$sform->addElement(new XoopsFormHidden('cid', 'gid'));
				$cattree->makeMySelBox('name', 'name', $cid, 1,'cid');
				//exit;
				$sform->addElement(new XoopsFormLabel(_MD_XG_CATEGORY, ob_get_contents()));
				ob_end_clean();
			} else $sform->addElement(new XoopsFormHidden('cid',0), false);
			$timetrials = '';
			$sform->addElement(new XoopsFormText(_MD_XG_NAME, 'name', 50, 50, $name), true);
			$sform->addElement(new XoopsFormText(_MD_XG_IMAGE, 'image', 50, 255, $image), false);
			if ($xoopsModuleConfig['useruploads'] || $userIsAdmin)
    		{
        		if($uploadimage){
					
					$sform->addElement(new XoopsFormFile(_MD_XG_UPLOADIMAGE."<br />"._MD_XG_UPLOADCURRENT."<br />".$uploadimage, 'uploadimage', 0), false);
				} else $sform->addElement(new XoopsFormFile(_MD_XG_UPLOADIMAGE, 'uploadimage', 0), false);
    			$img_choice = new XoopsFormRadio(_MD_XG_IMAGECHOICE,'imagechoice',$imagechoice);
				$img_choice->addOption(0,_MD_XG_USEURL);
				$img_choice->addOption(1,_MD_XG_USEUPLOAD);
				$sform->addElement($img_choice);
			} 
			$sform->addElement(new XoopsFormText(_MD_XG_URL, 'url', 50, 255, $url), false);
			$sform->addElement(new XoopsFormText(_MD_XG_LOCATION, 'location', 50, 75, $location), false);
			$sform->addElement(new XoopsFormText(_MD_XG_YEAR, 'year', 50, 75, $year), false);
			$sform->addElement(new XoopsFormText(_MD_XG_MAKE, 'make', 50, 75, $make), false);
			$sform->addElement(new XoopsFormText(_MD_XG_MODEL, 'model', 50, 75, $model), false);
			$sform->addElement(new XoopsFormText(_MD_XG_STYLE, 'style', 50, 75, $style), false);
			$sform->addElement(new XoopsFormText(_MD_XG_ENGINE, 'engine', 50, 75, $engine), false);
			$sform->addElement(new XoopsFormText(_MD_XG_COLOR, 'color', 50, 75, $color), false);

	if(isset($timetrials)) {
			$sform->addElement(new XoopsFormText(_MD_XG_RT, 'rt', 50, 75, $rt), false);
			$sform->addElement(new XoopsFormText(_MD_XG_SIXTY, 'sixty', 50, 75, $sixty), false);
			$sform->addElement(new XoopsFormText(_MD_XG_THREE, 'three', 50, 75, $three), false);
			$sform->addElement(new XoopsFormText(_MD_XG_EIGTH, 'eigth', 50, 75, $eigth), false);
			$sform->addElement(new XoopsFormText(_MD_XG_EIGTHM, 'eigthm', 50, 75, $eigthm), false);
			$sform->addElement(new XoopsFormText(_MD_XG_THOU, 'thou', 50, 75, $thou), false);
			$sform->addElement(new XoopsFormText(_MD_XG_QUART, 'quart', 50, 75, $quart), false);
			$sform->addElement(new XoopsFormText(_MD_XG_QUARTM, 'quartm', 50, 75, $quartm), false);
			}

			$sform->addElement(new XoopsFormText($xoopsModuleConfig['listname'], 'list', 50, 255, $list), false);
			$sform->addElement(getEditor(_MD_XG_MENGINE, 'mengine', $mengine, 10, 40), false);
			$sform->addElement(getEditor(_MD_XG_MEXTERIOR, 'mexterior', $mexterior, 10, 40), false);
			$sform->addElement(getEditor(_MD_XG_MINTERIOR, 'minterior', $minterior, 10, 40), false);
			$sform->addElement(getEditor(_MD_XG_MRIMS, 'mrims', $mrims, 10, 40), false);
			$sform->addElement(getEditor(_MD_XG_MAUDIO, 'maudio', $maudio, 10, 40), false);
			$sform->addElement(getEditor(_MD_XG_MFUTURE, 'mfuture', $mfuture, 10, 40), false);
			if($xoopsModuleConfig['usedescript2']) $sform->addElement(getEditor(_MD_XG_DESCRIPT2, 'descript2', $descript2, 10, 40), false);
			if($xoopsModuleConfig['linkgarage']){
				$linkgarage_choice = new XoopsFormRadio(_MD_XG_LINKGARAGE,'linkgarage',$linkgarage);
				$linkgarage_choice->addOption(0,_MD_XG_NOLINKTOUSER);
				$linkgarage_choice->addOption(1,_MD_XG_LINKTOUSER);
				$sform->addElement($linkgarage_choice);
			}

			$button_tray = new XoopsFormElementTray('' ,'');
			//$button_tray->addElement(new XoopsFormButton('', 'preview', _PREVIEW, 'submit'));
			//$button_tray->addElement(new XoopsFormButton('', 'post', _MD_XG_SUBMIT, 'submit'));
			$button_tray->addElement(new XoopsFormButton('', 'update', _MD_XG_UPDATE, 'submit'));
			$sform->addElement($button_tray);
			$sform->display();
		} else {
			if($xoopsModuleConfig['canuseredit'] == 0){
				if($xoopsModuleConfig['howtochange']){
					$redirect_url = $xoopsModuleConfig['howtochange'];
					$redirect_msg = _MD_XG_HOWTOCHANGEGARAGE;
				} else {
					$redirect_url = "index.php";
					$redirect_msg = _MD_XG_CANNOTCHANGE;
				}
				redirect_header($redirect_url,3,$redirect_msg);
				exit;
			}
		}
	break;
	
	default:
}

require(XOOPS_ROOT_PATH.'/footer.php');	
?>