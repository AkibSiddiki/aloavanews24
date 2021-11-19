<?php session_cache_expire(60);session_start();include_once("../common/mysqli_conneCT.php");include_once("../common/config.php");
$iCategoryID=0;$sDate="";
if(isset($_REQUEST["dtDate"])){
	$sDate=$_REQUEST["dtDate"];
	if( (strlen($sDate)<10) || (strlen($sDate)>10) ){echo '<meta http-equiv="refresh" content="0;https://www.daily-bangladesh.com/archives/">';}
}
if(isset($_REQUEST["catid"])){
	$iCategoryID=$_REQUEST["catid"];
	if( (strlen($iCategoryID)<1) || (strlen($iCategoryID)>2) ){echo '<meta http-equiv="refresh" content="0;https://www.daily-bangladesh.com/archives/">';}
	$_SESSION["sessCatID"]=$iCategoryID;
}
if(!isset($_SESSION["sessCatID"])){
	$_SESSION["sessCatID"]=$iCategoryID;
}
if($_SESSION["sessCatID"]>0){
	$qCategory="SELECT CategoryName, Remarks FROM bn_bas_category WHERE CategoryID=".$_SESSION["sessCatID"];
	$resultCategory=@mysqli_query($connEMM, $qCategory) or die("1:Archive temporary unavailable. We will back soon.");
	if(@mysqli_num_rows($resultCategory)<=0){
		$_SESSION["sessCatID"]=1;
		$qCategory="SELECT CategoryName, Remarks FROM bn_bas_category WHERE CategoryID=".$_SESSION["sessCatID"];
		$resultCategory=@mysqli_query($connEMM, $qCategory) or die("2:Archive temporary unavailable. We will back soon.");
	}
	$rsCategory=@mysqli_fetch_assoc($resultCategory);
	@mysqli_free_result($resultCategory);

	$sCategory=$rsCategory["CategoryName"];
	$sCatRemarks=$rsCategory["Remarks"];
}elseif($_SESSION["sessCatID"]==0){
	$sCategory="";
	$sCatRemarks="archive";
}

$rowsPerPage=24;$pageNum=1;
if(isset($_REQUEST["page"])){
	$pageNum=fFormatString($_REQUEST["page"]);
	$pageNum=filter_var($pageNum, FILTER_SANITIZE_NUMBER_INT);
	$pageNum=filter_var($pageNum, FILTER_VALIDATE_INT);
	if(!is_numeric($pageNum)){$pageNum=1;}
	if($pageNum<1){$pageNum=1;}
}

$offset=($pageNum-1)*$rowsPerPage;
$pageNumBn=fEn2Bn($pageNum);
if($pageNum==1){$sArchives=" আর্কাইভস - ";}else{$sArchives=" আর্কাইভস - ";}
$sCurrURL=$sSiteURL."archive";
$sCanoURL=$sSiteURLM."archive"; ?>
<!doctype html>
<html lang="en">
<head>
<?php
echo $sGAnalytics;
echo $sGAnalytics2;
if($_SERVER["HTTP_X_FORWARDED_FOR"]!="118.67.221.226"){echo $sGAdsence;}
echo $sAlexa;
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sCategory.$sArchives.$pageNumBn; ?></title>

<meta name="description" content="<?php echo $sSiteDescription; ?>">
<meta name="keywords" content="<?php echo $sSiteKeywords; ?>">

<meta http-equiv="refresh" content="300">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="416387992241868">
<meta property="fb:pages" content="433659713676324">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta property="og:description" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta property="og:url" content="<?php echo $sCurrURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb;?>">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sCanoURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon; ?>">
<link type="image/x-icon" rel="icon" href="<?php echo $sFavicon; ?>">

<script type="text/javascript">if(screen.width<736){window.location="<?php echo $sCanoURL; ?>";}</script>

<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSSolaiman; ?>
<?php echo $sCSSEMM; ?>

<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
$(function(){$("#datepicker").datepicker();});
$(function(){
	$("#datepicker").datepicker({changeMonth: true,changeYear: true});
	$("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
});
</script>
</head>

<body>
<?php echo $sFB; ?>

<div class="container">
	
<?php include_once("../common/headerGallery.php");?>

<main>
<div class="row DMarginTop20">
	<div class="col-sm-8 paddingLeft0">

		<ol class="breadcrumb">
			<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg Golden" aria-hidden="true"></i></a></li>
			<li class="active"><a href="<?php if($_SESSION["sessCatID"]==0){echo $sCurrURL;}else{echo $sSiteURL.$_SESSION["sessCatID"]."/".$sCatRemarks;} ?>">আর্কাইভস</a></li>
		</ol>

		<div class="row"><div class="col-sm-12 MarginTop20 text-center">
			<?php $resultCategory=@mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die("3:Archive temporary unavailable. We will back soon."); ?>
			<form name="frmArchives" method="post" action="<?php echo $sSiteURL; ?>archives/" class="form-inline">
			<div class="form-group">
				<select name="catid" class="form-control cboCatName">
					<option value="0">সকল খবর</option>
					<?php while($rsCategory=@mysqli_fetch_assoc($resultCategory)){ ?>
					<option value="<?php echo $rsCategory["CategoryID"]; ?>" <?php if($rsCategory["CategoryID"]==$_SESSION["sessCatID"]){echo "selected";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
					<?php }@mysqli_free_result($resultCategory); ?>
				</select>
			</div>
			<div class="form-group">
				<label for="dtDate"> তারিখ:</label>
				<input type="text" id="datepicker" name="dtDate" class="form-control date" value="<?php if(isset($_REQUEST["dtDate"])){echo $sDate;}?>">
			</div>
			<button type="submit" class="btn btn-primary btnSearch">খুঁজুন</button>
			</form> 
		</div></div>

		<div class="row"><div class="col-sm-12">
			<?php
			if( ($_SESSION["sessCatID"]==0) && ($sDate=="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ContentDetails, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($_SESSION["sessCatID"]>0) && ($sDate=="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ContentDetails, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND bn_content.CategoryID=".$_SESSION["sessCatID"]." ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($_SESSION["sessCatID"]==0) && ($sDate!="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ContentDetails, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND DATE(bn_content.DateTimeInserted)='".$sDate."' ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($_SESSION["sessCatID"]>0) && ($sDate!="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ContentDetails, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND bn_content.CategoryID=".$_SESSION["sessCatID"]." AND DATE(bn_content.DateTimeInserted)='".$sDate."' ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}
			//echo $qContent."<br>";
			$resultContent=@mysqli_query($connEMM, $qContent) or die("4:Archive temporary unavailable. We will back soon.");
			while($rsContent=@mysqli_fetch_assoc($resultContent)){
			$sContentID="";$sCatURL="";$sCatName="";$sHead="";$sSubHead="";$sBrief="";$sURL="";$sImg="";
			if($rsContent["ContentID"]!=""){$sContentID=$rsContent["ContentID"];}
			if($rsContent["CategoryName"]!=""){$sCatName=$rsContent["CategoryName"];}
			$sCatURL=$sSiteURL.$rsContent["CategoryID"]."/".$rsContent["Slug"]."/";
			if($rsContent["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsContent["ContentSubHeading"].'</span><br>';}
			if($rsContent["ContentHeading"]!=""){$sHead=$rsContent["ContentHeading"];}
			if($rsContent["ContentBrief"]!=""){$sBrief=$rsContent["ContentBrief"];}else{$sBrief=fGetWordsCount($rsContent["ContentDetails"], 30);}
			if($rsContent["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsContent["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsContent["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsContent["URLAlies"]).'/'.$rsContent["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsContent["ContentID"];}
			$sDateTime=$rsContent["fDateTimeInserted"]; ?>

			<div class="DCategoryListNews MarginTop20 something2">
				<div class="row">
					<div class="col-sm-4">
						<div class="arrow-right2"><span><a href="<?php echo $sCatURL; ?>"><?php echo $sCatName; ?></a></span></div>
						<div class="DArchivesRSize"><a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a></div>
					</div>
					<div class="col-sm-8">
						<a href="<?php echo $sURL; ?>"><?php echo $sSubHead; ?>
						<p class="pHead"><?php echo $sHead; ?></p></a>
						<?php echo $sBrief; ?>
						<p class="pDate"><?php echo fEn2Bn($sDateTime); ?></p>
					</div>
				</div>
			</div>
			<?php }@mysqli_free_result($resultContent); ?>
		</div></div>

		<div class="row MarginTop20">
			<div class="row">
				<?php if($_SESSION["sessCatID"]>0){$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE CategoryID=".$_SESSION["sessCatID"]." AND ShowContent=1 AND Deletable=1";
				}else{$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE ShowContent=1 AND Deletable=1";}
				$result=@mysqli_query($connEMM, $qCoutner) or die("Error...");
				$row=@mysqli_fetch_assoc($result);
				$numrows=$row["numrows"];
				$maxPage=ceil($numrows/$rowsPerPage);
				$self=$_SERVER["PHP_SELF"];$nav="";
				$da='';
				if(isset($_REQUEST['dtDate'])){
					$da='&dtDate='.$sDate;
				}
				$page=1;
				if(($pageNum-3)>0) $page=$pageNum-3;
				for($page;$page<=min($maxPage, ($pageNum+3));$page++){
					if($page==$pageNum){
						$nav.="<li class='active'> <a href='#''>$page</a> </li>";
					}else{
						if($_SESSION["sessCatID"]>0){
							$nav.="<li> <a href='".$sSiteURL."archives/$page/article/'>$page</a> </li>";
						}else{
							$nav.="<li> <a href='".$sSiteURL."archives/$page/article/'>$page</a> </li>";
						}
					}
				}
				if($pageNum>1){
					$page=$pageNum-1;
					if($_SESSION["sessCatID"]>0){
						$prev="<li><a href='".$sSiteURL."archives/$page/article'>পূর্ববর্তী</a> </li>";
						$first="<li><a href='".$sSiteURL."archives/1/article/'>প্রথম পৃষ্ঠা</a> </li>";
					}else{
						$prev="<li><a href='".$sSiteURL."archives/$page/article'>পূর্ববর্তী</a> </li>";
						$first="<li><a href='".$sSiteURL."archives/1/article'>প্রথম পৃষ্ঠা</a> </li>";
					}
				}else{
					$prev="<li class='disabled'><a href='#'>পূর্ববর্তী</a> </li>";
					$first="<li class='disabled'><a href='#'>প্রথম পৃষ্ঠা</a></li>";
				}
				if($pageNum<$maxPage){
					$page=$pageNum+1;
					if($_SESSION["sessCatID"]>0){
						$next="<li><a href='".$sSiteURL."archives/$page/article/'>পরবর্তী</a> </li>";
						$last="<li><a href='".$sSiteURL."archives/$maxPage/article/'>শেষ পৃষ্ঠা</a> </li>";
					}else{
						$next="<li><a href='".$sSiteURL."archives/$page/article'>পরবর্তী</a> </li>";
						$last="<li><a href='".$sSiteURL."archives/$maxPage/article'>শেষ পৃষ্ঠা</a> </li>";
					}
				}else{
					$next="<li class='disabled'><a href='#'>পরবর্তী</a> </li>";
					$last="<li class='disabled'><a href='#'>প্রথম পৃষ্ঠা</a> </li>";
				}
				@mysqli_free_result($result); ?>
				<div class="pag">
					<ul class="pagination">
					<?php echo $first; ?>
					<?php echo $prev; ?>
					<?php echo $nav; ?>
					<?php echo $next; ?>
					<?php echo $last; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="row DMarginTop20"><div class="col-sm-12">
			<div class="fb-page" data-href="https://www.facebook.com/DailyBangladeshOnline/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/DailyBangladeshOnline/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DailyBangladeshOnline/">Daily Bangladesh</a></blockquote></div>
		</div></div>

	<div class="DTabPanel">
		<div class="tabs">
			<ul role="tablist" aria-label="Entertainment" class="tab_list_block">
				<li role="tab" aria-selected="false" aria-controls="agnes-tab" id="agnes"  class="tab_li" tabindex="-1">শীর্ষ খবর</li>
				<li role="tab" aria-selected="false" aria-controls="complexcomplex" id="complex"  class="tab_li" tabindex="-1" data-deletable="">সর্বশেষ</li>
				<li role="tab" aria-selected="false" aria-controls="complexcomplex2" id="complex2"  class="tab_li" tabindex="-1" data-deletable="">জনপ্রিয় </li>
			</ul>
			<div tabindex="0" role="tabpanel" id="agnes-tab" aria-labelledby="agnes" >
				<ul class="LatestNewsList h-285"><?php include_once("../xhtml/bn_spe_ShirshoNews.htm"); ?></ul>
			</div>
			<div tabindex="0" role="tabpanel" id="complexcomplex" aria-labelledby="complex"  hidden="">
				<ul class="LatestNewsList h-285"><?php include_once("../xhtml/bn_liLatestNews.htm"); ?></ul>
			</div>
			<div tabindex="0" role="tabpanel" id="complexcomplex2" aria-labelledby="complex2" hidden="">
				<ul class="LatestNewsList h-285"><?php include_once("../xhtml/bn_liMostPopular.htm"); ?></ul>
			</div>
		</div>
	</div>


	</div>
</div>
</main>
<?php include_once("../common/footer.php");
@mysqli_close($connEMM); ?>
</div>
<?php include_once("../common/scrollBreaking.php"); ?>
<div id="loadAdd" class="modal  fade" role="dialog">
  <div class="modal-dialog modal-lg">
	<!-- Modal content-->
	<div class="modal-content">	 
	  <div class="modal-body">
		<button type="button" class="close-add" data-dismiss="modal">&times;</button>
		<img src="https://www.daily-bangladesh.com/media/common/popup.jpg" class="img-responsive">
	  </div>
	</div>
  </div>
</div>


<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->
<link rel="stylesheet" href="https://www.daily-bangladesh.com/common/FlipClock-master/compiled/flipclock.css?dt=767682">
<script src="https://www.daily-bangladesh.com/common/FlipClock-master/compiled/flipclock.js?dt=66"></script>
<?php echo $sJSEMM; ?>
<?php echo $sJSEMMT; ?>


<script type="text/javascript">
$(window).load(function(){
//setTimeout(function(){$('#loadAdd').modal('show'); }, 500);
});
$(document).ready(function(){
//setTimeout(function(){$('#loadAdd').modal('hide'); }, 6000);
})
</script>
</body>
</html>