<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
    <div class="uk-container">
        <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
            <div class="uk-width-expand">
                <ul class="uk-breadcrumb uk-margin-remove">
                <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
                <li><a href="<?= site_url('admin/modules') ?>"><?= lang('modules') ?></a></li>
                </ul>
                <h1 class="uk-h3 uk-text-bold uk-margin-remove">Sitemap</h1>
            </div>
            <div class="uk-width-auto"></div>
        </div>
        <div class="uk-margin" uk-grid>
        <div class="uk-width-1-3@s uk-width-1-4@m">
            <div class="uk-card uk-card-default">
                <ul class="uk-nav-default" uk-nav>
                    <li class="uk-nav-header"><?= lang('menu') ?></li>
                    <li class="uk-active"><a href="<?= site_url('sitemap/admin') ?>"><?= lang('dashboard') ?></a></li>
                    <li><a href="<?= site_url('sitemap/admin/manage') ?>"><?= lang('manage') ?></a></li>
                </ul>
            </div>
        </div>

        <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-grid-match uk-child-width-1-12 uk-child-width-1-12@s uk-margin-small" uk-grid>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-width-auto">
                  <span class="fa-stack bc-stack-medium">
                    <span class="bc-color-blue bc-icon-drop-shadow">
                      <i class="fa-solid fa-circle fa-stack-2x"></i>
                    </span>
                    <i class="fa-solid fa-cog fa-stack-1x fa-inverse"></i>
                  </span>
                </div>
                <div class="uk-width-expand">
                  <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="<?= $total_sitemaps ?>">0</span></h3>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('sitemap_added') ?></p>
                </div>
              </div>
            </div>
          </div>
          </div>
          
        </div>
    </div>
</section>