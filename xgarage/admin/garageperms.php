<?php
// $Id$
// ------------------------------------------------------------------------ //
// XOOPS - PHP Content Management System            				        //
// Copyright (c) 2000 XOOPS.org                           					//
// <http://www.xoops.org/>                             						//
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// 																			//
// You may not change or alter any portion of this comment or credits       //
// of supporting developers from this source code or any supporting         //
// source code which is considered copyrighted (c) material of the          //
// original comment or credit authors.                                      //
// 																			//
// This program is distributed in the hope that it will be useful,          //
// but WITHOUT ANY WARRANTY; without even the implied warranty of           //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
// GNU General Public License for more details.                             //
// 																			//
// You should have received a copy of the GNU General Public License        //
// along with this program; if not, write to the Free Software              //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------ //
include_once("admin_header.php");
include_once("functions.php");
include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
include_once XOOPS_ROOT_PATH . "/modules/".$xoopsModule->getVar("dirname")."/class/mygrouppermform.php";


xoops_cp_header();
adminMenu(5, _AM_GARAGES_PERMISSIONS);


$permtoset= isset($_POST['permtoset']) ? intval($_POST['permtoset']) : 1;
$selected=array('','','');
$selected[$permtoset-1]=' selected';
echo "<br /><br />";
echo "<form method='post' name='gselperm' action='garageperms.php'><div><select name='permtoset' onChange='javascript: document.gselperm.submit()'><option value='1'".$selected[0].">"._AM_GARAGES_VIEWFORM."</option><option value='2'".$selected[1].">"._AM_GARAGES_SUBMITFORM."</option></select></div></form>";
$module_id = $xoopsModule->getVar('mid');

switch($permtoset)
{
	case 1:
		$title_of_form = _AM_GARAGES_VIEWFORM;
		$perm_name = "garage_view";
		$perm_desc = _AM_GARAGES_VIEWFORM_DESC;
		$item_list_view = array();
        $block_view = array(); 
        $result_view = $xoopsDB->query("SELECT cid, name FROM " . $xoopsDB->prefix("garage_cats") . " ");
        if ($xoopsDB->getRowsNum($result_view)) {
            while ($myrow_view = $xoopsDB->fetcharray($result_view)) {
                $item_list_view['cid'] = $myrow_view['cid'];
                $item_list_view['name'] = $myrow_view['name'];
	$permform = new MyXoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);
		$block_view[] = $item_list_view;
               foreach ($block_view as $itemlists) {
                    $permform->addItem($itemlists['cid'], $myts->displayTarea($itemlists['name']));
               }
	}
}
		break;

	case 2:
		$title_of_form = _AM_GARAGES_SUBMITFORM;
		$perm_name = "garage_submit";
		$perm_desc = _AM_GARAGES_SUBMITFORM_DESC;
		$item_list_view = array();
        $block_view = array(); 
        $result_view = $xoopsDB->query("SELECT cid, name FROM " . $xoopsDB->prefix("garage_cats") . " ");
        if ($xoopsDB->getRowsNum($result_view)) {
            while ($myrow_view = $xoopsDB->fetcharray($result_view)) {
                $item_list_view['cid'] = $myrow_view['cid'];
                $item_list_view['name'] = $myrow_view['name'];
	$permform = new MyXoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);
		$block_view[] = $item_list_view;
                foreach ($block_view as $itemlists) {
                    $permform->addItem($itemlists['cid'], $myts->displayTarea($itemlists['name']));
               }
	}
}
		break;

}

echo $permform->render();
echo "<br /><br /><br /><br />\n";
unset ($permform);

xoops_cp_footer();
?>
