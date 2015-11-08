<?php
 global $post;
 $myposts = get_posts('numberposts=5&category=1'); ?>

<section>
    <?php foreach($myposts as $post) : ?>
    <h2><?php echo $post["post_title"]?></h2>
    <div><?php echo $post["post_content"]?></div>
    <?php endforeach; ?>
</section>

<?php
 global $post;
 $myposts = get_posts('numberposts=5');
?>



<div id="post-entry" class="archive_tn_cat_color_0">
    <section class="post-entry-inner">
        <?php foreach($myposts as $recentPost): ?>

            <?php $url = get_permalink($recentPost->ID); ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $recentPost->ID ), 'single-post-thumbnail' ); ?>
            <?php die(get_post_thumbnail_id( $recentPost->ID )); ?>
            <?php die($image); ?>
        <!-- POST START -->
        <article class="alt-post post-77 post type-post status-publish format-standard has-post-thumbnail hentry has_thumb" id="post-77">

            <div class="post-thumb in-archive"><a href="<?php echo($url); ?>" title="ISFJ – “De Verzorger”"><img width="300" height="auto" class="alignleft" src="<?php echo $image; ?>" alt="SJ - &quot;De Beschermers&quot;" title="<?php echo $recentPost->post_title;?>"></a></div>
            <div class="post-right">
                <h1 class="post-title"><a href="<?php echo($url); ?>" rel="bookmark" title="ISFJ – “De Verzorger”"><?php echo $recentPost->post_title;?></a></h1>
                <div class="post-meta the-icons pmeta-alt">
                    <span class="post-author"><i class="icon-user"></i><a href="http://www.16persoonlijkheden.nl/author/admin/" title="Berichten van <?php echo $recentPost->post_author;?>" rel="author"><?php echo $recentPost->post_author;?></a></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-time"><i class="icon-time"></i><?php echo $recentPost->post_date;?></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>

                <div class="post-content">
                    <?php echo $recentPost->post_content_filtered; ?>...<div class="post-more"><a href="<?php echo($url); ?>" title="ISFJ – “De Verzorger”">Lees verder »</a></div></div>
            </div>
        </article>
        <!-- POST END -->
        <?php endforeach; ?>

</div>






        <!-- POST START -->
        <article class="post-75 post type-post status-publish format-standard has-post-thumbnail hentry category-sj has_thumb" id="post-75">

            <div class="post-thumb in-archive"><a href="http://www.16persoonlijkheden.nl/esfj-de-supporter/" title="ESFJ – “De Supporter”"><img width="300" height="auto" class="alignleft" src="http://www.16persoonlijkheden.nl/wp-content/uploads/2013/10/ESFJ1-300x300.png" alt="SJ - &quot;De Beschermers&quot;" title="ESFJ – “De Supporter”"></a></div>
            <div class="post-right">
                <h1 class="post-title"><a href="http://www.16persoonlijkheden.nl/esfj-de-supporter/" rel="bookmark" title="ESFJ – “De Supporter”">ESFJ – “De Supporter”</a>aaaa</h1>
                <div class="post-meta the-icons pmeta-alt">
                    <span class="post-author"><i class="icon-user"></i><a href="http://www.16persoonlijkheden.nl/author/admin/" title="Berichten van Vincent Lam" rel="author">Vincent Lam</a></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-time"><i class="icon-time"></i>21 oktober, 2013</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-category"><i class="icon-file"></i><a href="http://www.16persoonlijkheden.nl/category/persoonlijkheden/sj/" title="View all posts in SJ - " de="" beschermers""="">SJ - "De Beschermers"</a></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-comment"><i class="icon-comment"></i><a href="http://www.16persoonlijkheden.nl/esfj-de-supporter/#respond">No Comment</a></span>
                </div>

                <div class="post-content">
                    Vriendelijk, praktisch, loyaal, georganiseerd, harmonieus en ondersteunend. ESFJ’s houden van mensen en zijn vaak geïnteresseerd in anderen. Ze gebruiken hun &nbsp;Zintuigen en&nbsp;Oordelen&nbsp;om specifieke, gedetailleerde informatie over anderen te verzamelen...<div class="post-more"><a href="http://www.16persoonlijkheden.nl/esfj-de-supporter/" title="ESFJ – “De Supporter”">Lees verder »</a></div></div>


            </div>
        </article>
        <!-- POST END -->






        <!-- POST START -->
        <article class="alt-post post-73 post type-post status-publish format-standard has-post-thumbnail hentry category-sj has_thumb" id="post-73">

            <div class="post-thumb in-archive"><a href="http://www.16persoonlijkheden.nl/istj-de-examinator/" title="ISTJ – “De Examinator”"><img width="300" height="auto" class="alignleft" src="http://www.16persoonlijkheden.nl/wp-content/uploads/2013/10/ISTJ1-300x300.png" alt="SJ - &quot;De Beschermers&quot;" title="ISTJ – “De Examinator”"></a></div>
            <div class="post-right">
                <h1 class="post-title"><a href="http://www.16persoonlijkheden.nl/istj-de-examinator/" rel="bookmark" title="ISTJ – “De Examinator”">ISTJ – “De Examinator”</a>aaaa</h1>
                <div class="post-meta the-icons pmeta-alt">
                    <span class="post-author"><i class="icon-user"></i><a href="http://www.16persoonlijkheden.nl/author/admin/" title="Berichten van Vincent Lam" rel="author">Vincent Lam</a></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-time"><i class="icon-time"></i>21 oktober, 2013</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-category"><i class="icon-file"></i><a href="http://www.16persoonlijkheden.nl/category/persoonlijkheden/sj/" title="View all posts in SJ - " de="" beschermers""="">SJ - "De Beschermers"</a></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-comment"><i class="icon-comment"></i><a href="http://www.16persoonlijkheden.nl/istj-de-examinator/#respond">No Comment</a></span>
                </div>

                <div class="post-content">
                    Verantwoordelijk, praktisch, logisch, methodisch, betrouwbaar en leider. ISTJ’s zijn rustige en achterhoudende individuen, ze zijn zeer geïnteresseerd in veiligheid en een vredige leven. Vaak hebben ze ook een sterke...<div class="post-more"><a href="http://www.16persoonlijkheden.nl/istj-de-examinator/" title="ISTJ – “De Examinator”">Lees verder »</a></div></div>


            </div>
        </article>
        <!-- POST END -->






        <!-- POST START -->
        <article class="post-71 post type-post status-publish format-standard has-post-thumbnail hentry category-sj has_thumb" id="post-71">

            <div class="post-thumb in-archive"><a href="http://www.16persoonlijkheden.nl/estj-de-bewaker/" title="ESTJ – “De Bewaker”"><img width="300" height="auto" class="alignleft" src="http://www.16persoonlijkheden.nl/wp-content/uploads/2013/10/ESTJ1-300x300.png" alt="SJ - &quot;De Beschermers&quot;" title="ESTJ – “De Bewaker”"></a></div>
            <div class="post-right">
                <h1 class="post-title"><a href="http://www.16persoonlijkheden.nl/estj-de-bewaker/" rel="bookmark" title="ESTJ – “De Bewaker”">ESTJ – “De Bewaker”</a>aaaa</h1>
                <div class="post-meta the-icons pmeta-alt">
                    <span class="post-author"><i class="icon-user"></i><a href="http://www.16persoonlijkheden.nl/author/admin/" title="Berichten van Vincent Lam" rel="author">Vincent Lam</a></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-time"><i class="icon-time"></i>21 oktober, 2013</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-category"><i class="icon-file"></i><a href="http://www.16persoonlijkheden.nl/category/persoonlijkheden/sj/" title="View all posts in SJ - " de="" beschermers""="">SJ - "De Beschermers"</a></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="post-comment"><i class="icon-comment"></i><a href="http://www.16persoonlijkheden.nl/estj-de-bewaker/#respond">No Comment</a></span>
                </div>

                <div class="post-content">
                    Georganiseerd, praktisch, logisch, energiek, gedisciplineerd en leider. ESTJ’s leven in de wereld van feiten en concrete behoeften. Ze leven in het heden, met hun oog die constant hun persoonlijke...<div class="post-more"><a href="http://www.16persoonlijkheden.nl/estj-de-bewaker/" title="ESTJ – “De Bewaker”">Lees verder »</a></div></div>


            </div>
        </article>
        <!-- POST END -->








        <div id="post-navigator">
        </div>


    </section>
</div>