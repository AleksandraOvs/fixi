  <section class="about" id="about">
      <div class="container">
          <div class="row auto-h">
              <div class="col-6">
                  <div class="about__item">
                      <h2>
                          о нас
                          <br> <span><?= get_field('about_title') ?></span>
                      </h2>
                      <div class="about__text">
                          <?= get_field('about_text') ?>
                      </div>
                      <div class="about__sub">
                          <?= get_field('about_sub') ?>
                      </div>
                  </div>
              </div>
              <div class="col-6">
                  <div class="about__item about__item-blue">
                      <h2 class="about-item__title">
                          Наша миссия —
                      </h2>
                      <div class="about-item__sub">
                          <?= get_field('mission_text') ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>