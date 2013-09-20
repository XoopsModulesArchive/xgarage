<?php
define("_AM_GARAGES_INDEX", "Index");
define("_AM_GARAGES_OPTS", "Preferences");
define("_AM_GARAGES_GOMOD", "Go to module");
define("_AM_GARAGES_DOCS", "Documentation");
define("_AM_GARAGES_MODADMIN", "Admin :");
define("_AM_GARAGES_ADDNEWGARAGE", "Submit");
define("_AM_GARAGES_APPROVE", "Approve");
define("_AM_GARAGES_DISABLED", "Disabled");
define("_AM_GARAGES_CATEGORIES", "Categories");

define("_AM_GARAGES_SUPPORT", "Support");
define("_AM_GARAGES_DONATIONS", "Donations");
define("_AM_DOCS","Garages Module Documentation");
define("_AM_SUPPORT","You can get free support in our online forums. We also welcome any suggestions.");
define("_AM_SUPPORT_REGISTERED","Free registration is required to access support.");
define("_AM_INTRO","Help keep this module rolling by donating to the project!");
define("_AM_NONENEW", "There are currently no garage needing approval.");
define("_AM_NONEDISABLED", "There are currently no disabled garage.");
define("_AM_NONEACTIVE", "There are currently no live garage.");

define("_AM_DELETECAT","Delete Category: ");
define("_AM_DELETE","Delete");
define("_AM_CONTENTEXISTS","You cannot delete this category branch while content exists within its structure.<br/>There are %s item(s) that need to be moved or deleted first.");
define("_AM_RENAMECAT","Rename Category:");
define("_AM_RENAME","Rename");
define("_AM_CATEGORYRENAMED","Category renamed successfully.");
define("_AM_CATEGORYRENAMEERROR","There was an error renaming this category.");

define("_AM_CATEGORYADDED","The new category has been added.");
define("_AM_CATEGORYADDERROR","There was an error adding the category.");

define("_AM_CONFIRMDELETE","Are you sure you want to delete this garage and it's comments?");
define("_AM_ITEMDELETED","Garage and comments deleted successfully.");
define("_AM_ITEMNOTDELETED","There was an error with deleting this garage.");

define("_AM_CATDELETED","Category deleted successfully.");
define("_AM_CATNOTDELETED","There was an error with deleting this category.");

define("_AM_NEWCATNAME","New Category Name:");
define("_AM_PARENT","Parent:");
define("_AM_ADDNEWCAT","Add New Category");
define("_AM_MOVECAT","Move this category under:");
define("_AM_MOVECATSUBMIT","Move Category");
define("_AM_MOVENO","Category was not moved.");
define("_AM_CATEGORYMOVED","Category was moved successfully.");
define("_AM_CATEGORYMOVEERROR","There was an error moving this category.");
define("_AM_CATEGORYMOVEINTO","Cannot move a category into itself.");
define("_AM_CONFIRMDELCATS","Are you sure you want to delete these categories?");

define("_MD_XG_APPROVESUCCESS","This garage has been approved.");
define("_MD_XG_APPROVEFAILURE","There was an error approving this garage.");

define("_MD_XG_MUSTLOGADMIND","You must be logged in as admin to disable garage.");
define("_MD_XG_MUSTLOGADMINE","You must be logged in as admin to enable garage.");

define("_AM_GARAGEDISABLED","Garage has been disabled.");
define("_AM_GARAGEENABLED","Garage has been enabled.");
define("_AM_DISABLEFAILURE","There was an error with disbaling this garage.");
define("_AM_ENABLEFAILURE","There was an error with enabling this garage.");

// Added for group permissions
define("_AM_GARAGES_PERMISSIONS","Permissions");
define('_AM_GARAGES_PERMADDNG', 'Could not add %s permission to %s for group %s');
define('_AM_GARAGES_PERMADDOK','Added %s permission to %s for group %s');
define('_AM_GARAGES_PERMRESETNG','Could not reset group permission for module %s');
define('_AM_GARAGES_PERMADDNGP', 'All parent items must be selected.');
define("_AM_GARAGES_GPERM_G_ADD" , "Can add" ) ;
define("_AM_GARAGES_CAT2GROUPDESC" , "Check categories which you allow to access" ) ;
define("_AM_GARAGES_GROUPPERMDESC" , "Select group(s) allowed to submit listings." ) ;
define("MI_GARAGES_GROUPPERM", "Submit Permissions");
define("_AM_GARAGES_VIEWFORM", "View Permissions");
define("_AM_GARAGES_SUBMITFORM", "Submit Permissions");
define("_AM_GARAGES_VIEWFORM_DESC", "Select, who can view a category");
define("_AM_GARAGES_SUBMITFORM_DESC", "Select, who can submit a listing");

//Changes and additions by jlm69 v .05
define("_AM_XG_RACING", "Show racing times in this category");
define("_AM_XG_DOCUMENTATION", "Documentation");
define("_AM_XG_CREDITS", "Credits");
define("_AM_XG_ADMIN_MAN", "Administration Manual");
define("_AM_XG_USER_MAN", "User Manual");
define("_AM_XG_DOC_SUPPORT", "Live Docs and support at X-Garage");
define("_AM_XG_DOC_HEAD", "Garages Module for XOOPS 2.0 Documentation");
define("_AM_XG_DOC_FORUM", "Garages Module for XOOPS Support Forum");
define("_AM_XG_ADMIN", "Administration");
define("_AM_XG_USERS", "Users");
define("_AM_XG_CODEDBY", "Concept, Coded and Maintained");
define("_AM_XG_TRANSLATORS", "Translators: ");
define("_AM_XG_UPDATEMODULE", "Update the Module Now");
define("_AM_XG_UPGR_ACCESS_ERROR", "Error, to use the upgrade script, you must be an admin on this module");
define("_AM_XG_UPGRADECOMPLETE", "Upgrade Complete");
define('_AM_XG_UPGRADEFAILED', 'Upgrade Failed');
define('_AM_XG_UPGRADEFAILED0', "Please note the messages and try to correct the problems with phpMyadmin and the sql definition's file available in the 'sql' folder of the garage module");
?>