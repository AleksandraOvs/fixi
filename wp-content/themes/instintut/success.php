<?php 
/* Template Name: Успешно */
get_header(); 
?>

<style>
body {
	background: var(--green);
	color: #fff;
}
.success {
	min-height: 100vh;
	display: flex;
	flex-direction: row;
	align-items: center;
	justify-content: center;
}
.success__title {
	font-size: 42px;
	line-height: 50px;
	font-weight: bold;
	margin-bottom: 10px;
}
.success__in {
	text-align: center;
	font-size: 18px;
}
</style>

<div class="success">
	<div class="success__in">
		<div class="success__icon">
			<img src="/img/success.svg" alt="" title="">
		</div>
		<div class="success__title">
			Заявка успешно отправлена
		</div>
		<div class="success__text">
			Наш менеджер свяжется с Вами <br>в ближайшее время!
		</div>
	</div>
</div>

<script>
setTimeout(function() {
	window.location.href = '/';
}, 6000);
</script>

<?php get_footer(); ?>