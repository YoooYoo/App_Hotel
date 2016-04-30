<?php
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
        <priority>1</priority>
    </url>

 <?php foreach($cms as $url) { ?>
    <url>
        <loc><?php echo base_url().$url->page_slug; ?></loc>
        <priority>1</priority>
    </url>
    <?php }

    foreach($hotels as $h) { ?>
    <url>
        <loc><?php echo base_url()."hotels/".$h->hotel_slug; ?></loc>
 <description>   <![CDATA[   <?php echo $h->hotel_meta_desc; ?>]]></description>
        <priority>1</priority>
    </url>
    <?php }
     foreach($cruises as $cruise) { ?>
    <url>
        <loc><?php echo base_url()."cruises/".$cruise->cruise_slug; ?></loc>
 <description>   <![CDATA[   <?php echo $cruise->cruise_meta_desc; ?>]]></description>
        <priority>1</priority>
    </url>
    <?php }
    foreach($cars as $car) { ?>
    <url>
        <loc><?php echo base_url()."cruises/".$car->car_slug; ?></loc>
 <description>   <![CDATA[   <?php echo $car->car_meta_desc; ?>]]></description>
        <priority>1</priority>
    </url>
    <?php }

    foreach($tours as $tslug) { ?>
    <url>
        <loc><?php echo base_url()."tours/".$tslug->tour_slug; ?></loc>
       <description>   <![CDATA[   <?php echo $tslug->tour_meta_desc; ?>]]></description>
        <priority>1</priority>
    </url>
    <?php } ?>


</urlset>
