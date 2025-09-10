<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package smile-web
 */

get_header();
?>
<section id="intro">
<div class="container">
       <p class="text-emphasis mt-4"> <?php esc_html_e( 'Search:', 'smile-web' ); ?> </p>
        <h1 class="page-title text-heading"> <?php echo esc_html( get_search_query() ); ?> </h1>
</div><!-- .page-header -->

</section>
<!-- #intro -->
<main id="main" class="search-page pt-4 pb-4 bg-primary">
	<div class="container">
		<div id="breadcrumbs" class="pb-4">
			<nav aria-label="breadcrumb">
                             <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb bg-primary">
                                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><i class="fa fa-home"></i><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="item" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>"><span itemprop="name">
					<?php esc_html_e( 'Home', 'smile-web' ); ?></span></a>
						<meta itemprop="position" content="1" />
					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumb-item"><span itemprop="name"><?php esc_html_e( 'Search Results', 'smile-web' ); ?></span>
						<meta itemprop="position" content="2" />
					</li>
				</ol>
			</nav>
		</div>

		<hr>
		<div class="row">
			<p><?php esc_html_e( 'Do you want to search again?', 'smile-web' ); ?></p>
                        <a id="myBtn2" href="#" class="btn-cta m-2 buscar jquery" aria-label="<?php echo esc_attr__( 'Open search', 'smile-web' ); ?>" itemprop="url" data-bs-toggle="modal" data-bs-target="#searchModal" rel="nofollow noopener noreferrer"><span title="busca en la web" aria-hidden="true"></span> <?php esc_html_e( 'Search again', 'smile-web' ); ?></a>
		</div>
		<hr>
		<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

				<?php
			endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

		endif;
			?>
		<?php the_posts_navigation(); ?>
	</div>
	<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<!-- #main -->
<?php
get_footer();
