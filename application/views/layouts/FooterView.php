<footer id="footer" class="container-fluid">

  <div class="container">
    <div class="row">
      <div class="col-md-3">

        <article>
          <h3>QaiserLab</h3>
          <p>QaiserLab adalah media pembelajaran online mengenai pemrograman dan pengembangan teknologi web.</p>
        </article>

      </div>
      <div class="col-md-3">

        <article>
          <h3>Kontak</h3>
          <p>Jl. Lombok Blok D4 Perum. Langkapura - Bandar Lampung</p>
          <br>
          <p>
            Kirim Email Ke Penulis @<br>
            f.anaturdasa@qaiserlab.com
            <br><br>
            <a href="<?= base_url('curriculum-vitae') ?>">Selengkapnya...</a>
          </p>
        </article>

      </div>
      <div class="col-md-6">

        <article>
          <h3>Dafearsoft Development Team</h3>
          <p>
            Menerima jasa pembuatan Aplikasi Web dan Android.
            <a href="http://dafearsoft.com">Selengkapnya...</a>
          </p>
          <br>
          <p style="text-align: right">Copyright &copy; Qaiserlab 2016 - <?= Date('Y') ?></p>
        </article>

      </div>
    </div>
  </div>

  <div id="share"></div>
  <script>
    $("#share").jsSocials({
      showLabel: false,
      showCount: false,
      // shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
      shares: ["twitter", "facebook", "googleplus"]
    });
  </script>

</footer>
