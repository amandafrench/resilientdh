<?php
/**
 * Custom template for Project Pages
 */

	#} NOTE: Adapted from : http://semantic-ui.com/examples/homepage.html
	#} <3 and props to Semantic UI

	#} Rather blazenly, we assume this is in the loop & legit. Hmmm.
	#} We also assume plugin is still installed :o

	#} Got post?
	global $post; if (!isset($post) || !isset($post->ID) || (isset($post->post_status) && $post->post_status != 'publish')) {
		
		#} Send home - this'll probably never happen anyway.
		global $wp_query;		
	    $wp_query->set_404();
	    status_header( 404 );
	    nocache_headers();
	    exit();

	} 

	#} Subtle efficiency drive.

		#} Post specifics:
		$projectTitle = $post->post_title;
		$projectTitleChecked = $projectTitle; if (empty($projectTitle)) $projectTitleChecked = 'Untitled Project #'.$post->ID;
		$projectURL = get_post_permalink($post->ID);
		$projectMeta = projectPages_getProjectMeta($post->ID);
		$projectSummary = nl2br(htmlspecialchars_decode(get_post_meta($post->ID, 'whpp_project_summary' , true )));
    $projectSummaryForOG = strip_tags($projectSummary); $projectSummaryForOG = str_replace('"',"'",$projectSummaryForOG);
		$projectBody = htmlspecialchars_decode(get_post_meta($post->ID, 'whpp_project_body' , true ));
    $projectBody = apply_filters('the_content', $projectBody); # http://wordpress.stackexchange.com/questions/21473/why-does-the-html-editor-not-wrap-my-code-in-paragraph-tags-when-i-press-enter
    $projectTags = wp_get_post_terms($post->ID,'projectpagetag');
		$projectDate = date('F jS Y',strtotime($post->post_modified));
    $projectNoHeaderImg = get_post_meta($post->ID, 'noheader' , true );
    $usingLogging = projectPages_getSetting('use_logs');
    $projectLogs = array(); if ($usingLogging == "1") $projectLogs = projectPages_getLogs($post->ID,true,100);


			#} Featured image?
			$projectFeaturedImage = '';
			$thumb_id = get_post_thumbnail_id();
			if (isset($thumb_id) && !empty($thumb_id)){
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				if (isset($thumb_url_array) && is_array($thumb_url_array) && isset($thumb_url_array[0])) $projectFeaturedImage = $thumb_url_array[0];
			}

      #} if Required, use og fallback
      $projectFeaturedImageChecked = $projectFeaturedImage; if (empty($projectFeaturedImageChecked)) $projectFeaturedImageChecked = PROJECTPAGES_URL.'i/projectpages.png';

      #} Project Logs?


		#} Some basics:
		$blogTitle = get_bloginfo('name');
		$blogURL = get_bloginfo('url');
		$projectsTitle = __('Projects','projectpages');
		# This doesn't seem to work, use brute force for now: $projectsURL = get_post_type_archive_link('projectpage');
			global $projectPagesPermaRoot;
			$projectsURL = $blogURL.'/'.$projectPagesPermaRoot;

		#} Pretty up page title.
		$pageTitle = __('Project','projectpages'); if (!empty($projectTitle)) $pageTitle = $projectTitle; if (!empty($blogTitle)) $pageTitle .= ' | '.$blogTitle;

    #} Pass to footer
    global $projectPagesFooterInfo; $projectPagesFooterInfo = array('blogtitle' => $blogTitle,'blogurl'=>$blogURL,'projectstitle'=>$projectsTitle,'projectsurl'=>$projectsURL,'projecttags'=>$projectTags);



?><!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo PROJECTPAGES_URL.'css/semantic.min.css'; ?>">
  <?php
    
    #} Favicon?
    $faviconURL = projectPages_getSetting('favicon');
    if (!empty($faviconURL)) echo '<link rel="shortcut icon" href="'.$faviconURL.'" type="image/x-icon" />'; 

  ?>

  <!-- OG Meta -->
  <meta property="og:title" content="<?php echo $pageTitle; ?>" />
  <meta property="og:type" content="blog" />
  <meta property="og:url" content="<?php echo $projectURL; ?>" />
  <meta property="og:image" content="<?php echo $projectFeaturedImageChecked; ?>" />
  <meta property="og:site_name" content="<?php echo $blogTitle; ?>" />
  <meta property="og:description" content="<?php echo $projectSummaryForOG; ?>" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="<?php echo $pageTitle; ?>" />
  <meta name="twitter:description" content="<?php echo $projectSummaryForOG; ?>" />
  <meta name="twitter:image" content="<?php echo $projectFeaturedImageChecked; ?>" />
  <meta itemprop="image" content="<?php echo $projectFeaturedImageChecked; ?>" />


  <style type="text/css">

    .hidden.menu {
      display: none;
    }

    .masthead.segment {
      min-height: 700px;
      padding: 1em 0em;
    }
    .masthead .logo.item img {
      margin-right: 1em;
    }
    .masthead .ui.menu .ui.button {
      margin-left: 0.5em;
    }
    .masthead h1.ui.header {
      margin-top: 3em;
      margin-bottom: 0em;
      font-size: 4em;
      font-weight: normal;
    }
    .masthead h2 {
      font-size: 1.7em;
      font-weight: normal;
    }

    .ui.vertical.stripe {
      padding: 8em 0em;
    }
    .ui.vertical.stripe h3 {
      font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
      clear: both;
    }
    .ui.vertical.stripe p {
      font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }

    .quote.stripe.segment {
      padding: 0em;
    }
    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }

    .footer.segment {
      padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
      display: none;
    }

    @media only screen and (max-width: 700px) {
      .ui.fixed.menu {
        display: none !important;
      }
      .secondary.pointing.menu .item,
      .secondary.pointing.menu .menu {
        display: none;
      }
      .secondary.pointing.menu .toc.item {
        display: block;
      }
      .masthead.segment {
        min-height: 350px;
      }
      .masthead h1.ui.header {
        font-size: 2em;
        margin-top: 1.5em;
      }
      .masthead h2 {
        margin-top: 0.5em;
        font-size: 1.5em;
      }
      .menubreadcrumb {
      	display:none !important;
      }
    }

    /* few tweaks */
    #project-page-summary {
      padding: 5em 0em;
    }
    #project-page-summary .statuscard {
      margin-top: 1em;  
    }
    #project-page-summary-content {
      text-align:justify;
      font-size: 1.3em;
      line-height: 1.5em;
    }
    #project-page-summary-content h2 {
          margin-top: 0.6em !important;
    }
    #project-page-summary-img {      
      text-align: center;
      width: 290px;
      max-width: 290px;
      float: right;
    }
    #project-page-summary-img img {
      max-width:50%;
    }
    #project-page-demo-link {
      margin-top: 1em;  
      text-align:center; 
      width: 290px;
      max-width: 290px;
      float: right;
    }
    .menubreadcrumb {
    	padding-top: 10px !important;
    }
    #fixedMenu .menubreadcrumb {
      padding-left: 4px;
    }
    .statuscard {
    	margin:0;
    	float:right;
    }
    .ui.secondary.inverted.pointing.menu {
    	border:0 !important;
    }
    .statuscard .description {
    	font-size:0.9em;
    }
    .ppFooterWidgetWrap {
      padding-bottom:4px;
    }
    .ppFooterWidgetWrap ul {

        list-style-type: none !important;    
        padding-left: 12px;
        font-size: 1.1em;
        line-height: 1.7em;
        
    }

    <?php if (!empty($projectFeaturedImage) && (!isset($projectNoHeaderImg) || empty($projectNoHeaderImg))){  #} Any feat img?  ?>
    #projectmasthead {
	    background-image: url("<?php echo $projectFeaturedImage; ?>");
	    background-size: cover;
	    background-repeat: no-repeat;
	    background-position: 50% 50%;
	}
    <?php } ?>


    /* Share bits */
    .whpp-sharewrap {

        font-size:18px;

    }
    .whpp-sharewrap .facebook, .whpp-sharewrap .twitter {
        
        margin-left: 4px;
        margin-right: 0;
        height: 30px;

    }
    .whpp-sharewrap .facebook:hover, .whpp-sharewrap .twitter:hover {

        cursor:pointer;
        border-bottom: 2px solid #FFF;

    }


    /* WP Content helper styles */
    .wp-body {
      font-size:1.2em; /* Preference, here, really */
    }
    .wp-body .caption {

      font-size: 1.4em;
      text-align: center;
      border-bottom: 2px solid #64b0ed;
      margin-top: 3em;

    }
    .wp-body .aligncenter {

        margin-left: auto;
        margin-right: auto;
        display: block;

    }
    .wp-body img.size-full {

        max-width: 80%;
        width: 80%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        display: block;

    }
    .wp-body p {
      margin-bottom:1.3em !important;
    }
    .wp-body ul, .wp-body ol {        
      font-size: 1.2em;
      line-height: 1.3em;
      margin-top: 2em;
      margin-bottom: 2em;
    }
    .wp-body ul li, .wp-body ol li {  
      margin-bottom: 0.8em;
    }
    .wp-body h2, .wp-body h3 {
      margin-top: 1.7em !important;
    }
    #project-page-body {
      padding-top:3em !important;
    }

    .wp-body p iframe {

      max-width: 100%;

    }

    #whppLogs .whppMessage .header {

      margin-top: 0.2em !important;
      margin-bottom: 0.6em;

    }

    .ui.menu .item:before {
      background:none !important;
    }
    <?php

    #} coloured headers
    if (isset($projectMeta) && is_array($projectMeta) && isset($projectMeta['headerbg']) && !empty($projectMeta['headerbg'])){
     echo '#projectmasthead { background-color:'.$projectMeta['headerbg'].' !important; }';
    }

    ?>

  </style>
  <?php

    #} any override css?
    $cssOverride = projectPages_getSetting('css_override');
    if (!empty($cssOverride)) echo '<style type="text/css">'.projectPages_textProcess($cssOverride).'</style>';



    #} Print wp scripts to grab jquery, rather than using our own :)
    wp_print_head_scripts();

    /*<script src="<?php echo PROJECTPAGES_URL.'js/libs/jquery.min.js'; ?>"></script>*/

  ?>

  <script src="<?php echo PROJECTPAGES_URL.'js/libs/semantic/visibility.min.js'; ?>"></script>
  <script src="<?php echo PROJECTPAGES_URL.'js/libs/semantic/sidebar.min.js'; ?>"></script>
  <script src="<?php echo PROJECTPAGES_URL.'js/libs/semantic/transition.min.js'; ?>"></script>
  <script>
  jQuery(document)
    .ready(function() {

      // fix menu when passed
      jQuery('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            jQuery('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            jQuery('.fixed.menu').transition('fade out');
          }
        })
      ;

      // create sidebar and attach to menu open
      jQuery('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;

    })
  ;
  </script>
</head>
<body>

<?php while ( have_posts() ) : the_post(); #} Loop me! ?>

<!-- Following Menu -->
<div class="ui large top fixed hidden menu" id="fixedMenu">
  <div class="ui container">
    <a class="item" href="<?php echo $blogURL; ?>"><?php echo $blogTitle; ?></a>
    <i class="right angle icon menubreadcrumb"></i> 
    <a class="item" href="<?php echo $projectsURL; ?>"><?php echo $projectsTitle; ?></a>
    <i class="right angle icon menubreadcrumb"></i> 
    <a class="active item" href="<?php echo $projectURL; ?>"><?php echo $projectTitleChecked; ?></a>
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
  <a class="item" href="<?php echo $blogURL; ?>"><?php echo $blogTitle; ?></a>
  <a class="item" href="<?php echo $projectsURL; ?>"><?php echo $projectsTitle; ?></a>
  <a class="active item" href="<?php echo $projectURL; ?>"><?php echo $projectTitleChecked; ?></a>
</div>

<!-- Page Contents -->
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment" id="projectmasthead">

    <div class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
    	<a class="item" href="<?php echo $blogURL; ?>"><?php echo $blogTitle; ?></a>
    	<i class="right angle icon menubreadcrumb"></i> 
        <a class="item" href="<?php echo $projectsURL; ?>"><?php echo $projectsTitle; ?></a>
    	<i class="right angle icon menubreadcrumb"></i> 
    	<a class="active item" href="<?php echo $projectURL; ?>"><?php echo $projectTitleChecked; ?></a>
      </div>
    </div>

    <div class="ui text container">
      <h1 class="ui inverted header">
        <?php echo $projectTitleChecked; ?>
      </h1>
      <?php if (is_array($projectMeta) && isset($projectMeta['biline'])) echo '<h2>'.projectPages_textExpose($projectMeta['biline']).'</h2>'; ?>
      <?php $shareImg = ''; if (isset($projectFeaturedImage) && !empty($projectFeaturedImage)) $shareImg = $projectFeaturedImage; projectPages_shareOut($projectTitleChecked.' on '.$blogTitle,$projectURL,$shareImg); ?>
    </div>

  </div>

  <?php if (isset($projectSummary) && !empty($projectSummary)){ ?>
  <div class="ui vertical stripe segment" id="project-page-summary">
    <div class="ui aligned stackable grid container">
      <div class="row">
        <div class="ten wide column wp-body" id="project-page-summary-content">
          <h2><?php _e('Summary','projectpages'); ?></h2>
          <?php echo $projectSummary; ?>
        </div>
        <div class="one wide column"><div style="clear">&nbsp;</div></div>
        <div class="five wide column">
          <?php


              #} Featured image?
              $projectFeaturedImage = '';
              $thumb_id = get_post_thumbnail_id();
              if (isset($thumb_id) && !empty($thumb_id)){
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                if (isset($thumb_url_array) && is_array($thumb_url_array) && isset($thumb_url_array[0])) $projectFeaturedImage = $thumb_url_array[0];
              }

              if (!empty($projectFeaturedImage)){ ?><div id="project-page-summary-img"><img src="<?php echo $projectFeaturedImage; ?>" alt="<?php the_title(); ?>" /></div><?php }

          ?>
          <div class="ui card statuscard">
      		  <?php 

      		  	#} Status
      		  	if (is_array($projectMeta) && isset($projectMeta['status'])) {

      		  		global $projectPageStatuses;
      		  		$statusStr = ''; $statusColourClass = ''; if (isset($projectPageStatuses[$projectMeta['status']])) {
      		  			$statusStr = $projectPageStatuses[$projectMeta['status']][0];
      		  			$statusColourClass = $projectPageStatuses[$projectMeta['status']][1];
      		  		}
      		  		
      		  		?>
              <div class="content">
		              <i class="right floated circle icon <?php echo $statusColourClass; ?>"></i>
		              <div class="header"><?php _e('Status','projectpages'); echo ': '.$statusStr; ?></div>
		              <div class="meta"><?php echo __('Updated','projectpages').': '.$projectDate; ?></div>
	            </div>
              		<?php

      		  	}

              #} Tags?
              if (is_array($projectTags) && count($projectTags) > 0){

                ?>
                <div class="content">
                  <div class="description">
                    <p><i class="tags icon"></i> <?php _e('Tagged','projectpages'); ?>: <?php $tagIndx = 0; foreach ($projectTags as $tag){ if ($tagIndx > 0) echo ', '; ?><a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a><?php $tagIndx++; } ?></p>
                  </div>
                </div>
                <?php

              }

              #} Logs?
              if (is_array($projectLogs) && count($projectLogs) > 0){

                ?>
                <div class="content">
                  <div class="description">
                    <p><i class="remove bookmark icon"></i> <?php echo count($projectLogs).' x <a href="#project-logs">'.__('Project Logs','projectpages'); ?></a></p>
                  </div>
                </div>
                <?php

              }

      		  ?>
          </div>
          <?php 

            #} Any demo url?
            $demoUrl = ''; if (is_array($projectMeta) && isset($projectMeta['demourl']) && !empty($projectMeta['demourl'])) $demoUrl = $projectMeta['demourl'];
            $demoText = __('View','projectpages'); if (is_array($projectMeta) && isset($projectMeta['demolinktext']) && !empty($projectMeta['demolinktext'])) $demoText = $projectMeta['demolinktext'];

            if (!empty($demoUrl)){

              ?><div id="project-page-demo-link"><a href="<?php echo $demoUrl; ?>" class="ui primary button" target="_blank"><?php echo $demoText; ?></a></div><?php

            }

          ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>


  <?php if (isset($projectBody) && !empty($projectBody)){ ?>
  <div class="ui vertical stripe segment" id="project-page-body">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
  <?php
    
    #} useThinLayout?
    $useThinLayout = projectPages_getSetting('thin_column');
    if ($useThinLayout == "1") {
      ?><div class="three wide column">&nbsp;</div>
      <div class="ten wide column wp-body"><?php
    } else {
      ?><div class="sixteen wide column wp-body"><?php
    } ?>
          <?php echo $projectBody; ?>
        </div>
    <?php 
    if ($useThinLayout == "1") {
      ?><div class="three wide column">&nbsp;</div><?php
    } ?>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php 

        if (count($projectLogs) > 0) {

          ?><div class="ui vertical stripe segment" id="whppLogs">
            <div class="ui middle aligned stackable grid container">
              <div class="row">
                <?php

                if ($useThinLayout == "1") {
                    ?><div class="three wide column">&nbsp;</div>
                    <div class="ten wide column wp-body"><?php
                  } else {
                    ?><div class="sixteen wide column wp-body"><?php
                  } 

                    echo '<h2 class="ui header huge" style="margin-top: 0 !important;text-align:center;" id="project-logs">'.__('Project Log','projectpages').'</h2>';
                  
                    foreach ($projectLogs as $log){

                      $logTitle = __('Untitled','projectpages');
                      if (isset($log->meta) && isset($log->meta['title'])) $logTitle = $log->meta['title'];
                      $logDate = '';
                      if (isset($log->meta) && isset($log->meta['date'])) $logDate = $log->meta['date'];
                      $logBody = htmlspecialchars_decode(get_post_meta($log->ID, 'whpp_project_log_body' , true ));

                      ?><div class="ui info message whppMessage">
                      <?php if (!empty($logDate)) echo '<div class="ui label top right attached">'.$logDate.'</div>'; ?>
                          <div class="header">
                            <?php

                              echo $logTitle;

                            ?>
                          </div>
                          <?php 
                            echo $logBody;
                          ?>
                        </div><?php

                    }

                  ?></div><?php
                   
                  if ($useThinLayout == "1") {
                    ?><div class="three wide column">&nbsp;</div><?php
                  } 

          ?> </div>  
            </div>
          </div><?php

        }


  ?>


<?php endwhile; #} End of the loop. ?>
    

  <?php projectPages_get_template_part('projectpages-footer'); #get_template_part('projectpages-footer'); # Include our footer ?>


  </div>
</div>

</body>

</html>