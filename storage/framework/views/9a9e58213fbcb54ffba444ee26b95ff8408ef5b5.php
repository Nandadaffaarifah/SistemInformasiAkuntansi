
<?php $__env->startSection('judul','Laporan Laba Rugi - Sistem Informasi Akuntansi'); ?>

<?php $__env->startSection('content'); ?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Laporan Laba Rugi</h2>
                        <p class="mb-0 text-sm">Kelola Laporan Laba Rugi</p>
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
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th colspan="2">Pendapatan Usaha</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php $__currentLoopData = $akun->where('kelompok_akun_id', 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($item->nama); ?></td>
                                <td class="text-right pendapatan_neraca_saldo_debit"><?php echo e('Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3)); ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="2" class="text-right">Jumlah Pendapatan</th>
                            <th class="text-right" id="jumlah_pendapatan_debit"></th>
                            <th class="text-right" id="jumlah_pendapatan"></th>
                        </tr>
                        <tr>
                            <th colspan="2">Beban Usaha</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php $__currentLoopData = $akun->where('kelompok_akun_id',6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($item->nama); ?></td>
                                <td class="text-right beban_neraca_saldo_debit"><?php echo e('Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3)); ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="2" class="text-right">Total Aktiva Tetap</th>
                            <th class="text-right" id="jumlah_beban_debit"></th>
                            <th class="text-right" id="jumlah_beban"></th>
                        </tr>
                    </tbody>
                    <tfoot class="bg-primary text-white">
                        <tr>
                            <th colspan="3" class="text-right">Total Usaha</th>
                            <th class="text-right" id="total_usaha"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
        $("#jumlah_pendapatan_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('pendapatan_neraca_saldo_debit')));
        $("#jumlah_pendapatan").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('pendapatan_neraca_saldo_debit') - jumlah('pendapatan_neraca_saldo_kredit')));

        $("#jumlah_beban_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('beban_neraca_saldo_debit')));
        $("#jumlah_beban").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('beban_neraca_saldo_debit') - jumlah('beban_neraca_saldo_kredit')));

        $("#total_usaha").html('Rp. ' + new Intl.NumberFormat('id-ID').format(angka($("#jumlah_pendapatan").html()) - angka($("#jumlah_beban").html())));

        kriteria();
        $("#kriteria").change(function () {
            kriteria();
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Nanda-20069\akuntansi\resources\views/laporan/laba-rugi.blade.php ENDPATH**/ ?>