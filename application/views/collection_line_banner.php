<?php

// echo "collection_selected LINE: " . __LINE__ . ", FILE: ". __FILE__ ."<br>";
// echo "<pre>";
// print_r($collection_selected);
// echo "</pre>";

// collection ID 32 is Lisa Slayman
if( $collection_selected == 32 ) { 
    
    $banner_descr_off = "<p class='justified-text'>Crafted with meticulous attention to detail by celebrated designer Lisa Slayman, the equestrian
    inspired textile collection delivers a unique combination of elegance, sophisticated quality
    and construction.</p>
    <p class='justified-text'>Discover the artistry and dedication woven into every piece that reflects the
    Opuzen ethos of opulence and zen.</p>";

    $banner_descr = "Crafted with meticulous attention to detail by celebrated designer Lisa Slayman, the equestrian
    inspired textile collection delivers a unique combination of elegance, sophisticated quality
    and construction.
    <br />
    <br />
    Discover the artistry and dedication woven into every piece that reflects the
    Opuzen ethos of opulence and zen. <br /><br />";


    $assets_base_uri = "https://opuzen-web-assets-public.s3.us-west-1.amazonaws.com/showcase/images/collection";
    //$assets_base_uri = "/showcase/images/collection"
    
?>

<style>

.collection-line-banner {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    /*padding: 20px;*/
    color: #fhfhfh;
}

.collection-line-banner .logo img {
    width: 300px;
    margin: 2em 0 2em 0;
}

.collection-line-banner .logo {
    margin-bottom: 20px;
}



.banner-img {
    width:100%;
}

.banner-img img {
    width: 100%;
}
    
.collection-line-banner .download-catalog {
    width:100%;
    margin: 20px 0;
}
    
.collection-line-banner .download-catalog a {
    color: white;
    text-decoration: none;
    background: #BFAC02;
    font-size: 0.85em;
}

.collection-text {
    font-family: Verdana, Geneva, sans-serif;
    color: white;
    line-height: 29px;
    font-size: 13px;
    margin: 0 auto;
} 

.justified-text {
    text-align: justify;
    hyphens: none; 
    letter-spacing: 0.7px; 
    word-spacing: 0px; 
}

.justified-text::after {
    /* This helps to justify the last line properly */
    content: "";
    display: inline-block;
    width: 100%;
}

@media (min-width: 590px) and (max-width: 1050px) {
    .content-container {
        padding: 50px !important;
    }
}

@media (max-width: 590px) {

    .filter-wrapper {
        display: none;
    }

    .collection-line-banner {
        padding: 0px;
        text-align: center;
    }

    .collection-line-banner .logo img {
        width: 94%;
        margin: 5em 0 3em 0;
    }

    .collection-line-banner .banner-img img {
        width: 100%;
        height: auto;
    }

    .collection-line-banner .download-catalog a {
        /* font-size: 1em; */
        /* padding: 12px 18px; */
        margin: 2em 0 2em 1.275em;
        float: left;
    }

    .justified-text {
        font-size: 0.9em;
    }
   
    /* For centering  */
    .products-container {
        margin: 0 auto;
        width: 100%;
    }

    .product-wrap.mr-2.my-1.pkl {
        margin: 1em .5em 1em .5em;
        width: 100%;
        padding: 0 0 2em .5em;
        height: 16em;
        left: 0em;
    }
    .product-wrap.mr-2.my-1.pkl a {
        display: block;
        width: 100%;
        /*border: 1px solid green;*/
        height: 10em;
        margin: 0em 0 0em 0;
        position: relative;
        left: 0em;
    }

    .product-wrap.mr-2.my-1.pkl a img {
        width: 100%;
    }

    .is_new_sticker img {
        display: block !important;
        position: relative !important;
        top: -9em;
        left: 15em;
        width: 20% !important;
    }
   
    .text-preview.pkl .pull-right {
        float: none;
        margin: 0 0 0 20em;
        width: 100%;
        /* border: 1px solid yellow; */
    }

    /*.is_new_sticker img {
        display: block !important;
        position: relative !important;
        top: -6em;
        left: 10em;
    }*/

    .filter-wrapper .d-flex.flex-wrap {
        position: relative;
        left: 5em;
    }

    .collection-line-banner .logo img {
        width: 340px;
        margin: 4em 0 3em 0;
    }

    .banner-img {
        width: 92%;
        margin: 0 auto;
    }

    .filter-wrapper .fixrow {
        margin: 0 0 0 2em !important;
    }

    .product-wrap .text-preview div {
        font-size: 14px;
        text-transform: uppercase;
        margin-top: 2px;
        color: white;
        position: relative;
        top: -4em;
    }

    .text-justify {

    }

    .justified-text {
        text-align: justify;
        hyphens: none; 
    }
    
    .justified-text::after {
        /* This helps to justify the last line properly */
        content: "";
        display: inline-block;
        width: 80%;
    }

    .collection-line-banner .banner-descr {
        font-family: Verdana, Geneva, sans-serif;
        width: 92%;
        margin: 0 auto;
    }
    
    /*.collection-line-banner .banner-descr p {
        padding: 0 0 1em 0;
        color: #fff;
        font-size: 16px;
    }*/
    
    .collection-text {
        font-family: Verdana, Geneva, sans-serif;
        color: white;
        line-height: 29px;
        font-size: 13px;
    }    


}

@media (max-width: 390px) {

    .filter-wrapper .d-flex.flex-wrap {
        position: relative;
        left: 4em;
    }
    
    .filter-wrapper {
        display: none;
    }

    .product-wrap.mr-2.my-1.pkl {
        margin: 0 auto;
        width: 100%;
       /*  border: 1px solid red; */
       padding: 0 0 2em 0.7em;
       height: 13em;
    }

    .is_new_sticker img {
        display: block !important;
        position: relative !important;
        top: -10em;
        left: 15em;
        width: 20% !important;
    }   
    
    .text-preview {
        font-size: 9px;
        text-transform: uppercase;
        margin-top: 2px;
        color: white;
        position: relative;
        top: -10em;
    }

    .product-wrap .text-preview div {
        font-size: 14px;
        text-transform: uppercase;
        margin-top: 2px;
        color: white;
        position: relative;
        top: 1em;
    }

    .text-preview.pkl .pull-right {
        float: none;
        margin: 0 0 0 17em;
        width: 100%;
        /* border: 1px solid yellow; */
    }
}

    a.lisa-slayman-thumnail img {
        width: 230px;
        /*height: 107px;*/
    }


</style>

<div class='collection-line-banner'>
    <div class="logo">
    <picture>
            <!-- Smaller image for mobile -->
            <source srcset="<?php echo $assets_base_uri; ?>/lisa-slayman-collection-logo-transparent.png" media="(max-width: 768px)">
            <!-- Default image for larger devices -->
            <img src="<?php echo $assets_base_uri; ?>/lisa-slayman-collection-logo-transparent.png" alt="logo" />
        </picture>
    </div>
    <div class="banner-descr justified-text collection-text">
        <?php echo $banner_descr; ?>
    </div>
    <div class="banner-img">
        <picture>
            <!-- Smaller image for mobile -->
            <source srcset="<?php echo $assets_base_uri; ?>/lisa-slayman-banner-W600xH338.jpg" media="(max-width: 768px)">
            <!-- Default image for larger devices -->
            <img src="<?php echo $assets_base_uri; ?>/lisa-slayman-banner-W800xH400.jpg" alt="banner" />
        </picture>
    </div>
    <div class="download-catalog">
        <a target="_blank" href="<?php echo $assets_base_uri; ?>/Lisa-Slayman-Collection-by-Opuzen.pdf" class="btn bkgr-green-op">Download Digital Catalog</a>
    </div>
</div>

<?php } // END IF ?>