 <?php
    $h1_sub = get_field('h1_sub') ?: 'Fixibot в Омске';
    $h1 = get_field('h1') ? get_field('h1') : $post->post_title;

    $banner_sub = get_field('sub') ?: '';

    $banner_img = get_field('image') ? get_field('image')['sizes']['large'] : '/wp-content/uploads/2026/01/group-243.png';
    ?>
 <div class="services-hero">

     <div class="services-hero__content">


         <?php
            if (!empty($banner_sub)) {
                echo '<h1>' . $h1 . '</h1>';
                echo '<div class="services-hero__content__desc">' . $banner_sub . '</div>';
            } else {
                echo '<h1 class="m-40">' . $h1 . '</h1>';
            }
            ?>

         <div class="hero-discount">
             <div class="hero-discount__top">
                 <div class="hero-discount__offer">Скидка 10% действует ещё:</div>
                 <div class="hero-discount__timer">
                     <div class="hero-discount__timer-col">
                         <span class="hero-discount__timer-val" id="t-h">00</span>
                         <span class="hero-discount__timer-lbl">ч</span>
                     </div>
                     <div class="hero-discount__timer-sep">:</div>
                     <div class="hero-discount__timer-col">
                         <span class="hero-discount__timer-val" id="t-m">00</span>
                         <span class="hero-discount__timer-lbl">мин</span>
                     </div>
                     <div class="hero-discount__timer-sep">:</div>
                     <div class="hero-discount__timer-col">
                         <span class="hero-discount__timer-val" id="t-s">00</span>
                         <span class="hero-discount__timer-lbl">сек</span>
                     </div>
                 </div>
             </div>
             <form class="hero-discount__form form">
                 <input type="tel" name="tel" placeholder="+7 (___) ___-__-__" class="hero-discount__tel">
                 <button type="submit" class="btn hero-discount__btn">Получить скидку</button>
             </form>
         </div>
         <script>
             (function() {
                 function pad(n) {
                     return String(n).padStart(2, '0');
                 }

                 function tick() {
                     var now = new Date(),
                         end = new Date(now);
                     end.setHours(23, 59, 59, 0);
                     var d = Math.max(0, Math.floor((end - now) / 1000));
                     document.getElementById('t-h').textContent = pad(Math.floor(d / 3600));
                     document.getElementById('t-m').textContent = pad(Math.floor(d % 3600 / 60));
                     document.getElementById('t-s').textContent = pad(d % 60);
                 }
                 tick();
                 setInterval(tick, 1000);
             })();
         </script>

     </div>

     <?php
        // echo '<pre>';
        // var_dump($banner_img);
        // echo '</pre>';
        ?>
     <div class="services-hero__img">

         <div class="services-hero__img-dec">
             <img src="/img/dec.svg" alt="">
         </div>

         <img src="<?= $banner_img ?>" alt="" class="services__img">
     </div>

 </div>