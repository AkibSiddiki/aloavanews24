<?php include_once("../common/mysqli_conneCT_media.php");include_once("../common/config.php");
$rowsPerPage=50;$iPageNum=1;
if(isset($_REQUEST["page"])){
    $iPageNum=$_REQUEST["page"];
    $iPageNum=filter_var($iPageNum, FILTER_SANITIZE_NUMBER_INT);
    $iPageNum=filter_var($iPageNum, FILTER_VALIDATE_INT);
}
$sURL=$sSiteURL.$_SERVER["REQUEST_URI"]; ?>
<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Video Gallery Archives <?php if($iPageNum>1){echo " - ".$iPageNum;} ?></title>

    <meta name="description" content="Video Gallery Archives <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">
    <meta name="keywords" content="Video Gallery Archives <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">

    <meta http-equiv="refresh" content="600">
    <meta name="author" content="<?php echo $sSiteName;?>">

    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="googlebot-news" content="index, follow">

    <meta property="fb:app_id" content="<?php echo $sAppId; ?>">
    <meta property="og:site_name" content="<?php echo $sSiteName;?>">
    <meta property="og:title" content="Video Gallery Archives <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">
    <meta property="og:description" content="Video Gallery Archives <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">
    <meta property="og:url" content="<?php echo $sURL; ?>">
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?php echo $sLogoURLfb; ?>">
    <meta property="og:locale" content="en_US">

    <link rel="canonical" href="<?php echo $sURL; ?>">
    <link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon;?>">

    <?php echo $sCSSBootStrap;
    echo $sCSSFontAwesome;
    echo $sCSSEMM;
    echo $sCSSSolaimanLipi; ?>
</head>
<body>
<?php include_once("../common/headerGallery.php");?>
<div class="container">

    <div class="row MarginTop15"><div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo $sSiteURL; ?>">Home / </a></li>
                <li><a href="<?php echo $sSiteURL; ?>videogallery/">Video Gallery / </a></li>
                <li class="active">Video Gallery Archives</li>
            </ol>
        </div></div>

    <div class="row"><div class="col-md-12" style="padding: 5px 20px;">
            <h2 style="font-size: 24px;line-height: 50px;text-align: center;">Video Gallery Archives</h2>
            <div class="row marginTB10">
                <?php $offset=($iPageNum-1)*$rowsPerPage;
                $iFlag=0;$sSQL="SELECT WebTVID, WebTVType, WebTVHeading, WebTVLinkCode FROM tv_webtv WHERE Deletable=1 ORDER BY WebTVID DESC LIMIT $offset, $rowsPerPage";
                $resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
                while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
                    $iWebTVID=$rsSQL["WebTVID"];
                    $sWebTVHeading=$rsSQL["WebTVHeading"];
                    $sWebTVLinkCode=$rsSQL["WebTVLinkCode"];
                    if($iFlag==4){echo '</div><div class="row marginTB10">';$iFlag=0;} ?>
                    <div class="col-sm-3 mb-3">
                        <a href="<?php echo $sSiteURL; ?>videogallery?videoinfo=<?php echo $iWebTVID; ?>">
                            <img src="http://img.youtube.com/vi/<?php echo $sWebTVLinkCode; ?>/0.jpg" alt="<?php echo $sWebTVHeading; ?>" title="<?php echo $sWebTVHeading; ?>" class="img-fluid img100">
                            <i class="fa fa-play video_icon" style="padding: 10px;margin-top: -10px;"></i>
                            <p class="pt-2"><?php echo $sWebTVHeading; ?></p>
                        </a>
                    </div>
                    <?php $iFlag++;}@mysqli_free_result($resultSQL); ?>
            </div>
        </div></div>

    <div class="row"><div class="col-md-12">
            <?php $result=@mysqli_query($connEMM, "SELECT COUNT(WebTVID) AS numrows FROM tv_webtv WHERE Deletable=1") or die("");
            $row=@mysqli_fetch_assoc($result);
            $numrows=$row["numrows"];
            $maxPage=ceil($numrows/$rowsPerPage);
            $self=$_SERVER["PHP_SELF"];
            $nav="";

            for($page=1;$page<=$maxPage;$page++){if($page==$iPageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}}
            if($iPageNum>1){
                $page=$iPageNum-1;
                $prev=" <a href=\"$self?page=$page\"><span class='SPrev'> আগে</span></a> ";
                $first=" <a href=\"$self?page=1\"><span class='SFirst'> প্রথম</span></a> ";
            }else{$prev="&nbsp;";$first="&nbsp;";}
            if($iPageNum<$maxPage){
                $page=$iPageNum+1;
                $next=" <a href=\"$self?page=$page\"><span class='SNext'>পরে</span></a> ";
                $last=" <a href=\"$self?page=$maxPage\"><span class='SLast'> শেষ </span></a> ";
            }else{$next="&nbsp;";$last="&nbsp;";}
            @mysqli_free_result($result); ?>
            <div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
        </div></div>
</div>
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
</body>
</html>