<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
    <div class="uk-container">
        <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
        <div class="uk-width-expand">
            <ul class="uk-breadcrumb uk-margin-remove">
            <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
            <li><a href="<?= site_url('admin/modules') ?>"><?= lang('modules') ?></a></li>
            <li><a href="<?= site_url('sitemap/admin') ?>"><?= lang('sitemap') ?></a></li>
            </ul>
            <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('products') ?></h1>
        </div>
        <div class="uk-width-auto"></div>
        </div>
        <div class="uk-margin" uk-grid>
        <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('menu') ?></li>
            <li><a href="<?= site_url('sitemap/admin') ?>"><?= lang('dashboard') ?></a></li>
            <li><a href="<?= site_url('sitemap/admin/manage') ?>"><?= lang('manage') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title"><?= lang('sitemap') ?></h3>
                    </div>
                    <div class="uk-width-auto">
                        <div class="uk-button-group">
                        <button href="#filter_toggle" class="uk-button uk-button-default uk-button-small" type="button" uk-toggle="target: #filter_toggle; animation: uk-animation-slide-top-small"><i class="fa-solid fa-filter"></i></button>                            <a href="<?= site_url('sitemap/admin/generate') ?>" class="uk-button uk-button-default uk-button-small uk-margin-small-left"><i class="fa-solid fa-spinner"></i> <?= lang('generate') ?></a>
                            <a href="<?= site_url('sitemap/admin/add') ?>" class="uk-button uk-button-default uk-button-small uk-margin-small-left"><i class="fa-solid fa-pen"></i> <?= lang('add') ?></a>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="uk-card-body uk-padding-remove">
                <div id="filter_toggle" class="uk-padding-small" hidden>
                <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-small"><i class="fa-solid fa-filter fa-lg"></i> <?= lang('filter') ?></h6>
                <form action="<?= current_url() ?>" method="get" accept-charset="utf-8">
                    <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand@s">
                        <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input class="uk-input" type="text" name="search" value="" placeholder="<?= lang('search') ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="uk-width-auto@s">
                        <button class="uk-button uk-button-primary" type="submit"><?= lang('search') ?></button>
                    </div>
                    </div>
                </form>
                </div>
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small uk-margin-remove">
                    <thead>
                        <tr>
                        <th class="uk-table-expand"><?= lang('name') ?></th>
                        <th class="uk-width-medium"><?= lang('url') ?></th>
                        <th class="uk-width-medium"><?= lang('priority') ?></th>
                        <th class="uk-width-medium"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sitemap as $item): ?>
                        <tr>
                        <td><?= $item->module ?></td>
                        <td><?= $item->url ?></td>
                        <td><?= $item->priority ?></td>
                        <td>
                            <div class="uk-button-group">
                                <li><a href="<?= site_url('sitemap/admin/edit/'.$item->id) ?>" class="uk-button uk-button-default uk-button-small uk-margin-small-left"><span class="bc-li-icon"><i class="fa-solid fa-pen-to-square"></i></span><?= lang('edit') ?></a></li>
                                <li><a href="<?= site_url('sitemap/admin/delete/'.$item->id) ?>" class="uk-button uk-button-default uk-button-small uk-margin-small-left"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
                            </div>
                        </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>