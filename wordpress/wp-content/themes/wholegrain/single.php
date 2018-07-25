<?php
get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <h2><a href=<?php echo the_permalink(); ?>><?php the_title(); ?></a></h2>
        <em>Published on <?php the_time(); ?> by <?php the_author(); ?></em>
        <?php the_content(); ?>
        <?php comments_template(); ?>
        <?php
    endwhile;
else :
    ?>
    <h2>No Posts Found</h2>
    <p>Sorry, there are no posts yet.</p>
<?php
endif;
get_sidebar();
get_footer();
?>
