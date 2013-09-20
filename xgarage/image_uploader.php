<?php
		//image uploader
		if($_FILES['uploadimage']['name'] <> ""){
			include_once '../../class/uploader.php';
			
			$upload_path = XOOPS_UPLOAD_PATH . "/" . "garage";
			if(!is_dir($upload_path)) mkdir($upload_path);
			$allowed_mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');
			$maxfilesize = $xoopsModuleConfig['maxfilesize'];
			$maxfilewidth = $xoopsModuleConfig['maximgwidth'];
			$maxfileheight = $xoopsModuleConfig['maximgheight'];
			$uploader = new XoopsMediaUploader($upload_path, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);
			if ($uploader->fetchMedia($_POST["xoops_upload_file"][0])) {
				if (!$uploader->upload()) {
					//echo $uploader->getErrors();
					$errmsg = $uploader->getErrors();
				} else {
					//echo '<h4>File uploaded successfully!</h4>';
					$msg = '<h4>'._MD_PR_UPLOADSUCCESS.'</h4>';
					//echo 'Saved as: ' . $uploader->getSavedFileName() . '<br />';
					$uploadimage = $uploader->getSavedFileName();
					
					$newname = time()."_".$uploadimage;
					
					if (rename($upload_path."/".$uploadimage,$upload_path."/".$newname)){
						$uploadimage = $newname;
					}
					//echo 'Full path: ' . $uploader->getSavedDestination();
				}
			} else {
				$errmsg = $uploader->getErrors();
			}
		}
?>