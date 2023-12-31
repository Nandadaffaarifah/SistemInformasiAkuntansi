
<?php $__env->startSection('judul','Laporan Posisi Keuangan - Sistem Informasi Akuntansi'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .card .table td, .card .table th {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Laporan Posisi Keuangan</h2>
                        <p class="mb-0 text-sm">Kelola Laporan Posisi Keuangan</p>
                        <form class="mt-3" action="<?php echo e(url()->current()); ?>" method="get">
                            <div class="form-group row">
                                <label class="form-control-label col-md-3 col-form-label" for="kriteria">Kriteria</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="kriteria" id="kriteria">
                                        <option value="periode" <?php echo e(request('kriteria') == 'periode' ? 'selected' : ''); ?>>Periode</option>
                                        <option value="rentang-waktu" <?php echo e(request('kriteria') == 'rentang-waktu' ? 'selected' : ''); ?>>Rentang Waktu (tanggal awal s/d tanggal akhir)</option>
                                        <option value="bulan" <?php echo e(request('kriteria') == 'bulan' ? 'selected' : ''); ?>>Bulan</option>
                                    </select>
                                    <span class="invalid-feedback font-weight-bold"></span>
                                </div>
                            </div>
                            <div id="periode" class="form-group row">
                                <label class="form-control-label col-md-3 col-form-label" for="periode">Periode</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="periode" id="periode">
                                        <option value="1-bulan-terakhir" <?php echo e(request('periode') == '1-bulan-terakhir' ? 'selected' : ''); ?>>1 Bulan Terakhir</option>
                                        <option value="1-minggu-terakhir" <?php echo e(request('periode') == '1-minggu-terakhir' ? 'selected' : ''); ?>>1 Minggu Terakhir</option>
                                    </select>
                                    <span class="invalid-feedback font-weight-bold"></span>
                                </div>
                            </div>
                            <div id="rentang-waktu">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-3 col-form-label" for="tanggal_awal">Tanggal Awal</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="tanggal_awal" value="<?php echo e(request('tanggal_awal')); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-control-label col-md-3 col-form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="tanggal_akhir" value="<?php echo e(request('tanggal_akhir')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div id="bulan" class="form-group row">
                                <label class="form-control-label col-md-3 col-form-label" for="bulan">Bulan</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="month" name="bulan" value="<?php echo e(request('bulan')); ?>">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th colspan="5" class="text-center">Aktiva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">Aktiva Lancar</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $akun->where('kelompok_laporan_posisi_keuangan',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo e($item->nama); ?></td>
                                        <td class="text-right aktiva_lancar_neraca_saldo_debit"><?php echo e($item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td class="text-right aktiva_lancar_neraca_saldo_kredit"><?php echo e($item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th colspan="2" class="text-right">Total Aktiva Lancar</th>
                                    <th class="text-right" id="jumlah_aktiva_lancar_debit"></th>
                                    <th class="text-right" id="jumlah_aktiva_lancar_kredit"></th>
                                    <th class="text-right" id="jumlah_aktiva_lancar"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">Aktiva Tetap</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $akun->where('kelompok_laporan_posisi_keuangan',2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo e($item->nama); ?></td>
                                        <td class="text-right aktiva_tetap_neraca_saldo_debit"><?php echo e($item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td class="text-right aktiva_tetap_neraca_saldo_kredit"><?php echo e($item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th colspan="2" class="text-right">Total Aktiva Tetap</th>
                                    <th class="text-right" id="jumlah_aktiva_tetap_debit"></th>
                                    <th class="text-right" id="jumlah_aktiva_tetap_kredit"></th>
                                    <th class="text-right" id="jumlah_aktiva_tetap"></th>
                                </tr>
                            </tbody>
                            <tfoot class="bg-primary text-white">
                                <tr>
                                    <th colspan="4" class="text-right">Total Aktiva</th>
                                    <th class="text-right" id="total_aktiva"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <div class="col-md-6 mb-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th colspan="5" class="text-center">Kewajiban Dan Modal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">Utang Lancar</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $akun->where('kelompok_laporan_posisi_keuangan',4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo e($item->nama); ?></td>
                                        <td class="text-right utang_lancar_neraca_saldo_debit"><?php echo e('Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3)); ?></td>
                                        <td class="text-right utang_lancar_neraca_saldo_kredit">-</td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th colspan="2" class="text-right">Total Utang Lancar</th>
                                    <th class="text-right" id="jumlah_utang_lancar_debit"></th>
                                    <th class="text-right" id="jumlah_utang_lancar_kredit"></th>
                                    <th class="text-right" id="jumlah_utang_lancar"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">Utang Tetap</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $akun->where('kelompok_laporan_posisi_keuangan',3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo e($item->nama); ?></td>
                                        <td class="text-right utang_tetap_neraca_saldo_debit"><?php echo e($item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td class="text-right utang_tetap_neraca_saldo_kredit"><?php echo e($item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th colspan="2" class="text-right">Total Utang Tetap</th>
                                    <th class="text-right" id="jumlah_utang_tetap_debit"></th>
                                    <th class="text-right" id="jumlah_utang_tetap_kredit"></th>
                                    <th class="text-right" id="jumlah_utang_tetap"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">Modal</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $__currentLoopData = $akun->where('kelompok_akun_id',3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo e($item->nama); ?></td>
                                        <td class="text-right modal_neraca_saldo_debit"><?php echo e($item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td class="text-right modal_neraca_saldo_kredit"><?php echo e($item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php
                                        $pendapatan = neraca_akun(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $akun->where('kelompok_akun_id', 4));
                                        $pembiayaan = neraca_akun(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $akun->where('kelompok_akun_id', 6));
                                    ?>
                                    <td></td>
                                    <td>Laba Bersih</td>
                                    <td class="text-right modal_neraca_saldo_debit"><?php echo e('Rp. ' . substr(number_format($pendapatan - $pembiayaan, 2, ',', '.'),0,-3)); ?></td>
                                    <td class="text-right modal_neraca_saldo_kredit">-</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Total Modal</th>
                                    <th class="text-right" id="jumlah_modal_debit"></th>
                                    <th class="text-right" id="jumlah_modal_kredit"></th>
                                    <th class="text-right" id="jumlah_modal"></th>
                                </tr>
                            </tbody>
                            <tfoot class="bg-primary text-white">
                                <tr>
                                    <th colspan="4" class="text-right">Total Kewajiban Dan Modal</th>
                                    <th class="text-right" id="total_modal"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
        $("#jumlah_aktiva_lancar_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('aktiva_lancar_neraca_saldo_debit')));
        $("#jumlah_aktiva_lancar_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('aktiva_lancar_neraca_saldo_kredit')));
        $("#jumlah_aktiva_lancar").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('aktiva_lancar_neraca_saldo_debit') - jumlah('aktiva_lancar_neraca_saldo_kredit')));

        $("#jumlah_aktiva_tetap_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('aktiva_tetap_neraca_saldo_debit')));
        $("#jumlah_aktiva_tetap_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('aktiva_tetap_neraca_saldo_kredit')));
        $("#jumlah_aktiva_tetap").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('aktiva_tetap_neraca_saldo_debit') - jumlah('aktiva_tetap_neraca_saldo_kredit')));

        $("#total_aktiva").html('Rp. ' + new Intl.NumberFormat('id-ID').format(angka($("#jumlah_aktiva_lancar").html()) + angka($("#jumlah_aktiva_tetap").html())));

        $("#jumlah_utang_lancar_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('utang_lancar_neraca_saldo_debit')));
        $("#jumlah_utang_lancar_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('utang_lancar_neraca_saldo_kredit')));
        $("#jumlah_utang_lancar").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('utang_lancar_neraca_saldo_debit') - jumlah('utang_lancar_neraca_saldo_kredit')));

        $("#jumlah_utang_tetap_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('utang_tetap_neraca_saldo_debit')));
        $("#jumlah_utang_tetap_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('utang_tetap_neraca_saldo_kredit')));
        $("#jumlah_utang_tetap").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('utang_tetap_neraca_saldo_debit') - jumlah('utang_tetap_neraca_saldo_kredit')));

        $("#jumlah_modal_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('modal_neraca_saldo_debit')));
        $("#jumlah_modal_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('modal_neraca_saldo_kredit')));
        $("#jumlah_modal").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('modal_neraca_saldo_debit') - jumlah('modal_neraca_saldo_kredit')));

        $("#total_modal").html('Rp. ' + new Intl.NumberFormat('id-ID').format(angka($("#jumlah_utang_lancar").html()) + angka($("#jumlah_utang_tetap").html()) + angka($("#jumlah_modal").html())));

        kriteria();
        $("#kriteria").change(function () {
            kriteria();
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Nanda-20069\akuntansi\resources\views/laporan/posisi-keuangan.blade.php ENDPATH**/ ?>