<?php include_once("../common/mysqli_conneCT.php");include_once("../common/config.php");
$iAlbumID="";$sAlbumName="";

if(isset($_REQUEST["albuminfo"])){
	$iContentID=$_REQUEST["albuminfo"];
	$iContentID=filter_var($iContentID, FILTER_SANITIZE_NUMBER_INT);
	$iContentID=filter_var($iContentID, FILTER_VALIDATE_INT);
	$sSQL="SELECT AlbumID, AlbumName FROM p_album WHERE AlbumID=".$iContentID." AND Deletable=1 LIMIT 1";
}else{
	$sSQL="SELECT AlbumID, AlbumName FROM p_album WHERE Deletable=1 ORDER BY AlbumID DESC LIMIT 1";
}
$resultSQL=@mysqli_query($connEMM, $sSQL) or die("");
if(@mysqli_num_rows($resultSQL)<=0){
	$sSQL="SELECT AlbumID, AlbumName FROM p_album WHERE Deletable=1 ORDER BY AlbumID DESC LIMIT 1";
	$resultSQL=@mysqli_query($connEMM, $sSQL) or die("");
}
//echo $sSQL;
$rsSQL=@mysqli_fetch_assoc($resultSQL);
$iAlbumID=$rsSQL["AlbumID"];
$sAlbumName=$rsSQL["AlbumName"];
@mysqli_free_result($resultSQL);

$sSQL="SELECT ImagePath FROM p_photo WHERE Deletable=1 AND AlbumID=".$iAlbumID." LIMIT 1";
$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
$rsSQL=@mysqli_fetch_assoc($resultSQL);
$sImageFullPath=$sSiteURL."media/PhotoGallery/".$rsSQL["ImagePath"];
@mysqli_free_result($resultSQL);

$sURL=$sSiteURL.$_SERVER["REQUEST_URI"]; ?>
<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sAlbumName; ?></title>

<meta name="description" content="<?php echo $sAlbumName; ?>">
<meta name="keywords" content="<?php echo $sAlbumName; ?>">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sSiteName;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="<?php echo $sAppId; ?>">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sAlbumName; ?>">
<meta property="og:description" content="<?php echo $sAlbumName; ?>">
<meta property="og:url" content="<?php echo $sURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sImageFullPath; ?>">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon;?>">

<?php echo $sCSSBootStrap;
echo $sCSSFontAwesome;
echo $sCSSEMM;
echo $sCSSSolaimanLipi; ?>

<link rel="stylesheet" type="text/css" href="<?php echo $sSiteURL; ?>common/ekko-lightbox/ekko-lightbox.min.css">
<style type="text/css">
.top-header{margin-bottom:100px;}
figure{position:relative;}
figure figcaption{font-size:22px;color:#fff;text-decoration:none;bottom:10px;right:20px;position:absolute;background-color:#000;}
code{white-space:pre-wrap; /*css-3*/
white-space:-moz-pre-wrap; /*Mozilla, since 1999*/
white-space:-pre-wrap; /*Opera 4-6*/
white-space:-o-pre-wrap; /*Opera 7*/
word-wrap:break-word; /*IE5.5+*/
}
</style>
</head>
<body>
<?php include_once("../common/headerGallery.php");?>

<main>
<div class="container">
<div class="row MarginTop15">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $sSiteURL; ?>">প্রচ্ছদ /</a></li>
			<li class="active">ফটো গ্যালারি</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3><?php echo $sAlbumName; ?></h3>
		<div class="row"><div class="col-sm-12 marginTB10">
			<?php $iCounter=0;$sSQL="SELECT PhotoID, Caption, ImagePath FROM p_photo WHERE Deletable=1 AND AlbumID=".$iAlbumID;
			$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
			while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
				$iPhotoID=$rsSQL["PhotoID"];
				$sCaption=$rsSQL["Caption"];
				$sImagePath=$rsSQL["ImagePath"];
				$sImageFullPath=$sSiteURL."media/PhotoGallery/".$sImagePath;
				if($iCounter==4){echo '</div></div><div class="row MarginTop30"><div class="col-sm-12">';$iCounter=0;} ?>
				<a href="<?php echo $sImageFullPath; ?>" data-toggle="lightbox" data-gallery="<?php echo $sAlbumName; ?>" data-title="<?php echo $sCaption; ?>" class="col-sm-3">
				<img src="<?php echo $sImageFullPath; ?>" class="img-thumbnail">
				<p><?php echo $sCaption; ?></p>
				</a>
			<?php $iCounter++;}@mysqli_free_result($resultSQL); ?>
		</div></div>

		<div class="row"><div class="col-sm-12 DSocialTop"><div class="addthis_inline_share_toolbox"></div></div></div>
	</div>
</div>


<div class="row MarginTop30"><div class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
			<div class="col-sm-6"><h4 class="panel-title">অন্যান্য ফটো গ্যালারি</h4></div>
			<div class="col-sm-6 text-right"><a href="<?php echo $sSiteURL; ?>photogallery/archives.php">ফটো গ্যালারি আর্কাইভস</a> &raquo;</div>
			</div>
		</div>
		<div class="panel-body">
		<div class="row MarginTop30">
			<?php $iCounter=0;$sSQL="SELECT p_album.AlbumID, p_album.AlbumName, p_photo.ImagePath FROM p_photo INNER JOIN p_album ON p_album.AlbumID=p_photo.AlbumID WHERE p_album.Deletable=1 AND p_photo.Deletable=1 AND p_photo.ImageType=1 GROUP BY p_photo.AlbumID ORDER BY p_photo.AlbumID DESC LIMIT 12";
			$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
			while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
			$sAlbum=$rsSQL["AlbumName"];
			if($iCounter==4){echo '</div><div class="row MarginTop30">';$iCounter=0;} ?>
			<div class="col-sm-3">
				<a href="index.php?albuminfo=<?php echo $rsSQL["AlbumID"]; ?>">
				<img class="img-fluid img100" src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsSQL["ImagePath"]; ?>" alt="<?php echo $sAlbum; ?>" title="<?php echo $sAlbum; ?>">
				<h5><?php echo $sAlbum; ?></h5>
				</a>
			</div>
			<?php $iCounter++;}@mysqli_free_result($resultSQL); ?>
		</div>
	</div>
</div></div>

</div>
</div>
</main>

<?php include_once("../common/footer.php");@mysqli_close($connEMM); ?>


<?php echo $sBackUpTop; ?>
<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<?php echo $sJSEMM; ?>

<?php echo $sAddThis; ?>
<script type="text/javascript" src="<?php echo $sSiteURL; ?>common/ekko-lightbox/ekko-lightbox.min.js"></script>
<script type="text/javascript">
$(document).on('click', '[data-toggle="lightbox"]', function(event){
	event.preventDefault();
	$(this).ekkoLightbox();
});
</script>
</body>
</html>