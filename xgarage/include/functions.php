<?php

function getRoster($cid){
	global $xoopsDB;
	$sql = "SELECT id,name FROM " . $xoopsDB->prefix("garage") . " WHERE (approved=1 AND viewable=1 AND disabled=0) AND cid=$cid ORDER BY name";
		if ( !$result = $xoopsDB->query($sql) ) {
			return;
			//exit("SQL Error in function :: getRoster($cid)");
		}	
		$names = array();
		while ( $row = $xoopsDB->fetchArray($result) ) {
			$names[] = $row;
		}
	return $names;
}

function getGarage($gid){
	global $xoopsDB;
	$sql = "SELECT id,approved,viewable,disabled,uid,cid,name,image,uploadimage,imagechoice,url,location,year,make,model,style,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkgarage FROM " . $xoopsDB->prefix("garage") . " WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: getGarage()");
		}	
		$Garage = array();
		while ( $row = $xoopsDB->fetchArray($result) ) {
			$Garage = $row;
		}
	return $Garage;
}

function addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage){
	global $xoopsDB;
	$sql = "INSERT INTO " . $xoopsDB->prefix("garage") . " (approved,uid,cid,name,image,uploadimage,imagechoice,url,location,year,make,model,style,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkgarage) VALUES ($aa,$uid,$cid,'$name','$image','$uploadimage','$imagechoice','$url','$location','$year','$make','$model','$style','$engine','$color','$rt','$sixty','$three','$eigth','$eigthm','$thou','$quart','$quartm','$list','$mengine','$mexterior','$minterior','$mrims','$maudio','$mfuture','$descript2','$linkgarage')";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage)");
		} else {
			return 1;
		}
}

function updateGarage($gid,$uid,$cid,$viewable,$name,$image,$imagechoice="0",$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET uid=$uid,cid=$cid,viewable=$viewable,name='$name',image='$image',imagechoice='$imagechoice',url='$url',location='$location',year='$year',make='$make',model='$model',style='$style',engine='$engine',color='$color',rt='$rt',sixty='$sixty',three='$three',eigth='$eigth',eigthm='$eigthm',thou='$thou',quart='$quart',quartm='$quartm',list='$list',mengine='$mengine',mexterior='$mexterior',minterior='$minterior',mrims='$mrims',maudio='$maudio',mfuture='$mfuture',descript2='$descript2',linkgarage='$linkgarage' WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: updateGarage($gid,$uid,$cid,$viewable,$name,$image,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage)");
		} else {
			return 1;
		}
}

function updateGaragePlusUpload($gid,$uid,$cid,$viewable,$name,$image,$uploadimage,$imagechoice="0",$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET uid=$uid,cid=$cid,viewable=$viewable,name='$name',image='$image',uploadimage='$uploadimage',imagechoice='$imagechoice',url='$url',location='$location',year='$year',make='$make',model='$model',style='$style',engine='$egine',color='$color',rt='$rt',sixty='$sixty',three='$three',eigth='$eigth',eigthm='$eigthm',thou='$thou',quart='$quart',quartm='$quartm',list='$list',mengine='$mengine',mexterior='$mexterior',minterior='$minterior',mrims='$mrims',maudio='$maudio',mfuture='$mfuture',descript2='$descript2',linkgarage='$linkgarage' WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: updateGaragePlusUpload($gid,$cid,$viewable,$name,$image,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list)");

		} else {
			return 1;
		}
}

function doesGarageExist($uid){
	global $xoopsDB;
	$sql = "SELECT id FROM " . $xoopsDB->prefix("garage") . " WHERE uid=$uid LIMIT 1";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("SQL Error in function :: doesGarageExist()");
		}	
		$xgid = $xoopsDB->fetchRow($result);
	return $xgid;
}

function getCats($gid){
	global $xoopsDB;
	$sql = "SELECT cid,name FROM " . $xoopsDB->prefix("garage_cats") . " WHERE gid = $gid ORDER BY name";
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
function getCount($cid){
	global $xoopsDB;
	$sql = "SELECT count(*) as count FROM " . $xoopsDB->prefix("garage") . " WHERE (approved=1 AND viewable=1 AND disabled=0) AND cid = $cid";
		//echo($sql);
		if ( !$result = $xoopsDB->query($sql) ) {
			return 0;
			//exit("$sql > SQL Error in function :: getCount($cid)");
		} else {
			$row = $xoopsDB->fetchArray($result);
			return ($row);
		}
}

function getAllCount($cid=0){

	global $cattree;
	
	$result = getCount($cid);
	$count = $result['count'];
	$children = $cattree->getChildTreeArray($cid);
	//var_dump($children);
	foreach($children as $child){
		//var_dump($child);
		
		$result = getCount($child['cid']);
		$count = $count + $result['count'];
	}
	return $count;
}

function userIsAdmin($xoopsUser){
	if ($xoopsUser){
		$uid = $xoopsUser->uid();
		$module_handler =& xoops_gethandler('module');
		$garagemodule =& $module_handler->getByDirname('garage');
		$moduleid = $garagemodule->getVar('mid');
		if ($xoopsUser->isAdmin($moduleid)){
			return 1;
		} else return 0;
	}
}


function getEditor($caption, $name, $value = "", $width = '100%', $height ='200px', $supplemental='', $dhtml = true){

	global $xoopsModuleConfig;
$editor = false;
$x22=false;
$xv=str_replace('XOOPS ','',XOOPS_VERSION);
if(substr($xv,2,1)=='2') {
$x22=true;
}
$editor_configs=array();
$editor_configs["name"] =$name;
$editor_configs["value"] = $value;
$editor_configs["rows"] = 10;
$editor_configs["cols"] = 40;
$editor_configs["width"] = "100%";
$editor_configs["height"] = "200px";

	switch(strtolower($xoopsModuleConfig['form_options'])){

		case 'tiny' :
		if (!$x22) {

			if ( is_readable(XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/xoopseditor/tinyeditor/formtinyeditortextarea.php");
				$editor = new XoopsFormTinyeditorTextArea(array('caption'=>$caption, 'name'=>$name, 'value'=>$value, 'width'=>'100%', 'height'=>'200px'));
			} else {
				if ($dhtml) {
					$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
				} else {
					$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
				}
			}
		} else {
			$editor = new XoopsFormEditor($caption, "tinyeditor", $editor_configs);
		}
		break;

		case 'inbetween' :
		if (!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/xoopseditor/inbetween/forminbetweentextarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/xoopseditor/inbetween/forminbetweentextarea.php");
				$editor = new XoopsFormInbetweenTextArea(array('caption'=> $caption, 'name'=>$name, 'value'=>$value, 'width'=>'100%', 'height'=>'200px'),true);
			} else {
				if ($dhtml) {
					$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
				} else {
					$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
				}
			}
		} else {
			$editor = new XoopsFormEditor($caption, "inbetween", $editor_configs);
		}
		break;

		case 'fckeditor' :
		if (!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/xoopseditor/FCKeditor/formfckeditor.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/xoopseditor/FCKeditor/formfckeditor.php");
				$editor = new XoopsFormFckeditor($editor_configs,true);
			} else {
				if ($dhtml) {
					$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
				} else {
					$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
				}
			}
		} else {
			$editor = new XoopsFormEditor($caption, "fckeditor", $editor_configs);
		}
		break;

		case 'koivi' :
		if (!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/wysiwyg/formwysiwygtextarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/wysiwyg/formwysiwygtextarea.php");
				$editor = new XoopsFormWysiwygTextArea($caption, $name, $value, '100%', '200px');
			} else {
				if ($dhtml) {
					$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
				} else {
					$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
				}
			}
		} else {
			$editor = new XoopsFormEditor($caption, "koivi", $editor_configs);
		}
		break;

		case "spaw":
		if(!$x22) {
			if (is_readable(XOOPS_ROOT_PATH . "/class/spaw/formspaw.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/spaw/formspaw.php");
				$editor = new XoopsFormSpaw($caption, $name, $value);
			} else {
				if ($dhtml) {
					$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
				} else {
					$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
				}
			}

		} else {
			$editor = new XoopsFormEditor($caption, "spaw", $editor_configs);
		}
		break;

		case "htmlarea":
		if(!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/htmlarea/formhtmlarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/htmlarea/formhtmlarea.php");
				$editor = new XoopsFormHtmlarea($caption, $name, $value);
			} else {
				if ($dhtml) {
					$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
				} else {
					$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
				}
			}
		} else {
			$editor = new XoopsFormEditor($caption, "htmlarea", $editor_configs);
		}
		break;

		default :
		if ($dhtml) {
			$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 40);
		} else {
			$editor = new XoopsFormTextArea($caption, $name, $value, 7, 40);
		}

		break;
	}

	return $editor;
}

?>