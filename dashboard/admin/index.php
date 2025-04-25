<div class="container mt-4"> 
  <!-- Alert Messages -->
  <?php if (isset($_SESSION['pesan'])) : ?>
    <div class="alert alert-info alert-dismissible fade show">
      <?= $_SESSION['pesan'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php unset($_SESSION['pesan']); ?>
  <?php endif; ?>
  
  <!-- Welcome Card -->
  <div class="card mb-4 shadow-sm">
  <img src="assets/image/posterbg.png" class="card-img-top" style="height: 280px; width: 100%; object-fit: cover;" alt="Restaurant Banner">
    <div class="card-body text-center">
      <h2 class="card-title font-weight-bold">Tentang Kami</h2>
<p class="text-center lead">Makanan Cepat Saji Berkualitas</p>
            <p>Dapur Aynie adalah usaha kuliner yang berfokus pada makanan cepat saji dengan cita rasa khas dan berkualitas. Kami berkomitmen untuk menyajikan hidangan lezat, higienis, dan cepat untuk pelanggan kami.</p>
            <p>Kami menawarkan berbagai pilihan menu favorit seperti ayam goreng krispi, burger, kentang goreng, serta minuman segar yang cocok untuk segala suasana. Dengan harga yang terjangkau dan pelayanan cepat, Dapur Aynie siap memenuhi kebutuhan kuliner Anda.</p>
    </div>
  </div>

  <!-- Food Section -->
  <div class="mb-5">
    <h3 class="font-weight-bold mb-3"><i class="fas fa-utensils mr-2"></i>Makanan</h3>
    <div class="row">
      <?php
        $query = "SELECT * FROM tb_masakan WHERE kategori_masakan='Makanan' ORDER BY id_masakan";
        $sql = mysqli_query($kon, $query);
        while($data = mysqli_fetch_array($sql)) :
      ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100 shadow-sm hover-card" style="border: 3px solid #4dabf7; border-radius: 10px;">
          <div class="position-relative">
            <img class="card-img-top" src="assets/image/makanan/<?= $data['foto'] ?>" alt="<?= $data['nama_masakan'] ?>">
            <?php if ($data['status_masakan'] == 1): ?>
              <span class="badge badge-success position-absolute" style="top: 10px; right: 10px;">Tersedia</span>
            <?php else: ?>
              <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">Tidak Tersedia</span>
            <?php endif; ?>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $data['nama_masakan'] ?></h5>
            <?php
              $harga = $data['harga_masakan'];
              if ($_SESSION['level'] == "") {
                $harga = $data['harga_masakan'] + 5000;
              }
            ?>
            <p class="card-text text-primary h5 mb-3">Rp. <?= rupiah($harga) ?></p>
            <div class="mt-auto">
            <?php if (isset($_SESSION['level']) && $_SESSION['level'] != ""): ?>
  <?php if ($data['status_masakan'] == 1): ?>
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#masakan_<?= $data['id_masakan']; ?>">
      <i class="fas fa-shopping-cart mr-2"></i>Beli
    </button>
  <?php else: ?>
    <button class="btn btn-secondary btn-block" disabled>
      <i class="fas fa-shopping-cart mr-2"></i>Beli
    </button>
  <?php endif; ?>
<?php endif; ?>

            </div>
          </div>
        </div>
      </div>

      <!-- Food Modal -->
      <div class="modal fade" id="masakan_<?= $data['id_masakan']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">
                <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
              </h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="fungsi/orderMakanan.php" method="POST">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/image/makanan/<?= $data['foto'] ?>" alt="<?= $data['nama_masakan'] ?>" class="img-fluid rounded">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" name="id_masakan" value="<?= $data['id_masakan'] ?>">
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-utensils mr-2"></i>Menu</label>
                      <input type="text" readonly class="form-control-plaintext font-weight-bold" value="<?= $data['nama_masakan'] ?>">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-tag mr-2"></i>Harga</label>
                      <input type="text" readonly class="form-control-plaintext text-primary font-weight-bold" value="Rp. <?= rupiah($data['harga_masakan']) ?>">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-sort-numeric-up mr-2"></i>Jumlah Pesanan</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-outline-secondary quantity-down">-</button>
                        </div>
                        <input type="number" class="form-control text-center quantity-input" name="jumlah" value="1" min="1" max="20">
                        <div class="input-group-append">
                          <button type="button" class="btn btn-outline-secondary quantity-up">+</button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-comment-alt mr-2"></i>Keterangan</label>
                      <textarea name="keterangan" class="form-control" placeholder="Tambahkan catatan khusus untuk pesanan Anda"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                  <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-cart-plus mr-2"></i>Tambah
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Drinks Section -->
  <div class="mb-5">
    <h3 class="font-weight-bold mb-3"><i class="fas fa-glass-cheers mr-2"></i>Minuman</h3>
    <div class="row">
      <?php
        $query2 = "SELECT * FROM tb_masakan WHERE kategori_masakan='Minuman' ORDER BY id_masakan";
        $sql2 = mysqli_query($kon, $query2);
        while($data = mysqli_fetch_array($sql2)) :
      ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm hover-card" style="border: 3px solid #4dabf7; border-radius: 10px;">
          <div class="position-relative">
            <img class="card-img-top" src="assets/image/makanan/<?= $data['foto'] ?>" alt="<?= $data['nama_masakan'] ?>">
            <?php if ($data['status_masakan'] == 1): ?>
              <span class="badge badge-success position-absolute" style="top: 10px; right: 10px;">Tersedia</span>
            <?php else: ?>
              <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">Tidak Tersedia</span>
            <?php endif; ?>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $data['nama_masakan'] ?></h5>
            <?php 
              $hargi = $data['harga_masakan'];
              if ($_SESSION['level'] == "") {
                $hargi = $data['harga_masakan'] + 3000;
              }
            ?>
            <p class="card-text text-primary h5 mb-3">Rp. <?= rupiah($hargi) ?></p>
            <div class="mt-auto">
            <?php if (isset($_SESSION['level']) && $_SESSION['level'] != ""): ?>
  <?php if ($data['status_masakan'] == 1): ?>
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#masakan_<?= $data['id_masakan']; ?>">
      <i class="fas fa-shopping-cart mr-2"></i>Beli
    </button>
  <?php else: ?>
    <button class="btn btn-secondary btn-block" disabled>
      <i class="fas fa-shopping-cart mr-2"></i>Beli
    </button>
  <?php endif; ?>
<?php endif; ?>

            </div>
          </div>
        </div>
      </div>

      <!-- Drinks Modal -->
      <div class="modal fade" id="masakan_<?= $data['id_masakan']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">
                <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
              </h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="fungsi/orderMakanan.php" method="POST">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/image/makanan/<?= $data['foto'] ?>" alt="<?= $data['nama_masakan'] ?>" class="img-fluid rounded">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" name="id_masakan" value="<?= $data['id_masakan'] ?>">
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-glass-cheers mr-2"></i>Menu</label>
                      <input type="text" readonly class="form-control-plaintext font-weight-bold" value="<?= $data['nama_masakan'] ?>">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-tag mr-2"></i>Harga</label>
                      <input type="text" readonly class="form-control-plaintext text-primary font-weight-bold" value="Rp. <?= rupiah($data['harga_masakan']) ?>">
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-sort-numeric-up mr-2"></i>Jumlah Pesanan</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-outline-secondary quantity-down">-</button>
                        </div>
                        <input type="number" class="form-control text-center quantity-input" name="jumlah" value="1" min="1" max="20">
                        <div class="input-group-append">
                          <button type="button" class="btn btn-outline-secondary quantity-up">+</button>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="font-weight-bold"><i class="fas fa-comment-alt mr-2"></i>Keterangan</label>
                      <textarea name="keterangan" class="form-control" placeholder="Tambahkan catatan khusus untuk pesanan Anda"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                  <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-cart-plus mr-2"></i>Tambah
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<!-- Add this to your CSS file or in a style tag in the head -->
<style>
  .hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  
  .card-img-top {
    height: 180px;
    object-fit: cover;
  }
  
  /* For quantity input buttons */
  .quantity-input {
    border-radius: 0;
  }
</style>

<!-- Add this to your JS file or in a script tag before the closing body tag -->
<script>
  // JavaScript for quantity buttons
  document.addEventListener('DOMContentLoaded', function() {
    // Quantity up buttons
    document.querySelectorAll('.quantity-up').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var input = this.parentNode.previousElementSibling;
        var value = parseInt(input.value, 10);
        if (value < parseInt(input.max, 10)) {
          input.value = value + 1;
        }
      });
    });
    
    // Quantity down buttons
    document.querySelectorAll('.quantity-down').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var input = this.parentNode.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > parseInt(input.min, 10)) {
          input.value = value - 1;
        }
      });
    });
  });
</script>