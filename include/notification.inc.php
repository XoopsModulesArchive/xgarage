<?php
// $Id$
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
if (!defined('XOOPS_ROOT_PATH')) {
	trigger_error ('Access not found');
	exit('Access not found');
}
	$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;

function garage_notify_iteminfo($category, $item_id)
{

	
	if ($category=='global') {
		$item['name'] = '';
		$item['url'] = '';
		return $item;
	}
	global $xoopsDB, $mydirname;
	
	if ($category=='category') {

		// Assume we have a valid topid id
		$sql = 'SELECT name  FROM '. $xoopsDB->prefix('garage_cats') .' WHERE cid = '. intval($item_id) .' limit 1';
		$result = $xoopsDB->query($sql); // TODO: error check
		$result_array = $xoopsDB->fetchArray($result);
		$item['name'] = $result_array['name'];		
		$item['url'] = XOOPS_URL . '/modules/' . $mydirname . '/index.php?cid=' .  $item_id;
		return $item;
		} else {
			return null;
		}
	

	if ($category=='listing') {
		// Assume we have a valid post id
		$sql = 'SELECT name FROM ' . $xoopsDB->prefix('garage').  ' WHERE id = ' . intval($item_id) . ' LIMIT 1';
		$result = $xoopsDB->query($sql);
		$result_array = $xoopsDB->fetchArray($result);
		$item['name'] = $result_array['name'];
//		$item['catname'] = $result_array['cat.title'];
		$item['url'] = XOOPS_URL . '/modules/' . $mydirname . '/index.php?op=view&amp;gid= ' .  intval($item_id);
		return $item;
		} else {
			return null;
		}
	}


?>