<?php
/**
 * Template Name: Mobile App welcome
 * This template will only display the content you entered in the page editor
 * If no content is available a default welcome animation will be displayed.
 */
?>

<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>
<?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            the_content();
        } 
    }
    else {
        readfile('page-app-welcome-default-content-part.html');
    }
?>
<?php wp_footer(); ?>
</body>
</html>
