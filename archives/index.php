<?php session_cache_expire(60);session_start();include_once("../common/mysqli_conneCT_english.php");include_once("../common/config.php");
$iCategoryID=0;$sDate="";
if(isset($_REQUEST["dtDate"])){
	$sDate=$_REQUEST["dtDate"];
	if( (strlen($sDate)<10) || (strlen($sDate)>10) ){echo '<meta http-equiv="refresh" content="0;https://www.businessinsiderbd.com/archives/">';}
}
if(isset($_REQUEST["catid"])){
	$iCategoryID=$_REQUEST["catid"];
	if( (strlen($iCategoryID)<1) || (strlen($iCategoryID)>2) ){echo '<meta http-equiv="refresh" content="0;https://www.businessinsiderbd.com/archives/">';}
	$_SESSION["sessCatID"]=$iCategoryID;
}
if(!isset($_SESSION["sessCatID"])){
	$_SESSION["sessCatID"]=$iCategoryID;
}
if($_SESSION["sessCatID"]>0){
	$qCategory="SELECT CategoryName, Remarks FROM en_bas_category WHERE CategoryID=".$_SESSION["sessCatID"];
	$resultCategory=@mysqli_query($connEMM, $qCategory) or die("1:Archive temporary unavailable. We will back soon.");
	if(@mysqli_num_rows($resultCategory)<=0){
		$_SESSION["sessCatID"]=1;
		$qCategory="SELECT CategoryName, Remarks FROM en_bas_category WHERE CategoryID=".$_SESSION["sessCatID"];
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
if($pageNum==1){$sArchives=" Archives - ";}else{$sArchives=" Archives - ";}
$sCurrURL=$sSiteURL."archive";?>
<!doctype html>
<html lang="en">
<head>

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

<meta property="fb:app_id" content="2689491844415645">
<meta property="fb:pages" content="2689491844415645">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta property="og:description" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta property="og:url" content="<?php echo $sCurrURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb;?>">
<meta property="og:locale" content="en_US">

<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon; ?>">
<link type="image/x-icon" rel="icon" href="<?php echo $sFavicon; ?>">


<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSSolaimanLipi; ?>
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
<?php echo $sFbRoot; ?>

<div class="container">
	
<?php include_once("../common/headerGallery.php");?>

<main>
<div class="row DMarginTop20">
	<div class="col-sm-8 paddingLeft0">

		
	    <div class="InnerCatTitle">
            <a href="<?php echo $sSiteURL; ?>" class="Initial">Home</a><svg class="svg-inline--fa fa-angle-double-right fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-double-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"></path></svg><a href="<?php echo $sSiteURL; ?>archives" class="Category">Archives</a>
        </div>

		<div class="row"><div class="col-sm-12 MarginTop20 text-center">
			<?php $resultCategory=@mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM en_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die("3:Archive temporary unavailable. We will back soon."); ?>
			<form name="frmArchives" method="post" action="<?php echo $sSiteURL; ?>archives/" class="form-inline">
			<div class="form-group">
				<select name="catid" class="form-control cboCatName">
					<option value="0">All News</option>
					<?php while($rsCategory=@mysqli_fetch_assoc($resultCategory)){ ?>
					<option value="<?php echo $rsCategory["CategoryID"]; ?>" <?php if($rsCategory["CategoryID"]==$_SESSION["sessCatID"]){echo "selected";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
					<?php }@mysqli_free_result($resultCategory); ?>
				</select>
			</div>
			<div class="form-group">
				<label for="dtDate"> Date:</label>
				<input type="text" id="datepicker" name="dtDate" class="form-control date" value="<?php if(isset($_REQUEST["dtDate"])){echo $sDate;}?>">
			</div>
			<button type="submit" class="btn btn-primary btnSearch">Search</button>
			</form> 
		</div></div>

		<div class="row"><div class="col-sm-12">
			<?php
			if( ($_SESSION["sessCatID"]==0) && ($sDate=="") ){
				$qContent="SELECT en_content.ContentID, en_content.CategoryID, en_bas_category.CategoryName, en_bas_category.Slug, en_content.ContentHeading, en_content.DetailsHeading, en_content.ContentSubHeading, en_content.ContentBrief, en_content.ContentDetails, en_content.ImageSMPath, en_content.URLAlies, DATE_FORMAT(en_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM en_content INNER JOIN en_bas_category ON en_bas_category.CategoryID=en_content.CategoryID WHERE en_content.ShowContent=1 AND en_content.Deletable=1 ORDER BY en_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($_SESSION["sessCatID"]>0) && ($sDate=="") ){
				$qContent="SELECT en_content.ContentID, en_content.CategoryID, en_bas_category.CategoryName, en_bas_category.Slug, en_content.ContentHeading, en_content.DetailsHeading, en_content.ContentSubHeading, en_content.ContentBrief, en_content.ContentDetails, en_content.ImageSMPath, en_content.URLAlies, DATE_FORMAT(en_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM en_content INNER JOIN en_bas_category ON en_bas_category.CategoryID=en_content.CategoryID WHERE en_content.ShowContent=1 AND en_content.Deletable=1 AND en_content.CategoryID=".$_SESSION["sessCatID"]." ORDER BY en_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($_SESSION["sessCatID"]==0) && ($sDate!="") ){
				$qContent="SELECT en_content.ContentID, en_content.CategoryID, en_bas_category.CategoryName, en_bas_category.Slug, en_content.ContentHeading, en_content.DetailsHeading, en_content.ContentSubHeading, en_content.ContentBrief, en_content.ContentDetails, en_content.ImageSMPath, en_content.URLAlies, DATE_FORMAT(en_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM en_content INNER JOIN en_bas_category ON en_bas_category.CategoryID=en_content.CategoryID WHERE en_content.ShowContent=1 AND en_content.Deletable=1 AND DATE(en_content.DateTimeInserted)='".$sDate."' ORDER BY en_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($_SESSION["sessCatID"]>0) && ($sDate!="") ){
				$qContent="SELECT en_content.ContentID, en_content.CategoryID, en_bas_category.CategoryName, en_bas_category.Slug, en_content.ContentHeading, en_content.DetailsHeading, en_content.ContentSubHeading, en_content.ContentBrief, en_content.ContentDetails, en_content.ImageSMPath, en_content.URLAlies, DATE_FORMAT(en_content.DateTimeInserted, '%H:%i %e %M %Y') AS fDateTimeInserted FROM en_content INNER JOIN en_bas_category ON en_bas_category.CategoryID=en_content.CategoryID WHERE en_content.ShowContent=1 AND en_content.Deletable=1 AND en_content.CategoryID=".$_SESSION["sessCatID"]." AND DATE(en_content.DateTimeInserted)='".$sDate."' ORDER BY en_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}
			//echo $qContent."<br>";
			$resultContent=@mysqli_query($connEMM, $qContent) or die("4:Archive temporary unavailable. We will back soon.");
			while($rsContent=@mysqli_fetch_assoc($resultContent)){
			$sContentID="";$sCatURL="";$sCatName="";$sHead="";$sHeadDetails="";$sSubHead="";$sHeadDetails="";$sBrief="";$sURL="";$sImg="";
			$sContentID=$rsContent["ContentID"];
			$sCatName=$rsContent["CategoryName"];
			$sSlug=$rsContent["Slug"];
			$sCatURL=$sSiteURL.$rsContent["CategoryID"]."/".$sSlug."/";
			if($rsContent["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsContent["ContentSubHeading"].'</span><br>';}
			$sHead=$rsContent["ContentHeading"];
			$sHeadDetails=$rsContent["DetailsHeading"];
			if($sHeadDetails!=""){$sHeadShow=$sHeadDetails;}else{$sHeadShow=$sHead;}
			if($rsContent["ContentBrief"]!=""){$sBrief=$rsContent["ContentBrief"];}else{$sBrief=fGetWordsCount($rsContent["ContentDetails"], 30);}
			if($rsContent["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsContent["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			$sURL=$sSiteURL.fFormatURL($sSlug)."/".$rsContent["ContentID"];
			$sDateTime=$rsContent["fDateTimeInserted"]; ?>

						<div class="DCategoryListNews MarginTop20 something2">
				<div class="row">
					<div class="col-sm-4">
						<div class="DArchivesRSize"><a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a></div>
					</div>
					<div class="col-sm-8">
					    <div class="arrow-right2"><span><a href="<?php echo $sCatURL; ?>" style="font-size: 20px;color: forestgreen;"><?php echo $sCatName; ?></a></span></div>
						<a href="<?php echo $sURL; ?>"><?php echo $sSubHead; ?>
						<p class="pHead"><?php echo $sHeadShow; ?></p></a>
						<?php echo $sBrief; ?>
						<p class="pDate"><?php echo $sDateTime; ?></p>
					</div>
				</div>
			</div>
			<?php }@mysqli_free_result($resultContent); ?>
		</div></div>

		<div class="row MarginTop20">
			<div class="row">
				<?php if($_SESSION["sessCatID"]>0){$qCoutner="SELECT COUNT(ContentID) AS numrows FROM en_content WHERE CategoryID=".$_SESSION["sessCatID"]." AND ShowContent=1 AND Deletable=1";
				}else{$qCoutner="SELECT COUNT(ContentID) AS numrows FROM en_content WHERE ShowContent=1 AND Deletable=1";}
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
						$prev="<li><a href='".$sSiteURL."archives/$page/article'>Previous</a> </li>";
						$first="<li><a href='".$sSiteURL."archives/1/article/'>First Page</a> </li>";
					}else{
						$prev="<li><a href='".$sSiteURL."archives/$page/article'>Previous</a> </li>";
						$first="<li><a href='".$sSiteURL."archives/1/article'>First Page</a> </li>";
					}
				}else{
					$prev="<li class='disabled'><a href='#'>Previous</a> </li>";
					$first="<li class='disabled'><a href='#'>First Page</a></li>";
				}
				if($pageNum<$maxPage){
					$page=$pageNum+1;
					if($_SESSION["sessCatID"]>0){
						$next="<li><a href='".$sSiteURL."archives/$page/article/'>Next</a> </li>";
						$last="<li><a href='".$sSiteURL."archives/$maxPage/article/'>Last Page</a> </li>";
					}else{
						$next="<li><a href='".$sSiteURL."archives/$page/article'>Next</a> </li>";
						$last="<li><a href='".$sSiteURL."archives/$maxPage/article'>Last Page</a> </li>";
					}
				}else{
					$next="<li class='disabled'><a href='#'>Next</a> </li>";
					$last="<li class='disabled'><a href='#'>First Page</a> </li>";
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
		<div class="row MarginTop15">
					<div class="col-sm-12">
                    <?php echo $sFbPage; ?>
                    </div>
				</div>

        	<section class="DLPSTab2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">সর্বশেষ</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">জনপ্রিয়</a>
								</li>
							</ul>
						</div>
						<div class="panel-body PanelHeight">
							<div class="tab-content">
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<ul class="LatestList2"><?php include_once("../xhtml/en_liLatestNews.htm"); ?></ul>
								</div>
								<div class="tab-pane" id="tabs-2" role="tabpanel">
									<ul class="LatestList2"><?php include_once("../xhtml/en_liMostPopular.htm"); ?></ul>
								</div>
							</div>
						</div>
				</section>
					</div>


	</div>
</div>
</main>

</div>
<?php include_once("../common/footer.php");@mysqli_close($connEMM); ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->
<?php echo $sJSEMM; ?>
<?php echo $sJSEMMT; ?>
<script src="jQuery.loadScroll.js"></script>
<script>
	// For Lazy Load
$(function() {
	// Custom fadeIn Duration
	$('img').loadScroll(300);
});
</script>
</body>
</html>