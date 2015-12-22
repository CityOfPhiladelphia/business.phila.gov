  <div class="container">
    <?php
      $business_page_category = get_the_category();
      $business_page_cat_id = $business_page_category[0]->cat_ID;

      // Set up the objects needed
      $all_pages_query = new WP_Query();
      $all_wp_pages = $all_pages_query->query(array(
        'post_type' => 'business_page',
        'posts_per_page' => -1,
        'order' => 'asc',
        'orderby' => 'title'
        )
      );
      $current_id = get_the_ID();

      // Filter through all pages and find this pages's children
      $children = get_page_children( $current_id, $all_wp_pages );

      foreach($children as $child) {

      $current_child_ID = $child->ID;
      $required_docs = get_field('required', $current_child_ID);

      if( $required_docs )  {?>
          <?php echo '<div class="inner"' . 'id="' .$child->post_name .'">'; ?>
         <?php echo '<h3>' . $child->post_title . '</h3>'; ?>
          <div class="right one columns label">Download PDF</div>
          <div class="clear"></div>

          <?php
              foreach( $required_docs as $required_doc ){

                $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );
                $pdf =  rwmb_meta( 'business_pdf', $args = array(), $required_doc->ID );
                $link =  rwmb_meta( 'business_link', $args = array(), $required_doc->ID );

                ?><div class="document-row group">
                          <div class="list nine columns"><?php

                        echo '<a class="h3" href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';

                          //pass the post ID to get_post, then extract the excerpt
                          echo  '<p>' . get_post($required_doc->ID)->post_excerpt . '</p>';

                        echo '</div>';// ten

                        echo '<div class="more one columns">' . '<a href="' . $required_doc->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>';

                     echo '<div class="pdf one columns">';
                        if ( !$pdf == '' ){
                            echo '<a href="' . $pdf . '" class="button red">
                            <i class="fa fa-file-pdf-o fa-inverse"></i>
                            </a>';
                        }else {
                            echo '<span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span>';
                        }
                      echo '</div>';//nine
                    echo '</div>';//document-row
                    }//end foreach



              $maybe_docs = get_field('might_need', $current_child_ID);
              if( !$maybe_docs == '' ): ?>
                <div class="gray-callout">
                  <h6>You may also need:</h6>
                  <ul>
                <?php foreach( $maybe_docs as $maybe_doc ){

                    $content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );

                      echo '<li class="pipe"><a href="' . $maybe_doc->guid .'">'  .         $maybe_doc->post_title . '</a></li>';
                      }
                    ?>
                  </ul>
                    </div>

                    <?php endif; ?>

                </div><!--end inner -->

              <?php
              }//end for each child
            }//end req.
            ?>
        </div>
      </div><!--.container-->
