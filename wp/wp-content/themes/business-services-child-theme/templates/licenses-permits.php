<?php
/*
Template Name: Licenses/Permits
*/
get_header(); ?>

	<div class="gdlr-content licenses-permits-page">

		<!-- Above Sidebar Section-->
		<?php global $gdlr_post_option, $above_sidebar_content, $with_sidebar_content, $below_sidebar_content; ?>
		<?php if(!empty($above_sidebar_content)){ ?>
			<div class="above-sidebar-wrapper"><?php gdlr_print_page_builder($above_sidebar_content); ?></div>
		<?php } ?>

		<!-- Sidebar With Content Section-->
		<?php
			if( !empty($gdlr_post_option['sidebar']) && ($gdlr_post_option['sidebar'] != 'no-sidebar' )){
				global $gdlr_sidebar;

				$gdlr_sidebar = array(
					'type'=>$gdlr_post_option['sidebar'],
					'left-sidebar'=>$gdlr_post_option['left-sidebar'],
					'right-sidebar'=>$gdlr_post_option['right-sidebar']
				);
				$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
		?>
	</div>
</div>
			<div id="filter" class="with-sidebar-wrapper gray-bg">
				<div class="with-sidebar-left <?php echo esc_attr($gdlr_sidebar['outer']); ?> columns">
				<div class="with-sidebar-container container">
					<?php get_sidebar('left'); ?>

					<?php get_sidebar('right'); ?>
					<div class="with-sidebar-content <?php echo esc_attr($gdlr_sidebar['center']); ?> columns">
							<?php
								if( !empty($with_sidebar_content) ){
									gdlr_print_page_builder($with_sidebar_content, false);
								}
								if( !empty($gdlr_post_option['show-content']) && $gdlr_post_option['show-content'] != 'disable' ){
									get_template_part('single/content', 'all-documents');
								}
							?>

		<?php
			}else{
				if( !empty($with_sidebar_content) ){
					echo '<div class="with-sidebar-wrapper">';
					gdlr_print_page_builder($with_sidebar_content);
					echo '</div>';
				}
				if( empty($gdlr_post_option['show-content']) || $gdlr_post_option['show-content'] != 'disable' ){
					get_template_part('single/content', 'all-documents');
				}
			}
		?>


		<!-- Below Sidebar Section-->
		<?php if(!empty($below_sidebar_content)){ ?>
			<div class="below-sidebar-wrapper"><?php gdlr_print_page_builder($below_sidebar_content); ?></div>
		<?php } ?>
	</div>

</div>

	</div><!-- gdlr-content -->
<?php get_footer(); ?>
