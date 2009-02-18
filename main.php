<?php
/**
 * MiniDokuLicious Template 0.9
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
    <title><?php tpl_pagetitle()?> &mdash; <?php echo strip_tags($conf['title'])?></title>

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
            
                        
            <?php if ($ACT == 'show' && $ID != $conf['start']) { ?>
                <div class="nav-breadcrumb">
               		<hr class="onlyAural"/>
    		        <?php
	                    if ($conf['youarehere']) { echo '<p>'; tpl_youarehere(' / '); echo '</p>'; }
	                    elseif ($conf['breadcrumbs']) { echo '<p>'; tpl_breadcrumbs(); echo '</p>'; }
	                ?>
                </div> <!-- /nav-breadcrumb -->
            <?php } ?>

        </div> <!-- /header -->

		<hr class="onlyAural"/>

        <div id="content" class="content">

            <?php html_msgarea()?>

            <!-- wikipage start -->
            <?php tpl_content()?>
            <!-- wikipage stop -->

		<?php if ($ACT == 'show') { ?>
		    <hr class="onlyAural"/>

		    <div class="sitesuffix">
			    <div class="pageinfo">
				    <h2><dfn><?php echo "SiteInformation"; //TODO: translation ?></dfn></h2>
				    <p><?php
			            if (isset($INFO['exists']) && auth_quickaclcheck($ID))
			            {
			                echo $lang['lastmod'] . ': ';
			                if (actionOK('revisions'))
			                {
			                    tpl_actionlink('history','<span id="page_diff" title="'.$lang['btn_revs'].'"><span class="backendbutton"></span>','</span>', strftime($conf['dformat'],$INFO['lastmod']));
			                }
			                else
			                {
			                    strftime($conf['dformat'],$INFO['lastmod']);
			                }
			                echo ((isset($INFO['editor']))?' '.$lang['by'].' '.editorinfo($INFO['editor']):' ('.$lang['external_edit'].')').'. ';

                            tpl_actionlink('backlink','<span id="page_link" title="'.$lang['btn_backlink'].'"><span class="backendbutton"></span>','</span>');
			            }
			            
			            // TODO: License
				    ?></p>
				    
				    <!-- there are no file upload features in DokuWiki (?)
				    <?php if (isset($_SERVER['REMOTE_USER'])) { ?>
				    <ul>
					    <?php /* Referer link -- moved to info paragraph above */ ?>
					    <?php /* Show uploads link -- not available in DokuWiki */ ?>
					    <?php /* Hide uploads link -- not available in DokuWiki */ ?>
				    </ul>
				    <?php } ?>
				    -->
			    </div> <!-- /pageinfo -->

                <?php if (actionOK('edit')
                      || (actionOK('subscribe') && actionOK('unsubscribe'))
                      || (actionOK('subscribens') && actionOK('unsubscribens'))
                      ) { ?>
			        <div class="pagetools">
				        <h2><dfn><?php echo "SiteTools"; //TODO: translation ?></dfn></h2>
				        <ul><?php
				            /* Edit link */
				            if (actionOK('edit'))
				            {
				                echo '<li>';
				                tpl_actionlink('edit','<span id="page_edit" title="'.$lang['btn_edit'].'"><span class="backendbutton"></span>','</span>');
				                echo '</li>'.DOKU_LF;
				            }

					        /* Rename link -- not available in DokuWiki */
					        /* Page settings link -- not available in DokuWiki */
					        /* Edit ACLs link -- not available in DokuWiki */
					        /* Remove link -- not available in DokuWiki */
					        
					        if (actionOK('subscribe') && actionOK('unsubscribe') && isset($_SERVER['REMOTE_USER']) && $conf['subscribers'] == 1)
					        {
					            if (!isset($INFO['subscribed']) || !$INFO['subscribed'])
					            {
    					            /* Subscribe page */
					                echo '<li>';
					                tpl_actionlink('subscribe','<span id="page_subscribe" title="'.$lang['btn_subscribe'].'"><span class="backendbutton"></span>','</span>');
					                echo '</li>'.DOKU_LF;
					            }
					            else
					            {
    					            /* Unsubscribe page */
					                echo '<li>';
					                tpl_actionlink('subscribe','<span id="page_unsubscribe" title="'.$lang['btn_unsubscribe'].'"><span class="backendbutton"></span>','</span>');
					                echo '</li>'.DOKU_LF;
					            }
					        }
					        
					        if (actionOK('subscribens') && actionOK('unsubscribens') && isset($_SERVER['REMOTE_USER']) && $conf['subscribers'] == 1)
					        {
					            if (!isset($INFO['subscribedns']) || !$INFO['subscribedns'])
					            {
    					            /* Subscribe name space */
					                echo '<li>';
					                tpl_actionlink('subscribens','<span id="page_subscribens" title="'.$lang['btn_subscribens'].'"><span class="backendbutton"></span>','</span>');
					                echo '</li>'.DOKU_LF;
					            }
					            else
					            {
    					            /* Unsubscribe name space */
					                echo '<li>';
					                tpl_actionlink('subscribens','<span id="page_unsubscribens" title="'.$lang['btn_unsubscribens'].'"><span class="backendbutton"></span>','</span>');
					                echo '</li>'.DOKU_LF;
					            }
					        }
					        
					        /* Print page -- not available in DokuWiki (and not needed!) */

				        ?></ul>
			        </div> <!-- /pagetools -->
			    <?php } ?>
			
		    </div> <!-- /sitesuffix -->
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
			    if (isset($_SERVER['REMOTE_USER']))
			    {
			        // tpl_userinfo(); echo ', ';
			        echo $INFO['userinfo']['name'].': ';
			    }
		        
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
		        
		        if (isset($_SERVER['REMOTE_USER']))
		        {
		            if (actionOK('profile'))
		            {
		                echo ', ';
                        tpl_actionlink('profile','<span id="system_profile" title="'.$lang['btn_profile'].'"><span class="backendbutton"></span>','</span>');
		            }
		            
		            if (actionOK('admin'))
		            {
		                echo ', ';
                        tpl_actionlink('admin','<span id="system_admin" title="'.$lang['btn_admin'].'"><span class="backendbutton"></span>','</span>');
		            }
		        }
	        ?>
            </p>
        </div> <!-- /footer -->

</div> <!-- /sitewrapper -->

<?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?>
</body>
</html>
