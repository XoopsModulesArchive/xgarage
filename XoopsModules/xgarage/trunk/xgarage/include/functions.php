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
	$sql = "SELECT id,approved,viewable,disabled,uid,cid,name,image,uploadimage,imagechoice,url,location,make,model,year,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkGarage FROM " . $xoopsDB->prefix("garage") . " WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: getGarage()");
		}	
		$Garage = array();
		while ( $row = $xoopsDB->fetchArray($result) ) {
			$Garage = $row;
		}
	return $Garage;
}

function addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$make,$model,$year,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkGarage){
	global $xoopsDB;
	$sql = "INSERT INTO " . $xoopsDB->prefix("garage") . " (approved,uid,cid,name,image,uploadimage,imagechoice,url,location,make,model,year,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkGarage) VALUES ($aa,$uid,$cid,'$name','$image','$uploadimage','$imagechoice','$url','$location','$make','$model','$year','$engine','$color','$rt','$sixty','$three','$eigth','$eigthm','$thou','$quart','$quartm','$list','$mengine','$mexterior','$minterior','$mrims','$maudio','$mfuture','$descript2','$linkGarage')";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$make,$model,$year,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkGarage)");
		} else {
			return 1;
		}
}

function updateGarage($gid,$uid,$cid,$viewable,$name,$image,$imagechoice="0",$url,$location,$make,$model,$year,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkGarage){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET uid=$uid,cid=$cid,viewable=$viewable,name='$name',image='$image',imagechoice='$imagechoice',url='$url',location='$location',make='$make',model='$model',year='$year',engine='$engine',color='$color',rt='$rt',sixty='$sixty',three='$three',eigth='$eigth',eigthm='$eigthm',thou='$thou',quart='$quart',quartm='$quartm',list='$list',mengine='$mengine',mexterior='$mexterior',minterior='$minterior',mrims='$mrims',maudio='$maudio',mfuture='$mfuture',descript2='$descript2',linkGarage='$linkGarage' WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: updateGarage($gid,$uid,$cid,$viewable,$name,$image,$imagechoice,$url,$location,$make,$model,$year,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkGarage)");
		} else {
			return 1;
		}
}

function updateGaragePlusUpload($gid,$uid,$cid,$viewable,$name,$image,$uploadimage,$imagechoice="0",$url,$location,$make,$model,$year,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkGarage){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET uid=$uid,cid=$cid,viewable=$viewable,name='$name',image='$image',uploadimage='$uploadimage',imagechoice='$imagechoice',url='$url',location='$location',make='$make',model='$model',year='$year',engine='$engine',color='$color',rt='$rt',sixty='$sixty',three='$three',eigth='$eigth',eigthm='$eigthm',thou='$thou',quart='$quart',quartm='$quartm',list='$list',mengine='$mengine',mexterior='$mexterior',minterior='$minterior',mrims='$mrims',maudio='$maudio',mfuture='$mfuture',descript2='$descript2',linkGarage='$linkGarage' WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: updateGaragePlusUpload($gid,$cid,$viewable,$name,$image,$url,$location,$make,$model,$year,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list)");

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

?>