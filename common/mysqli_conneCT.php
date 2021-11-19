<?php
define("DB_HOST","localhost");define("DB_USER","root");define("DB_PASSWORD","");define("DB_NAME","emm_news_site");
define("DB_HOSTAudit","localhost");define("DB_USERAudit","root");define("DB_PASSWORDAudit","");define("DB_NAMEAudit","emm_news_site_audit");

global $connEMM;

if(@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Please try after a while...")){
	$connEMM=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Please try after a while...");
	if($connEMM){
		@mysqli_query($connEMM, "SET CHARACTER SET utf8");
		@mysqli_query($connEMM, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
} ?>