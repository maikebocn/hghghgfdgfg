<?php
header('HTTP/1.1 200 OK');
$domains = $_SERVER['HTTP_HOST'];
$permalinkx	=	$_SERVER['REQUEST_URI'];
$permalinky	=	explode('?',$permalink);
$permalinky	=	$permalinky[0];
$permalink	=       explode('/',$permalinkx);
$permalinkz     =	$permalink[2];
$permalink	=	$permalink[2];
$permalink	=	explode('?',$permalink);
$permalink	=	$permalink[0];
$titlenya    	= 	str_replace(array('/','-','+','-'),' ',$permalink);
$titlenya      =       ucwords(str_replace('-', ' ', $titlenya));
$judul		=	$titlenya;
include('config.php');
include ('fungsi.php');
$q = $_GET['q'];
$keyword = bersih($q);
$cano = $domain.'/'.sanitize_title2($q);
$data = ambil_gambar($keyword);
$rating = number_format(rand( 50, 500));
?>


<!doctype html>

<html lang="<?php echo $lang; ?>">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $judul.' - '.$site_desc; ?></title>
        <meta property="og:title" content="<?php echo $judul.' - '.$site_desc; ?>">
        <meta property="og:description" content="Image Galleries for <?php echo $judul; ?>. Download all images of <?php echo $keyword; ?> for free at <?php echo $domen; ?>">
        <meta name="description" content="Image Galleries for <?php echo $judul; ?>. Download all images of <?php echo $judul; ?> for free at <?php echo $domen; ?>">
        <link rel="canonical" href="<?php echo $cano; ?>" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <?php include('css.php'); ?>
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
    color: orange;
}
</style>
	
    </head>
    <body>
        <?php include('header.php'); ?>

        <div class="container">
            <ol xmlns:v="http://rdf.data-vocabulary.org/#" class="breadcrumb">
                <li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="/">Home</a></li>
                <li><?php echo $keyword; ?></li>
            </ol>
            <div class="ads">

            </div>
            <?php if(empty($data) || $data == false) {
                echo '<h1>Not Found</h1>';
            }
            else { ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="thumbnail" style="background-image: url('<?php echo $data[0]['thumb']; ?>'); background-color: #cccccc; background-size: cover; background-repeat: no-repeat; background-position: center center;width:100%;height:auto;min-height:300px">
                        <img src="<?php echo "http://i0.wp.com/".str_replace(array('http://','https://'), '', $data[0]['link'])."?quality=80&strip=all"; ?>" alt="<?php echo $keyword; ?>" />
                        <noscript><img src="<?php echo "http://i0.wp.com/".str_replace(array('http://','https://'), '', $data[0]['link'])."?quality=80&strip=all"; ?>" alt="<?php echo $keyword; ?>" /></noscript>
                    </div>
                    <div class="ads">
<!- Pasang Iklan Disini -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info">
                    <h1 class="entry-title"><a href="<?php echo $cano; ?>" rel="bookmark"><?php echo $keyword; ?></a></h1>

                    
                                        <hr>
										<!-- <span class="fa fa-star checked"></span> 
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span> -->
                    <span style=color:#666;font-size:small><div itemscope itemtype=http://data-vocabulary.org/Review-aggregate><span itemprop=itemreviewed><?php echo $domains; ?></span> <img itemprop=photo src=""> <span itemprop=rating itemscope itemtype=http://data-vocabulary.org/Rating><span itemprop=average>9</span> out of <span itemprop=best>10</span></span> based on <span itemprop=votes><?php echo number_format(rand( 100, 1000)); ?></span> ratings. <span itemprop=count><?php echo number_format(rand( 1000, 5000)); ?></span> user reviews.</div></span>
					</div>
                    <div class="relatedkey clearfix">
                    <h4>Related to <?php echo $keyword; ?></h4>
					

							<?php echo randomKeywords() ;?>	
                    </div>
                </div>
            </div>

			<h3>Tag</h3>
		<?php echo tag() ;?>
            <div class="striped text-center">

<?php
function limit_words($string, $word_limit)
{
$words = explode(" ",$string);
return implode(" ",array_splice($words,0,$word_limit));
}
?>

<?php
echo '';
  $firstx = ($nav - 1) * 10;
  $firstx = $firstx + 1; 
  $urlrss    = 'http://www.bing.com/search?q='.urlencode(limit_words($judul,5)).'&count=10&first='.$firstx.'&format=rss';
  $feedbing  = simplexml_load_string(BingText($urlrss));
   foreach ($feedbing->channel->item as $itembing):
       $titled	= $itembing->title;
       $tit	= $itembing->title;
$titled		= str_replace(array('www','/','-','+','-','%7C','jpg','php','gif','html','Blogspot','Com','.com','http','Wikipedia','Wikipédia','YouTube','Amazon'),' ',$titled);
       $url = sanitize_title($titled);
       $desced	= $itembing->description;
$desced		= str_replace(array('www','/','-','+','-','%7C','jpg','php','gif','html','Blogspot','Com','.com','http','Wikipedia','Wikipédia','YouTube','Amazon'),' ',$desced);
       $pubded	= $itembing->pubDate; 
  echo  '<strong>'.$titled.'</strong><br>'.$desced.'<br>';
endforeach;
	?>
            <h2><?php echo $keyword; ?> Gallery</h2>
			<br>
            <div class="panel panel-default">
<!-- Iklan Adsense disini -->

            </div>

            <div class="row"> 
            <?php
                if($data !== false) {
                    foreach($data as $i) {
                        echo "<div class=\"galeri col-xs-6 col-sm-4 col-md-3\">\n";
                        echo "<a title=\"".$i['judul']."\" href=\"http://i0.wp.com/".str_replace(array('http://','https://'), '', $i['link'])."?quality=80&strip=all\"><div class=\"thumbnail\" style=\"background-image: url('".$i['thumb']."'); background-color: #cccccc; background-size: cover; background-repeat: no-repeat; background-position: center center;width:230px;height:130px;\"><noscript><img src=\"".$i['link']."\" alt=\"".$i['judul']."\"/></noscript></div></a>\n";
                        echo "<h3>".$i['judul']."</h3>\n";
                        echo "<h3><a href=\"/".$single."/".sanitize_title2($i['judul'])."\" title=\"".$i['judul']."\">".$i['judul']."</a></h3>\n";
                        echo "</div>\n";
                    }
                }
            ?>
            </div>
            </div>
            <?php } ?>
        </div>
		<center><h5>Another Wiring Diagram Related With <?php echo $keyword; ?></h5></center>
		<?php echo tag() ;?>
		<?php echo tag() ;?>
		<?php echo tag() ;?>
        <?php include('footer.php'); ?>
<?php
	if(!preg_match('/bot|crawl|spy|spider|crawl|link|media|partner/isU', $_SERVER['HTTP_USER_AGENT'])) {
		include('pop.php');
	}
?>
    </body>
</html>