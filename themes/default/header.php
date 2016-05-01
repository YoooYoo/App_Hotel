<!DOCTYPE html>
<?php $CI = &get_instance();
$currenturl = uri_string();
$allowreg = $app_settings[0]->allow_registration;
$allowsupplierreg = $app_settings[0]->allow_supplier_registration;
if (!empty($metadesc)) {
    $metadescription = $metadesc;
} else {
    $metadescription = $app_settings[0]->meta_description;
}
if (!empty($metakey)) {
    $metakeywords = $metakey;
} else {
    $metakeywords = $app_settings[0]->keywords;
}
$lang_set = $CI->theme->_data['lang_set'];

$currency = $CI->session->userdata('currencycode');
$langname = $CI->session->userdata('lang_name');
$isRTL = isRTL($lang_set);
if (empty($langname)) {
    $langname = "US";
} else {
    $langname = $langname;
} ?>
<html lang="us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if ($app_settings[0]->seo_status == "1") {
        echo $metadescription;
    } ?>">
    <meta name="keywords" content="<?php if ($app_settings[0]->seo_status == "1") {
        echo $metakeywords;
    } ?>">
    <meta name="author" content="TIENTIEN">
    <link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER . 'favicon.png'; ?>">
    <title><?php echo $app_settings[0]->site_title; ?> | <?php $ishome = $CI->uri->segment(1);
        if (empty($ishome)) {
            echo $app_settings[0]->home_title;
        } else {
            echo $CI->theme->_data['page_title'];
        } ?> </title>

    <link href="<?php echo $theme_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="http://hotel-kl.app/assets/include/select2/select2.css" rel="stylesheet">
    <link href="http://hotel-kl.app/assets/include/select2/select2-default.css" rel="stylesheet">

    <link href="<?php echo $theme_url; ?>style.min.css" rel="stylesheet">
    <?php if ($isRTL == "RTL") { ?>
        <link href="<?php echo $theme_url; ?>RTL.css" rel="stylesheet">
    <?php } ?>

    <script src="<?php echo $theme_url; ?>assets/js/jquery-1.10.2.min.js"></script>

    <link href="<?php echo $theme_url; ?>assets/include/animate/animate.min.css" rel="stylesheet">
    <script src="<?php echo $theme_url; ?>assets/include/animate/wow.min.js"></script>
    <script src="<?php echo $theme_url; ?>assets/include/datepicker/datepicker.js"></script>
    <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/include/datepicker/datepicker.css"/>
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/include/font-awesome/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet"/>
    <script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>

    <link href="<?php echo $theme_url; ?>assets/css/roboto.min.css" rel="stylesheet">
    <link href="<?php echo $theme_url; ?>assets/css/material.min.css" rel="stylesheet">
    <link href="<?php echo $theme_url; ?>assets/css/ripples.min.css" rel="stylesheet">
    <style>
        .menu_char {
            color:#ced5e0;
        }
        .navbar .navbar-nav>li>a:focus, .navbar .navbar-nav>li>a:hover {
            color: #fff;
            background-color: transparent;
        }
    </style
</head>
<body>

<header class="<?php echo @$hidden; ?>">
    <nav class="navbar navbar-static-top navbar-default" style="background-color:#1D62D7;">
        <div class="container">
            <div class="navbar-header go-right">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url(); ?>"><img
                        src="<?php echo PT_GLOBAL_IMAGES_FOLDER . $app_settings[0]->header_logo_img; ?>"
                        class="img-responsive logo" alt=""/></a>
            </div>
            <div class="collapse navbar-collapse" id="header">
                <ul class="nav navbar-nav navbar-left main-nav go-right">
                    <li class="menu_char <?php pt_active_link(); ?> go-right"><a
                            href="<?php echo base_url(); ?>"><?php echo trans('01'); ?></a></li>
                    <!--Dynamic header links---->
                    <?php $hmenu = get_header_menu();
                    if (!empty($hmenu)) {
                        $menuitems = json_decode($hmenu[0]->menu_items);
                        if (!empty($menuitems)) {
                            $icons = false;
                            foreach ($menuitems as $hm) {
                                $pinfo = get_page_details($hm->id);
                                foreach ($pinfo as $pagesinfo) {
                                    $parent = parent_info($pagesinfo, $icons, $lang_set);
                                    $ischildactive = child_page_active($hm->children);
                                    if (!empty($hm->children) && $ischildactive) {
                                        $dropdownmenu = "dropdown-menu";
                                        $dropdown = "dropdown";
                                        $dropdowntoggle = "dropdown-toggle";
                                        $datatoggle = "data-toggle='dropdown'";
                                        $caret = "<span class='caret'></span>";
                                    } else {
                                        $dropdownmenu = "";
                                        $dropdown = "";
                                        $dropdowntoggle = "";
                                        $datatoggle = "";
                                        $caret = "";
                                    }
                                    ?>
                                    <li class="menu_char go-right <?php echo $dropdown . " " . pt_active_link($pagesinfo->page_slug); ?>">
                                        <a href="<?php echo $parent['hreflink']; ?>"
                                           class="<?php pt_active_link($pagesinfo->page_slug) . ' ' . $dropdowntoggle; ?>" <?php echo $datatoggle; ?>
                                           target="<?php echo $parent['target']; ?>"><i
                                                class='<?php echo $parent['icons']; ?>'></i> <?php echo $parent['pagetitle']; ?> <?php echo $caret; ?>
                                        </a>
                                        <?php if (!empty($hm->children)) { ?>
                                            <ul class="<?php echo $dropdownmenu; ?>">
                                                <?php foreach ($hm->children as $ch) {
                                                    $children = get_page_details($ch->id);
                                                    foreach ($children as $childinfo) {
                                                        $child = child_info($childinfo, $icons, $lang_set);
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $child['hrefchild']; ?>"
                                                               target="<?php echo $child['childtarget']; ?>"><i
                                                                    class='<?php echo $child['icons']; ?>'></i> <?php echo $child['childtitle']; ?>
                                                            </a>
                                                        </li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php }
                            }
                        }
                    } ?>
                </ul>

<!--                <ul class="nav navbar-nav navbar-right go-left">-->
<!--                    --><?php //if (strpos($currenturl, 'book') !== false || !empty($hideLang)) {
//                    } else {
//                        if ($app_settings[0]->multi_lang == '1') {
//                            $default_lang = $app_settings[0]->default_lang;
//                            if (!empty($lang_set)) {
//                                $default_lang = $lang_set;
//                            } ?>
<!--                            <li class="dropdown">-->
<!--                                <a href="javascript: void();" class="dropdown-toggle" data-toggle="dropdown"><img-->
<!--                                        src="--><?php //echo PT_LANGUAGE_IMAGES . $default_lang . ".png"; ?><!--" width="21"-->
<!--                                        height="21" alt=""> --><?php //echo $langname; ?><!-- <b class="caret"></b></a>-->
<!--                                <ul class="dropdown-menu">-->
<!--                                    --><?php //$language_list = pt_get_languages(); ?>
<!--                                    --><?php //foreach ($language_list as $ldir => $lname) {
//                                        $selectedlang = '';
//                                        if (!empty($lang_set) && $lang_set == $ldir) {
//                                            $selectedlang = 'selected';
//                                        } elseif (empty($lang_set) && $default_lang == $ldir) {
//                                            $selectedlang = 'selected';
//                                        } ?>
<!--                                        <li><a href="--><?php //echo pt_set_langurl($langurl, $ldir); ?><!--"-->
<!--                                               data-langname="--><?php //echo $lname['name']; ?><!--" id="--><?php //echo $ldir; ?><!--"-->
<!--                                               class="changelang"><img-->
<!--                                                    src="--><?php //echo PT_LANGUAGE_IMAGES . $ldir . ".png"; ?><!--" width="21"-->
<!--                                                    height="21" alt=""> --><?php //echo $lname['name']; ?><!--</a></li>-->
<!--                                    --><?php //} ?>
<!--                                </ul>-->
<!--                            </li>-->
<!--                        --><?php //} ?>
<!--                    --><?php //} ?>
<!--                </ul>-->

                <?php if ($app_settings[0]->multi_curr == 1 && empty($hideCurr)) {
                    $currencies = ptCurrencies(); ?>
                    <form class="menu_char navbar-form navbar-right go-left" style="display:none;">
                        <div class="form-group">
                            <select class="form-control RTL" placeholder="" onchange="change_currency(this.value)">
                                <?php foreach ($currencies as $c) { ?>
                                    <option value="<?php echo $c->id; ?>" <?php makeSelected($currency,
                                        $c->code); ?>><?php echo $c->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                <?php } ?>

                <div class="menu_char navbar-form navbar-right go-left">
                    <?php if (!empty($customerloggedin)){ ?>

                        <select class="form-control dropdown form-controls"
                                onchange="if (this.value) window.location.href=this.value">
                            <option value=""> <?php echo $firstname; ?> </option>
                            <option value="<?php echo base_url() ?>account/"><?php echo trans('02'); ?></option>
                            <option value="<?php echo base_url() ?>account/logout/"><?php echo trans('03'); ?></option>
                        </select>

                    <?php }else{
                    if (strpos($currenturl, 'book') !== false) {
                    }else{
                    if ($allowreg == "1"){ ?>

                    <select class="form-control dropdown form-controls"
                            onchange="if (this.value) window.location.href=this.value">
                        <option value=""> <?php echo trans('0146'); ?> </option>
                        <option value="<?php echo base_url(); ?>login"><?php echo trans('04'); ?></option>
                        <option value="<?php echo base_url(); ?>register"><?php echo trans('0115'); ?></option>
                    </select>

                </div>
            <?php }
            }
            } ?>
                <!--   <?php if ($allowsupplierreg == "1") { ?>
             <ul class="nav navbar-nav navbar-left main-nav">
            <li><a href="<?php echo base_url(); ?>supplier-register"><?php echo trans('0241'); ?></a></li>
             </ul>
            <?php } ?>-->
            </div>
        </div>
    </nav>
</header>
