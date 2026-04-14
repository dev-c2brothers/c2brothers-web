<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav>
  <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
    C<span>²</span> Brothers
  </a>

  <?php if ( has_nav_menu( 'primary' ) ) : ?>
    <?php wp_nav_menu( array(
      'theme_location' => 'primary',
      'container'      => false,
      'menu_class'     => '',
      'fallback_cb'    => false,
      'items_wrap'     => '<ul>%3$s</ul>',
      'walker'         => false,
    ) ); ?>
  <?php else : ?>
    <ul>
      <li><a href="#nosotros">Nosotros</a></li>
      <li><a href="#como">Cómo trabajamos</a></li>
      <li><a href="#sectores">Sectores</a></li>
      <li><a href="#contacto" class="nav-cta">Contáctanos</a></li>
    </ul>
  <?php endif; ?>
</nav>
