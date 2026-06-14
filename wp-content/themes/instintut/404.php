<?php get_header(); ?>

<style>
.p404 {
	min-height: 100vh;
	background: #11b8ec;
}
.p404__content {
	display: flex;
	gap: 40px;
}
</style>

<div class="p404">
	<div class="container">
		<div class="p404__content">
			<div class="p404__image">
				<img src="/img/404.png" alt="">
			</div>
			<div class="p404__text">
				<div class="p404__title">
					Fixibot<br> работает
				</div>
				<div class="p404__sub">
					над этой<br> страницей
				</div>
				<div class="p404__action">
					<a href="/" class="btn">Вернуться на главную</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
