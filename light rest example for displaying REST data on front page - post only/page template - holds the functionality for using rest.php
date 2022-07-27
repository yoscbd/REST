<?php
/**
 * Template Name: homepage notes
 *
 * Template for displaying homepage without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');

if (is_front_page()) {
    get_template_part('global-templates/hero');
}
?>

<div class="wrapper" id="full-width-page-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content">





        <main class="site-main" id="main" role="main">

 
        

            <section class="section-forth">

                <?php
if (current_user_can('administrator')) {
    ?>
<!-- template for the inputs that allow user to send a rest request:-->
                <div class="create-note">
                    <h2 class="headline headline--medium">Create New Note</h2>
                    <input class="new-note-title" placeholder="note text" required>
                    <!-- <textarea class="new-note-body" placeholder="Your note here..."></textarea>-->
                    <span class="submit-note">Create Note</span>
                    <p class="note_users-message">you must enter some text for this note</p>
                </div>

                <style>
                .create-note {
                    padding: 4rem;
                }

                .note_users-message {
                    display: none;
                }
                </style>

                <?php }?>
                <div class="section-container">



                    <div class="left">

                        <h4>With Trullion’s AI-powered lease accounting software you can</h4>

                        <ul class="min-list link-list" id="my-notes">
                            <?php

//First load: fetch latest notes custom post, limit to 5 items and populate them on the dom:
							$userNotes = new WP_Query(array(
								'post_type' => 'note',
								'posts_per_page' => 5,
								'orderby' => 'date',
								'order' => 'DESC',
							));

							while ($userNotes->have_posts()) {
								$userNotes->the_post();?>


                            <li data-id="<?php the_ID();?>"><i class="fa fa-check-square"
                                    aria-hidden="true"></i><?php echo esc_attr(get_the_title()); ?></li>



                            <?php }

?>
                        </ul>
                        <style>
                        #my-notes,
                        #my-notes li,
                        #my-notes p,
                        #my-notes i {
                            color: #fff;
                            list-style-type: none;
                        }
                        </style>
                        <!-- reset the main query loop -->
                        <?php wp_reset_postdata();?>

                        <button class="cta-button" type="button">Book a demo</button>




                    </div>
                    <div class="right">

                        <?php display_acf_img('section_4_trail', 'full');?>



                    </div>

                </div>


            </section>


           
 



        </main><!-- #main -->





    </div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();