<?php
/**
 * MiniDokuLicious Template 0.9 - Image Details
 *
 * @link    http://eye48.com/go/minidokulicious
 * @author  Michael Haschke
 * @license http://creativecommons.org/licenses/by-sa/3.0/
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

if (!isset($DOKU_TPL)) $DOKU_TPL = DOKU_TPL;
if (!isset($DOKU_TPLINC)) $DOKU_TPLINC = DOKU_TPLINC;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>" lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?> &mdash; <?php echo strip_tags($conf['title'])?></title>

    <?php tpl_metaheaders()?>

    <!--[if IE 5]><link media="screen" href="<?php echo DOKU_TPL; ?>patches/ie5.css" rel="stylesheet" type="text/css" /><![endif]-->
    <!--[if IE 6]><link media="screen" href="<?php echo DOKU_TPL; ?>patches/ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
    <!--[if IE 7]><link media="screen" href="<?php echo DOKU_TPL; ?>patches/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->
    
    <!-- link rel="shortcut icon" href="<?php echo DOKU_TPL?>images/favicon.ico" / -->

</head>

<body<?php echo (isset($_SERVER['REMOTE_USER'])) ? ' id="backend"':'';?>>
<script type="text/javascript">
    // test for javascript
    document.getElementsByTagName("body")[0].className = "js";
</script>
    <div class="sitewrapper">
    <?php echo (isset($_SERVER['REMOTE_USER'])) ? '<div id="backendrow"></div><div id="system_bookmarks" class="backendbutton" onclick="var menu = document.getElementById(\'usermenu\'); if (menu.className==\'normal\') {menu.className=\'dropdown\';} else {menu.className=\'normal\';} return;"></div>':''; ?>
        <div class="header">

            <h1><?php tpl_link(wl(),$conf['title'])?></h1>

            <div class="nav-main">

                <ol>
			        <?php if (actionOK('index')) { echo '<li'.(($ACT == 'index')?' class="active"':'').'>';tpl_actionlink('index');echo '</li>'; } ?>
	                <?php if (actionOK('recent')) { echo '<li'.(($ACT == 'recent')?' class="active"':'').'>';tpl_actionlink('recent');echo '</li>'; } ?>
                </ol>

                <?php if (actionOK('search')) { tpl_searchform(); } ?> <!-- /search -->

            </div> <!-- /nav-main -->
            
                        
            <div class="nav-breadcrumb">
            		<hr class="onlyAural"/>
                    <p>&larr; <?php echo $lang['img_backto']?> <?php tpl_pagelink($ID)?></p>
            </div> <!-- /nav-breadcrumb -->

        </div> <!-- /header -->

		<hr class="onlyAural"/>

        <div id="content" class="content">

            <?php html_msgarea()?>

            <?php if($ERROR){ print $ERROR; }else{ ?>

                <h1><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?></h1>

                <div class="mediameta">
                    <div class="mediameta__header">
                        <strong>Media-Metadaten</strong> <?php // TODO: translation ?>
                    </div>
                    <div class="mediameta__inside">
                          <dl class="img_tags">
                            <?php
                              $t = tpl_img_getTag('Date.EarliestTime');
                              if($t) print '<dt>'.$lang['img_date'].':</dt><dd>'.strftime($conf['dformat'],$t).'</dd>';

                              $t = tpl_img_getTag('File.Name');
                              if($t) print '<dt>'.$lang['img_fname'].':</dt><dd>'.hsc($t).'</dd>';

                              $t = tpl_img_getTag(array('Iptc.Byline','Exif.TIFFArtist','Exif.Artist','Iptc.Credit'));
                              if($t) print '<dt>'.$lang['img_artist'].':</dt><dd>'.hsc($t).'</dd>';

                              $t = tpl_img_getTag(array('Iptc.CopyrightNotice','Exif.TIFFCopyright','Exif.Copyright'));
                              if($t) print '<dt>'.$lang['img_copyr'].':</dt><dd>'.hsc($t).'</dd>';

                              $t = tpl_img_getTag('File.Format');
                              if($t) print '<dt>'.$lang['img_format'].':</dt><dd>'.hsc($t).'</dd>';

                              $t = tpl_img_getTag('File.NiceSize');
                              if($t) print '<dt>'.$lang['img_fsize'].':</dt><dd>'.hsc($t).'</dd>';

                              $t = tpl_img_getTag('Simple.Camera');
                              if($t) print '<dt>'.$lang['img_camera'].':</dt><dd>'.hsc($t).'</dd>';

                              $t = tpl_img_getTag(array('IPTC.Keywords','IPTC.Category','xmp.dc:subject'));
                              if($t) print '<dt>'.$lang['img_keywords'].':</dt><dd>'.hsc($t).'</dd>';

                            ?>
                          </dl>
                    </div>
                </div>

                <div class="img_big">
                  <?php tpl_img(900,700) ?>
                </div>

                <p class="img_caption">
                <?php print nl2br(hsc(tpl_img_getTag('simple.title'))); ?>
                </p>

                <?php //Comment in for Debug// dbg(tpl_img_getTag('Simple.Raw'));?>

            <?php } ?>
            
		</div> <!-- /content -->
		
		<?php
		if (isset($_SERVER['REMOTE_USER']))
		{
            echo '<hr class="onlyAural"/>';
			echo '<div class="bookmarks">';
				echo '<h1><dfn>'."Bookmarks".'</dfn></h1>'; //TODO: translation
				echo '<ol id="usermenu" class="normal">';
				// bookmarks are not available in DokuWiki :(
				if ($conf['breadcrumbs']) { echo '<li>'; tpl_breadcrumbs(); echo '</li>'; }
				echo "</ol>";
			echo '</div> <!-- /bookmarks -->';
		}
		?>

		<hr class="onlyAural"/>

        <div class="footer">
            <p>powered by <a href="http://www.dokuwiki.org/">DokuWiki</a> &amp; <a href="http://eye48.com/go/minidokulicious">MiniDokuLicious Template</a> |
			<?php
		        if (actionOK('login'))
		        {
		            if (isset($_SERVER['REMOTE_USER']))
		            {
                        // Logout
                        tpl_actionlink('login','<span id="system_logout" title="'.$lang['btn_logout'].'"><span class="backendbutton"></span>','</span>');
		            }
		            else
		            {
		                // Login
                        tpl_actionlink('login');
		            }
		        }
	        ?>
            </p>
        </div> <!-- /footer -->

</div> <!-- /sitewrapper -->

</body>
</html>
