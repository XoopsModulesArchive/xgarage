<?php
/**
 *  Garage Management
 *  Doc Comments needed, once completed.
 * @version Stage1
 */
include_once XOOPS_ROOT_PATH."/class/xoopsobject.php";

/**
 * Doc Comment Needed. 
 * this is the garage and everything stored in the garage..  the one car garage.
 */
class Garage extends XoopsObject
{
	var $db;
	//not done. variable type is not set correctly
	function Garage()
	{
//required and max length need to be set still
		$this->db = Database::getInstance();
		$this->initVar('aa', XOBJ_DTYPE_INT, NULL); //approved 
		$this->initVar('uid', XOBJ_DTYPE_INT, NULL);//uid
		$this->initVar('cid', XOBJ_DTYPE_INT, NULL);//cid
		$this->initVar('name', XOBJ_DTYPE_TXTBOX);//name
		$this->initVar('image', XOBJ_DTYPE_TXTBOX);//image
		$this->initVar('uploadimage', XOBJ_DTYPE_TXTBOX, NULL);//uploadimage
		$this->initVar('imagechoice', XOBJ_DTYPE_INT, NULL);//imagechoice
		$this->initVar('url', XOBJ_DTYPE_INT, NULL);//url
		$this->initVar('location', XOBJ_DTYPE_TXTBOX, NULL);//location
		$this->initVar('year', XOBJ_DTYPE_TXTBOX, NULL);//year
		$this->initVar('make', XOBJ_DTYPE_TXTBOX, NULL);//mark field?...make??? .05fixed
		$this->initVar('model', XOBJ_DTYPE_TXTBOX, NULL);//model
		$this->initVar('style', XOBJ_DTYPE_TXTBOX, NULL);//style??? mmissing??? .05fixed
		$this->initVar('engine', XOBJ_DTYPE_TXTBOX, NULL);//engine
		$this->initVar('color', XOBJ_DTYPE_TXTBOX, NULL);//color
		$this->initVar('rt', XOBJ_DTYPE_TXTBOX, NULL);//rt
		$this->initVar('sixty', XOBJ_DTYPE_TXTBOX, NULL);//sixty
		$this->initVar('three', XOBJ_DTYPE_TXTBOX, NULL);//three
		$this->initVar('eigth', XOBJ_DTYPE_TXTBOX, NULL);//eight???? misspelling?
		$this->initVar('eigthm', XOBJ_DTYPE_TXTBOX, NULL);//misspelling again?
		$this->initVar('thou', XOBJ_DTYPE_TXTBOX, NULL);//thou
		$this->initVar('quart', XOBJ_DTYPE_TXTBOX, NULL);//quart
		$this->initVar('quartm', XOBJ_DTYPE_TXTBOX, NULL);//quartm
		$this->initVar('list', XOBJ_DTYPE_TXTBOX, NULL);//list
		$this->initVar('mengine', XOBJ_DTYPE_TXTAREA, NULL);//mengine
		$this->initVar('mexterior', XOBJ_DTYPE_TXTAREA, NULL);//meterier ?? mexterior .06fixed
		$this->initVar('minterior',XOBJ_DTYPE_TXTAREA, NULL);//minterior
		$this->initVar('mrims', XOBJ_DTYPE_TXTAREA, NULL);//mrims
		$this->initVar('maudio', XOBJ_DTYPE_TXTAREA, NULL);//maudio
		$this->initVar('mfuture', XOBJ_DTYPE_TXTAREA, NULL);//mfuture
		$this->initVar('descript2', XOBJ_DTYPE_TXTAREA, NULL);//descript2
		$this->initVar('linkgarage', XOBJ_DTYPE_INT, NULL);//linkgarage
	}

}

//to be added.

//xoops_getModuleHandler('garage','garage'); obj. dir
class GarageGarageHandler extends XoopsObjectHandler
{

/** 
 * retrieves a garage
 * 
 * @param int $gid GID of the garage
 *
 */
 //done
function &getGarage($uid)
{
	$garage = false;
	if (intval($uid) > 0) {
		//$sql = "SELECT id,approved,viewable,disabled,uid,cid,name,image,uploadimage,imagechoice,url,location,year,make,model,style,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkgarage FROM " . $this->db->prefix('garage') . " WHERE id = '$gid'";
		$sql = "SELECT * FROM " . $this->db->prefix('garage') . " WHERE id = '".$uid."'";
		//next version . use criteria
	    if (!$result = $this->db->query($sql)) {
	    	exit("$sql > SQL Error in function :: getGarage()");
	    	//return $garage; //$garage which would be false
	    }
    
    	$numrows = $this->db->getRowsNum($result);
	    if ($numrows == 1) {
	    	$garage = new garage();
	    	$garage->assignVars($this->db->fetchArray($result));
	    }
    }
    return $garage;
}

//done
function doesGarageExist($uid){

	$sql = "SELECT id FROM " . $this->db->prefix("garage") . " WHERE uid = '$uid' LIMIT 1";
		if ( !$result = $this->db->query($sql) ) {
			exit("SQL Error in function :: doesGarageExist()");
		}	
		$xgid = $this->db->fetchRow($result);
	return $xgid;
}

//use criteria,
//didnt change yet
function &getRoster($cid){
	$sql = "SELECT id,name FROM " . $this->db->prefix("garage") . " WHERE (approved=1 AND viewable=1 AND disabled=0) AND cid='$cid' ORDER BY name";
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

//didnt change yet
function garage_FieldExists($fieldname,$table)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF("SHOW COLUMNS FROM	$table LIKE '$fieldname'");
	return($xoopsDB->getRowsNum($result) > 0);
}
//didnt change yet
function garage_AddField($field, $table)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF('ALTER TABLE ' . $table . " ADD $field;");
	return $result;
}

//done. we use creategarage and then we do setvar. then we insertGarage
function creategarage($isNew = true){    
	$garage = new garage();
        if ($isNew) {
            $garage->setNew();
        }
	return $garage;
	//use setvar to set it in page that calls this.
}

//done ish
function insertGarage(&$garage){
	    if (strtolower(get_class($garage)) != 'garage') {
            return false;
        }
        if (!$garage->isDirty()) {
            return true;
        }
        if (!$garage->cleanVars()) { //clean the vars
            return false;
        }
        foreach ($garage->cleanVars as $k => $v) {
            ${$k} = $v;
        }
	
	    //use $garage->isNew() to see if the user is a new one. so we can INSERT or just UPDATE
	    //note. i left the insert and the update garages as separate methods.
		$sql = "INSERT INTO " . $this->db->prefix("garage") . " (approved,uid,cid,name,image,uploadimage,imagechoice,url,location,year,make,model,style,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkgarage) VALUES ($aa,$uid,$cid,'$name','$image','$uploadimage','$imagechoice','$url','$location','$year','$make','$model','$style','$engine','$color','$rt','$sixty','$three','$eigth','$eigthm','$thou','$quart','$quartm','$list','$mengine','$mexterior','$minterior','$mrims','$maudio','$mfuture','$descript2','$linkgarage')";
		if ( !$result = $$this->db->query($sql) ) {
			exit("$sql > SQL Error in function :: addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage)");
		} else {
			return 1;
		}

        if (empty($uid)) {
            $uid = $this->db->getInsertId();
        }
        
        $garage->assignVar('uid', $uid);
        return true;
}

//or?,
//didnt change yet
function addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage){
	global $xoopsDB;
	$sql = "INSERT INTO " . $xoopsDB->prefix("garage") . " (approved,uid,cid,name,image,uploadimage,imagechoice,url,location,year,make,model,style,engine,color,rt,sixty,three,eigth,eigthm,thou,quart,quartm,list,mengine,mexterior,minterior,mrims,maudio,mfuture,descript2,linkgarage) VALUES ($aa,$uid,$cid,'$name','$image','$uploadimage','$imagechoice','$url','$location','$year','$make','$model','$style','$engine','$color','$rt','$sixty','$three','$eigth','$eigthm','$thou','$quart','$quartm','$list','$mengine','$mexterior','$minterior','$mrims','$maudio','$mfuture','$descript2','$linkgarage')";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: addGarage($aa,$uid,$cid,$name,$image,$uploadimage,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage)");
		} else {
			return 1;
		}
}
//adopt the way user.php does new and old users update.,
//didnt change yet
function updateGarage($gid,$uid,$cid,$viewable,$name,$image,$imagechoice="0",$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET uid=$uid,cid=$cid,viewable=$viewable,name='$name',image='$image',imagechoice='$imagechoice',url='$url',location='$location',year='$year',make='$make',model='$model',style='$style',engine='$engine',color='$color',rt='$rt',sixty='$sixty',three='$three',eigth='$eigth',eigthm='$eigthm',thou='$thou',quart='$quart',quartm='$quartm',list='$list',mengine='$mengine',mexterior='$mexterior',minterior='$minterior',mrims='$mrims',maudio='$maudio',mfuture='$mfuture',descript2='$descript2',linkgarage='$linkgarage' WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: updateGarage($gid,$uid,$cid,$viewable,$name,$image,$imagechoice,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage)");
		} else {
			return 1;
		}
}
//didnt change yet
function updateGaragePlusUpload($gid,$uid,$cid,$viewable,$name,$image,$uploadimage,$imagechoice="0",$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list,$mengine,$mexterior,$minterior,$mrims,$maudio,$mfuture,$descript2,$linkgarage){
	global $xoopsDB;
	$sql = "UPDATE " . $xoopsDB->prefix("garage") . " SET uid=$uid,cid=$cid,viewable=$viewable,name='$name',image='$image',uploadimage='$uploadimage',imagechoice='$imagechoice',url='$url',location='$location',year='$year',make='$make',model='$model',style='$style',engine='$engine',color='$color',rt='$rt',sixty='$sixty',three='$three',eigth='$eigth',eigthm='$eigthm',thou='$thou',quart='$quart',quartm='$quartm',list='$list',mengine='$mengine',mexterior='$mexterior',minterior='$minterior',mrims='$mrims',maudio='$maudio',mfuture='$mfuture',descript2='$descript2',linkgarage='$linkgarage' WHERE id = $gid";
		if ( !$result = $xoopsDB->query($sql) ) {
			exit("$sql > SQL Error in function :: updateGaragePlusUpload($gid,$cid,$viewable,$name,$image,$url,$location,$year,$make,$model,$style,$engine,$color,$rt,$sixty,$three,$eigth,$eigthm,$thou,$quart,$quartm,$list)");

		} else {
			return 1;
		}
}

//Delete garage?

}

?>