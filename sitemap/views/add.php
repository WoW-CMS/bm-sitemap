<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
        <li class="uk-nav-header"><?= lang('menu') ?></li>
            <li><a href="<?= site_url('sitemap/admin') ?>"><?= lang('dashboard') ?></a></li>
            <li><a href="<?= site_url('sitemap/admin/manage') ?>"><?= lang('manage') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('add_sitemap') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open_multipart(current_url()) ?>
      <div class="uk-margin" uk-grid>
        <div class="uk-width-1-12@s uk-width-1-12@m">
          <div class="uk-card uk-card-default uk-margin">
            <div class="uk-card-body">
              <div class="uk-grid-small uk-margin-small" uk-grid>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('name') ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="name" value="<?= set_value('name') ?>" placeholder="<?= lang('name') ?>" autocomplete="off">
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('url') ?></label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="url" value="<?= set_value('url') ?>" placeholder="<?= lang('url') ?>" autocomplete="off">
                    </div>
                    <?= form_error('url', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('priority') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select tail-single" id="select_priority" name="select_priority" autocomplete="off" data-placeholder="<?= lang('select_priority') ?>">
                        <?php foreach ($priorityOptions as $priorityValue => $priorityDescription): ?>
                            <option value="<?= $priorityValue ?>"><?= lang($priorityDescription) ?></option>
                        <?php endforeach ?>
                    </select>
                  </div>
                  <?= form_error('priority', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-primary uk-visible@s" type="submit"><?= lang('add') ?></button>
        </div>
        
      </div>
      <button class="uk-button uk-button-primary uk-hidden@s" type="submit"><?= lang('add') ?></button>
    <?= form_close() ?>
  </div>
</section>