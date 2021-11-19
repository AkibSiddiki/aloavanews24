<?php ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);
/*define("DB_HOST","localhost");define("DB_USER","root");define("DB_PASSWORD","");define("DB_NAME","com_english"); //Local
define("DB_HOSTAudit","localhost");define("DB_USERAudit","root");define("DB_PASSWORDAudit","");define("DB_NAMEAudit","com_audit");
define("DB_HOSTGeneral","localhost");define("DB_USERGeneral","root");define("DB_PASSWORDGeneral","");define("DB_NAMEGeneral","com_general");*/
//define("DB_HOST","localhost");define("DB_USER","risingbd_samnay_en");define("DB_PASSWORD","SEm07na6#9yr8DoRJa");define("DB_NAME","risingbd_english");define("DB_PORT","25060"); //Web

define("DB_HOST","localhost");define("DB_PORT","3306");define("DB_USER","businessIns_root");define("DB_PASSWORD","9_z9fTbTQB5A");define("DB_NAME","businessIns_english"); //Web
define("DB_HOSTAudit","localhost");define("DB_PORTAudit","3306");define("DB_USERAudit","businessIns_root");define("DB_PASSWORDAudit","9_z9fTbTQB5A");define("DB_NAMEAudit","businessIns_audit"); //Web
define("DB_HOSTGeneral","localhost");define("DB_PORTGeneral","3306");define("DB_USERGeneral","businessIns_root");define("DB_PASSWORDGeneral","9_z9fTbTQB5A");define("DB_NAMEGeneral","businessIns_general"); //Web

global $connEMM, $connEMMAudit, $connEMMGeneral, $dtDateTime;

if(@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORT) or die("Please try after a while...")){
	$connEMM=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORT) or die("Please try after a while...");
	if($connEMM){
		@mysqli_query($connEMM, "SET CHARACTER SET utf8mb4");
		@mysqli_query($connEMM, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}

if(@mysqli_connect(DB_HOSTAudit, DB_USERAudit, DB_PASSWORDAudit, DB_NAMEAudit,DB_PORTAudit) or die("Please try after a while...")){
	$connEMMAudit=@mysqli_connect(DB_HOSTAudit, DB_USERAudit, DB_PASSWORDAudit, DB_NAMEAudit,DB_PORTAudit) or die("Please try after a while...");
	if($connEMMAudit){
		@mysqli_query($connEMMAudit, "SET CHARACTER SET utf8");
		@mysqli_query($connEMMAudit, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}

if(@mysqli_connect(DB_HOSTGeneral, DB_USERGeneral, DB_PASSWORDGeneral, DB_NAMEGeneral,DB_PORTGeneral) or die("Please try after a while...")){
	$connEMMGeneral=@mysqli_connect(DB_HOSTGeneral, DB_USERGeneral, DB_PASSWORDGeneral, DB_NAMEGeneral,DB_PORTGeneral) or die("Please try after a while...");
	if($connEMMGeneral){
		@mysqli_query($connEMMGeneral, "SET CHARACTER SET utf8");
		@mysqli_query($connEMMGeneral, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}

?>