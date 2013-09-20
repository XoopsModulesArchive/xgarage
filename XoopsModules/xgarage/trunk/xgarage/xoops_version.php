<?php

global $xoopsModuleConfig;

$modversion['name'] = _MI_NAME;
$modversion['version'] = 0.2;
$modversion['description'] = _MI_DESC;
$modversion['credits'] = 'www.calibernation.com / www.xgarage.org / www.jlmzone.com';
$modversion['author'] = 'Northern, script_fu, jlm69';
$modversion['help'] = 'docs';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'images/garage.png';
$modversion['dirname'] = 'garage';

// Menu
$modversion['hasMain'] = 1;
if($xoopsModuleConfig['canusersubmit']){
	$modversion['sub'][1]['name'] = _MI_SUBMIT;
	$modversion['sub'][1]['url'] = "garage.php?op=add";
}
// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'index.php';
$modversion['comments']['itemName'] = 'gid';


// Admin 
$modversion['hasAdmin']		= 1;
$modversion['adminindex']	= "admin/index.php";
$modversion['adminmenu']	= "admin/menu.php";

// Templates
$modversion['templates'][1]['file'] 		= 'cat_index.html'; // main index
$modversion['templates'][1]['description'] 	= 'Category and Name Index';
$modversion['templates'][2]['file'] 		= 'view_garage.html'; // Profile
$modversion['templates'][2]['description'] 	= 'garage';
$modversion['templates'][3]['file'] 		= 'edit_garage.html'; // edit Garage
$modversion['templates'][3]['description'] 	= 'garage editing template';

// Database 
$modversion['sqlfile']['mysql']		= "sql/garage.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0]	= "garage";
$modversion['tables'][1]	= "garage_cats";

// Blocks


//Configuration

// can user submit their own Garage

$modversion['config'][1]['name'] = 'canusersubmit';
$modversion['config'][1]['title'] = '_MI_CANUSERSUBMITTITLE';
$modversion['config'][1]['description'] = '_MI_CANUSERSUBMITDESC';
$modversion['config'][1]['formtype'] = 'select';
$modversion['config'][1]['valuetype'] = 'int';
$modversion['config'][1]['default'] = "1";
$modversion['config'][1]['options'] = array(_NO => 0, _YES => 1);

// If not, go to this URL when user tries to add a new Garage

$modversion['config'][2]['name'] = 'howtoaddgarage';
$modversion['config'][2]['title'] = '_MI_HOWTOADDTITLE';
$modversion['config'][2]['description'] = '_MI_HOWTOADDDESC';
$modversion['config'][2]['formtype'] = 'text';
$modversion['config'][2]['valuetype'] = 'string';

// will Garage be auto-approved or require admin approval before listing

$modversion['config'][3]['name'] = 'autoapprove';
$modversion['config'][3]['title'] = '_MI_AUTOAPPROVETITLE';
$modversion['config'][3]['description'] = '_MI_AUTOAPPROVEDESC';
$modversion['config'][3]['formtype'] = 'select';
$modversion['config'][3]['valuetype'] = 'int';
$modversion['config'][3]['default'] = "1";
$modversion['config'][3]['options'] = array(_MI_ADMINAPPROVAL => 0, _MI_AUTOAPP => 1);

// Can admins edit any Garage?

$modversion['config'][4]['name'] = 'canadminsedit';
$modversion['config'][4]['title'] = '_MI_ADMINSEDITTITLE';
$modversion['config'][4]['description'] = '_MI_ADMINSEDITDESC';
$modversion['config'][4]['formtype'] = 'select';
$modversion['config'][4]['valuetype'] = 'int';
$modversion['config'][4]['default'] = "1";
$modversion['config'][4]['options'] = array(_NO => 0, _YES => 1);

// Can users edit their own Garage?

$modversion['config'][5]['name'] = 'canuseredit';
$modversion['config'][5]['title'] = '_MI_USEREDITTITLE';
$modversion['config'][5]['description'] = '_MI_USEREDITDESC';
$modversion['config'][5]['formtype'] = 'select';
$modversion['config'][5]['valuetype'] = 'int';
$modversion['config'][5]['default'] = "1";
$modversion['config'][5]['options'] = array(_NO => 0, _YES => 1);


// If not, go to this URL when user tries to make changes

$modversion['config'][6]['name'] = 'howtochange';
$modversion['config'][6]['title'] = '_MI_HOWTOCHANGETITLE';
$modversion['config'][6]['description'] = '_MI_HOWTOCHANGEDESC';
$modversion['config'][6]['formtype'] = 'text';
$modversion['config'][6]['valuetype'] = 'string';

// allow comments?

$modversion['config'][7]['name'] = 'allowcomments';
$modversion['config'][7]['title'] = '_MI_ALLOWCOMMENTSTITLE';
$modversion['config'][7]['description'] = '_MI_ALLOWCOMMENTSDESC';
$modversion['config'][7]['formtype'] = 'select';
$modversion['config'][7]['valuetype'] = 'int';
$modversion['config'][7]['default'] = "1";
$modversion['config'][7]['options'] = array(_NO => 0, _YES => 1);

// List config

$modversion['config'][8]['name'] = 'listformat';
$modversion['config'][8]['title'] = '_MI_LISTFORMAT';
$modversion['config'][8]['description'] = '_MI_LISTFORMATDESC';
$modversion['config'][8]['formtype'] = 'select';
$modversion['config'][8]['valuetype'] = 'int';
$modversion['config'][8]['default'] = "1";
$modversion['config'][8]['options'] = array(_MI_COMMAS => 0, _MI_BULLETS => 1);

// Can User Upload

$modversion['config'][9]['name'] = 'useruploads';
$modversion['config'][9]['title'] = '_MI_ALLOWUPLOADS';
$modversion['config'][9]['description'] = '_MI_ALLOWUPLOADSDSC';
$modversion['config'][9]['formtype'] = 'yesno';
$modversion['config'][9]['valuetype'] = 'int';
$modversion['config'][9]['default'] = 0;

// Upload Maximum File Size

$modversion['config'][10]['name'] = 'maxfilesize';
$modversion['config'][10]['title'] = '_MI_MAXFILESIZE';
$modversion['config'][10]['description'] = '_MI_MAXFILESIZEDSC';
$modversion['config'][10]['formtype'] = 'textbox';
$modversion['config'][10]['valuetype'] = 'int';
$modversion['config'][10]['default'] = 200000;

// Upload Maximum Image Width

$modversion['config'][11]['name'] = 'maximgwidth';
$modversion['config'][11]['title'] = '_MI_IMGWIDTH';
$modversion['config'][11]['description'] = '_MI_IMGWIDTHDSC';
$modversion['config'][11]['formtype'] = 'textbox';
$modversion['config'][11]['valuetype'] = 'int';
$modversion['config'][11]['default'] = 300;

// Upload Maximum Image Height

$modversion['config'][12]['name'] = 'maximgheight';
$modversion['config'][12]['title'] = '_MI_IMGHEIGHT';
$modversion['config'][12]['description'] = '_MI_IMGHEIGHTDSC';
$modversion['config'][12]['formtype'] = 'textbox';
$modversion['config'][12]['valuetype'] = 'int';
$modversion['config'][12]['default'] = 600;

// Should Garage use categories

$modversion['config'][13]['name'] = 'usecats';
$modversion['config'][13]['title'] = '_MI_USECATS';
$modversion['config'][13]['description'] = '_MI_USECATSDESC';
$modversion['config'][13]['formtype'] = 'select';
$modversion['config'][13]['valuetype'] = 'int';
$modversion['config'][13]['default'] = "0";
$modversion['config'][13]['options'] = array(_NO => 0, _YES => 1);

// Allow users to have more than one Garage?

$modversion['config'][14]['name'] = 'multiplegarage';
$modversion['config'][14]['title'] = '_MI_MULTIPLEGARAGE';
$modversion['config'][14]['description'] = '_MI_MULTIPLEGARAGEDESC';
$modversion['config'][14]['formtype'] = 'select';
$modversion['config'][14]['valuetype'] = 'int';
$modversion['config'][14]['default'] = "0";
$modversion['config'][14]['options'] = array(_NO => 0, _YES => 1);

// Allow image settings For Add Garage or only for Edit Garage?

$modversion['config'][15]['name'] = 'addimages';
$modversion['config'][15]['title'] = '_MI_ADDIMAGES';
$modversion['config'][15]['description'] = '_MI_ADDIMAGESDESC';
$modversion['config'][15]['formtype'] = 'select';
$modversion['config'][15]['valuetype'] = 'int';
$modversion['config'][15]['default'] = "0";
$modversion['config'][15]['options'] = array(_NO => 0, _YES => 1);

// Allow user to link to their xoops garage

$modversion['config'][16]['name'] = 'linkgarage';
$modversion['config'][16]['title'] = '_MI_LINKGARAGE';
$modversion['config'][16]['description'] = '_MI_LINKGARAGEDESC';
$modversion['config'][16]['formtype'] = 'select';
$modversion['config'][16]['valuetype'] = 'int';
$modversion['config'][16]['default'] = "0";
$modversion['config'][16]['options'] = array(_NO => 0, _YES => 1);

// Use Additional Description

$modversion['config'][17]['name'] = 'usedescript2';
$modversion['config'][17]['title'] = '_MI_USEDESCRIPT2';
$modversion['config'][17]['description'] = '_MI_USEDESCRIPT2DESC';
$modversion['config'][17]['formtype'] = 'select';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = "0";
$modversion['config'][17]['options'] = array(_NO => 0, _YES => 1);

// Name of List field

$modversion['config'][18]['name'] = 'listname';
$modversion['config'][18]['title'] = '_MI_LIST_T';
$modversion['config'][18]['description'] = '_MI_LIST_D';
$modversion['config'][18]['formtype'] = 'textbox';
$modversion['config'][18]['valuetype'] = 'string';
$modversion['config'][18]['default'] = _MI_LIST;

?>
