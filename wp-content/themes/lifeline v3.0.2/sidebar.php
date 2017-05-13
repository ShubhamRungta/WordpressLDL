<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
	<div class="sidebar three-column pull-right">
		<?php dynamic_sidebar( 'default-sidebar' ); ?>
    </div>
<?php endif; ?>