<?php include_once("../common/mysqli_conneCT_media.php");include_once("../common/config.php");
$iWebTVType=1;$sWebTVHeading="";$sWebTVLinkCode="";$iContentID=1;

if(isset($_REQUEST["videoinfo"])){
	$iContentID=$_REQUEST["videoinfo"];

	$iContentID=filter_var($iContentID, FILTER_SANITIZE_NUMBER_INT);
	$iContentID=filter_var($iContentID, FILTER_VALIDATE_INT);
	$sSQL="SELECT WebTVType, WebTVHeading, WebTVLinkCode, DATE_FORMAT(DateTimeInserted, '%d %M %Y %W, %h:%i &nbsp;%p') AS fDateTimeInserted FROM tv_webtv WHERE WebTVID=".$iContentID." AND Deletable=1 LIMIT 1";
    //echo $sSQL; die();
}else{
	$sSQL="SELECT WebTVType, WebTVHeading, WebTVLinkCode, DATE_FORMAT(DateTimeInserted, '%d %M %Y %W, %h:%i &nbsp;%p') AS fDateTimeInserted FROM tv_webtv WHERE Deletable=1 ORDER BY WebTVID DESC LIMIT 1";
}

//echo $sSQL; die();
$resultSQL=@mysqli_query($connEMM, $sSQL);
$rsSQL=@mysqli_fetch_assoc($resultSQL);
//echo $rsSQL["WebTVLinkCode"]; die();
$iWebTVType=$rsSQL["WebTVType"];
$sWebTVHeading=$rsSQL["WebTVHeading"];
$sWebTVLinkCode=$rsSQL["WebTVLinkCode"];
$sDateTimeInserted=$rsSQL["fDateTimeInserted"];
@mysqli_free_result($resultSQL);

$sURL=$sSiteURL.$_SERVER["REQUEST_URI"]; ?>
<!doctype html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sWebTVHeading; ?></title>

<meta name="description" content="<?php echo $sWebTVHeading; ?>">
<meta name="keywords" content="<?php echo $sWebTVHeading; ?>">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sSiteName;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="<?php echo $sAppId; ?>">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sWebTVHeading; ?>">
<meta property="og:description" content="<?php echo $sWebTVHeading; ?>">
<meta property="og:url" content="<?php echo $sURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="https://img.youtube.com/vi/<?php echo $sWebTVLinkCode; ?>/maxresdefault.jpg">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon;?>">

<?php echo $sCSSBootStrap;
echo $sCSSFontAwesome;
echo $sCSSEMMBn;
echo $sCSSSolaimanLipi; ?>
</head>
<body>
<?php include_once("../common/headerGallery.php");?>
<div class="container-fluid">
<div class="row MarginTop10"><div class="col-sm-12">
	<ol class="breadcrumb">
		<li><a href="<?php echo $sSiteURL; ?>">Home <i class="fa fa-angle-double-right"></i> </a></li>
		<li class="active">Video Gallery</li>
	</ol>
</div></div>
<div class="row">
	<div class="col-lg-8 col-sm-12 offset-lg-2">
<!--		<div class="row MarginTop10"><div class="col-sm-12 DSocialTop"><div class="addthis_inline_share_toolbox"></div></div></div>-->
		<div class="row mt-3"><div class="col-md-12">
            <div class="embed-responsive embed-responsive-16by9 DMarginBottom20"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $sWebTVLinkCode; ?>?autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
		</div></div>
        <h2 class="DVideoInnerTitle"><?php echo $sWebTVHeading; ?></h2>
        <div class="row">
            <div class="col-sm-12 hidden-print">
                <div class="DShareThis">
                    <!--                                <div class="addthis_inline_share_toolbox"></div>-->
                    <!--                            -->
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 offset-lg-3 text-center mt-3">   <div class="sharethis-inline-share-buttons"></div> </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
    <div class="row"><div class="col-sm-12 mt-4 mb-3"><h4><a href="<?php echo $sSiteURL; ?>videogallery/archives">Video Gallery Archives</a> &raquo;</h4></div></div>
    <div class="row">
    <?php $sSQL="SELECT WebTVID, WebTVType, WebTVHeading, WebTVLinkCode FROM tv_webtv WHERE Deletable=1 ORDER BY WebTVID DESC LIMIT 10";
    $resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
    while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
    $iWebTVID=1;$sWebTVHeading="";$sWebTVLinkCode="";
    $iWebTVID=$rsSQL["WebTVID"];
    $sWebTVHeading=$rsSQL["WebTVHeading"];
    $sWebTVLinkCode=$rsSQL["WebTVLinkCode"]; ?>
	<div class="col-md-3 MarginTop10">
		<div class="panel panel-primary">
			<div class="panel-body paddingLeftRight0">
				<div class="row"><div class="col-sm-12 mb-3">
					<a href="<?php echo $sSiteURL; ?>videogallery?videoinfo=<?php echo $iWebTVID; ?>">
					<img src="http://img.youtube.com/vi/<?php echo $sWebTVLinkCode; ?>/0.jpg" alt="<?php echo $sWebTVHeading; ?>" title="<?php echo $sWebTVHeading; ?>" class="img-fluid img100">
                    <i class="fa fa-play video_icon" style="padding: 10px;"></i>
                    <h5 class="pt-2"><?php echo $sWebTVHeading; ?></h5></a>
				</div></div>

			</div>
		</div>
	</div>
    <?php }@mysqli_free_result($resultSQL); ?>
</div>
</div>
<?php include_once("../common/footer.php");@mysqli_close($connEMM); ?>

<?php echo $sBackUpTop; ?>

<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->

<?php echo $sPopper; ?>
<?php echo $sJSEMM; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<?php echo $sJSEMM; ?>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d3c27929b66a80012923a02&product=inline-share-buttons' async='async'></script>
</body>
</html>