<div class="container">
  <div class="row">

    <div class="col-md-9">

      <h3><?= $rowPost['title'] ?></h3>
      <sup>
        <?= $rowPost['postedDate'] ?> |
        <a href="<?= $rowPost['categoryPermalink'] ?>">
          <?= $rowPost['category'] ?>
        </a>
      </sup>
      <br>

      <article>
        <?php if (!empty($rowPost['featuredImage'])): ?>
          <img src="<?= $rowPost['_featuredImage'] ?>"
          align="left"
          style="height: 240px; margin: 8px"
          alt="<?= $rowPost['title'] ?>">
        <?php endif; ?>

        <?= $rowPost['content'] ?>
      </article>

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
