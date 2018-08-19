<div id="ProductSingleView" class="container">
  <div class="row">

    <div class="col-md-9">

      <h3><?= $rowProduct['title'] ?></h3>
      <h4 class="price">
        Harga:
        <b>
          Rp. <?= $rowProduct['_price'] ?>
        </b>
      </h4>
      <sup>
        <?= $rowProduct['postedDate'] ?> |
        <a href="<?= $rowProduct['categoryPermalink'] ?>">
          <?= $rowProduct['category'] ?>
        </a>
      </sup>
      <br>

      <center>
        <div class="slider-for">
          <?php if (!empty($rowProduct['featuredImage'])): ?>
            <div>
              <img src="<?= $rowProduct['_featuredImage'] ?>"
              style="height: 320px"
              alt="">
            </div>
          <?php endif; ?>

          <?php foreach ($rowProduct['_images'] as $image): ?>
            <div>
              <img src="<?= $image ?>"
              style="height: 320px"
              alt="">
            </div>
          <?php endforeach; ?>
        </div>
        <br>

        <div class="slider-nav">
          <?php if (!empty($rowProduct['featuredImage'])): ?>
            <div>
              <img src="<?= $rowProduct['_featuredImage'] ?>"
              style="height: 80px"
              alt="">
            </div>
          <?php endif; ?>

          <?php foreach ($rowProduct['_images'] as $image): ?>
            <div>
              <img src="<?= $image ?>"
              style="height: 80px"
              alt="">
            </div>
          <?php endforeach; ?>
        </div>
        <br>

        <script>
          $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
          });
          $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: true,
            dots: false,
            centerMode: true,
            focusOnSelect: true
          });
        </script>

      </center>

      <?= $rowProduct['content'] ?>

      <section>
        <div id="disqus_thread"></div>
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://qaiserlab.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
      </section>

    </div>
    <div class="col-md-3">

      <?php $this->load->view('widgets/CategoryView', ['dataSource' => $rsCategory]) ?>
      <?php $this->load->view('widgets/TagView', ['dataSource' => $rsTag]) ?>

    </div>

  </div>
</div>
