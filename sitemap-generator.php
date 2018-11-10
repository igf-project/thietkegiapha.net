<?php
ini_set('display_errors',1);
include_once('includes/gfinnit.php');
require_once('includes/gfconfig.php');
include_once('libs/cls.mysql.php');
include_once('libs/cls.category.php');
include_once('libs/cls.content.php');
$count=1;
$data='<?xml version="1.0" encoding="UTF-8"?>';
$data.='<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
//----------CREAT SITE MAP FOR HOME---------------/			
$data.='<url>';
$data.='<loc>'.ROOTHOST.'</loc>';
$data.='<changefreq>daily</changefreq>';
$data.="</url>\n";
//----------CREAT SITE MAP FOR CATEGORY---------------/
$objcat=new CLS_CATE;
$objcat->getList();
while($r=$objcat->Fetch_Assoc()){
	$count++;
	$link=ROOTHOST.$r['alias'].'/';
	$data.='<url>';
	$data.='<loc>'.$link.'</loc>';
	$data.='<changefreq>daily</changefreq>';
	$data.="</url>\n";
}
//----------CREAT SITE MAP FOR CONTENT---------------/
$objcon=new CLS_CONTENTS;
$objcon->getList(' ', 'ORDER BY `con_id` ASC');
while($r=$objcon->Fetch_Assoc()){
	$count++;
	$link=ROOTHOST.$r['code'].'.html';
	$data.='<url>';
	$data.='<loc>'.$link.'</loc>';
	$data.='<changefreq>never</changefreq>';
	$data.="</url>\n";
}

$data.='</urlset>';
echo "<p align='center'><h3>Create sitemap.xml success! </h3><h4>Update: $count links</h4></p>";
file_put_contents("sitemap.xml",$data);
?>