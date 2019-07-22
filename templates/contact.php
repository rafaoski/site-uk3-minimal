<?php namespace ProcessWire; ?>

<!-- CONTACT INFO -->
<div id="hero" class='contact-info'>
  <div class="basic-info uk-flex uk-flex-center uk-flex-middle" data-uk-grid>

    <div class="contact-seo uk-width-1-2@m">
      <div class="uk-card uk-card-body uk-card-default uk-margin-top">
        <div class="uk-card-badge"><span data-uk-icon="icon: info; ratio: 1.5"></span></div>
        <h1 class='uk-h2'><?= page('meta_title') ?></h1>
        <h2 class='uk-h4'><?= page('meta_description') ?></h2>
      </div>
    </div>

    <div class='uk-width-1-2@m'>
      <div class='uk-card uk-card-body uk-card-primary'>
         <div class="uk-card-badge"><span data-uk-icon="icon: mail; ratio: 1.5"></span></div>
     <!-- If you want to have more control over the data, create three text fields ( phone, e_mail, adress ) and assign to this template
     Finally, delete unnecessary comments ...
      <ul>
        <li><b><?php // echo setting('phone') ?>:</b> <?php // echo page('phone') ?></li>
        <li><b><?php // echo setting('e-mail') ?>:</b>
            <a href='mailto:<?php // echo page('e_mail') ?>'><?php // echo page('e_mail') ?></a></li>
        <li><b><?php // echo setting('adress') ?>:</b> <?php // echo page('adress') ?></li>
      </ul> -->
        <?= page()->body ?>
        </div>
    </div>

  </div>
</div>
<!-- CONTACT INFO -->

<div id="content-body">

   <div class='uk-flex uk-flex-center'>
     <?= page('google_map') ?>
   </div>

</div>
