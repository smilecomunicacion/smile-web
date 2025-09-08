<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smile-web
 */

get_header();
?>

<div id="intro" class="carousel slide height-archive"></div><!-- #intro -->

<main id="main" class="blog-page area-padding bg-light">
	<div class="container">
		<div class="row">
			<!-- Breadcrumbs -->
			<div id="breadcrumbs" class="col-12">
				<nav aria-label="breadcrumb">
					<ol itemscope itemtype="https://schema.org/BreadcrumbList" class="bg-light breadcrumb">
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item">
                                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="item" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
								<span itemprop="name"><?php esc_html_e( 'Home', 'smile-web' ); ?></span>
							</a>
							<meta itemprop="position" content="1" />
						</li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item active">
							<?php the_archive_title( '<span itemprop="name">', '</span>' ); ?>
							<meta itemprop="position" content="2" />
						</li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row">
			<!-- Main Content -->
			<div class="col-md-8">
				<?php if ( have_posts() ) : ?>
					<header class="archive-header mb-4">
						<h1 class="archive-title"><?php the_archive_title(); ?></h1>
						<p class="archive-description"><?php the_archive_description(); ?></p>
					</header>
					<div class="archive-posts">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', get_post_format() );
						endwhile;

						// Pagination.
						the_posts_pagination(
							array(
								'prev_text' => __( '&larr; Previous', 'smile-web' ),
								'next_text' => __( 'Next &rarr;', 'smile-web' ),
							)
						);
						?>
					</div>
				<?php else : ?>
					<h2 class="no-posts"><?php esc_html_e( 'No posts found.', 'smile-web' ); ?></h2>
				<?php endif; ?>
			</div>

			<!-- Sidebar -->
			<aside id="secondary" class="col-md-4 widget-area">
				<?php get_sidebar(); ?>
			</aside>
		</div> <!-- END .row -->
	</div> <!-- END .container -->
</main>

<?php get_footer(); ?>