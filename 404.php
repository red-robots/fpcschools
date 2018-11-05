<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fpcschools
 */
$url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$validURL = str_replace("&", "&amp", $url);
$schools = array('weekday-school','child-development-center');
$parts = explode('/',$validURL);
$is_sub_site = '';
foreach($parts as $p) {
    if( in_array($p,$schools) ) {
        $is_sub_site = $p;
        break;
    }
}
if($is_sub_site) {
    get_template_part( 'header_subsite');
} else {
    get_header();
} ?>

	<div id="primary" class="content-area full clear">
		<main id="main" class="site-main wrapper" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fpcschools' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'fpcschools' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
