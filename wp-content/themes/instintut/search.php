<?php get_header(); ?>

<div class="content">
	<div class="bread__line">
	    <div class="container">

	        <ul class="breadcrumb">
	            <li><a href="/">Главная</a></li> 
	            <li class="active">Поиск по сайту</li>
	        </ul>

	    </div>
	</div>
	<div class="container">
		<div class="card">
			<h1>Поиск по сайту</h1>

			<?php if (1 == 2) : ?>
				<?php get_template_part('searchform') ?>
			<?php endif ?>

			<?php if ($_GET['s']) : ?>
				

				<?php if (have_posts()) : ?>

				    <div class="row facetwp-template auto-h posts-list">
				        <?php while (have_posts()) : the_post(); ?>
				            <div class="col-4">
				                <article class="post-item">
				                    
				                    <div class="post-item__title">
				                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				                    </div>
				                </article>
				            </div>
				        <?php endwhile; ?>
				    </div>

				<?php else: ?>

				    <p>
				        Ничего не найдено
				    </p>

				<?php endif; ?>


				<?php get_template_part( 'pagination' ); ?>
			<?php endif ?>

			
		</div>
	</div>
</div>


<?php get_footer(); ?>