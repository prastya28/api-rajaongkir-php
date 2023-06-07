<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Rajaongkir</title>

    <link rel="stylesheet" href="./assets/css/tabler.min.css">
</head>

<body>

    <div class="page">
        <div class="container-xl">
            <div class="page-body">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    Data Belanjaan
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="w-1">No</th>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Subharga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">1</td>
                                            <td>Test produk 1234567890</td>
                                            <td>X</td>
                                            <td>X</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-12">
                    <form method="post" class="card">
                        <div class="card-header">
                            <h3 class="card-title">Alamat</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Provinsi</label>
                                    <div>
                                        <select class="form-select" name="nama_provinsi">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <div>
                                        <select class="form-select" name="nama_distrik">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Kurir</label>
                                    <div>
                                        <select class="form-select" name="nama_ekspedisi">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Paket</label>
                                    <div>
                                        <select class="form-select" name="nama_paket">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-start">
                            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" class="form-control" name="provinsi" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control" name="distrik" value="">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Tipe</label>
                                    <input type="text" class="form-control" name="tipe" value="">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Kode POS</label>
                                    <input type="text" class="form-control" name="kodepos" value="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label class="form-label">Kurir</label>
                                    <input type="text" class="form-control" name="ekspedisi" value="">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Paket</label>
                                    <input type="text" class="form-control" name="paket" value="">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Berat (gr)</label>
                                    <input type="number" class="form-control" name="total_berat" value="1200">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Ongkir</label>
                                    <input type="text" class="form-control" name="ongkir" value="">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Estimasi</label>
                                    <input type="text" class="form-control" name="estimasi" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="./assets/js/tabler.min.js"></script>
    <script src="./assets/js/jquery-1.12.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'dataprovinsi.php',
                success: function(hasil_provinsi) {
                    $("select[name=nama_provinsi]").html(hasil_provinsi);
                }
            });

            $("select[name=nama_provinsi]").on("change", function() {
                // Ambil id_provinsi yang terpilih
                var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

                $.ajax({
                    type: 'post',
                    url: 'datadistrik.php',
                    data: 'id_provinsi=' + id_provinsi_terpilih,
                    success: function(hasil_distrik) {
                        $("select[name=nama_distrik]").html(hasil_distrik);
                    }
                });
            });

            $.ajax({
                type: 'post',
                url: 'dataekspedisi.php',
                success: function(hasil_ekspedisi) {
                    $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
                }
            });

            $("select[name=nama_ekspedisi]").on("change", function() {
                // Ambil data ongkir

                // Mendapatkan ekspedisi yang terpilih
                var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();

                // Mendapatkan id_distrik yang terpilih
                var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
                // alert(distrik_terpilih);

                // Mendapatkan total total_berat dari input box
                var total_berat = $("input[name=total_berat]").val();

                $.ajax({
                    type: 'post',
                    url: 'datapaket.php',
                    data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
                    success: function(hasil_paket) {
                        $("select[name=nama_paket]").html(hasil_paket);
                        // console.log(hasil_paket);

                        // Letakkan nama ekspedisi_terpilih di input ekspedisi
                        $("input[name=ekspedisi]").val(ekspedisi_terpilih);

                    }
                });
            });

            $("select[name=nama_distrik]").on("change", function() {
                var prov = $("option:selected", this).attr("nama_provinsi");
                var dist = $("option:selected", this).attr("nama_distrik");
                var tipe = $("option:selected", this).attr("tipe_distrik");
                var kodepos = $("option:selected", this).attr("kodepos");

                $("input[name=provinsi]").val(prov);
                $("input[name=distrik]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kodepos]").val(kodepos);
            });

            $("select[name=nama_paket]").on("change", function() {
                var paket = $("option:selected", this).attr("paket");
                var ongkir = $("option:selected", this).attr("ongkir");
                var etd = $("option:selected", this).attr("etd");

                $("input[name=paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd);
            });
        });
    </script>
</body>

</html>