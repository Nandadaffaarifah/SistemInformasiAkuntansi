
<?php $__env->startSection('judul', 'Buku Besar - Sistem Informasi Akuntansi'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Buku Besar</h2>
                        <p class="mb-0 text-sm">Kelola Buku Besar</p>
                        <form class="mt-3" action="<?php echo e(route("buku-besar.index")); ?>" method="get">
                            <div class="form-group row">
                                <label class="form-control-label col-md-3" for="kode_akun">Akun</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="kode_akun" id="kode_akun">
                                        <?php $__currentLoopData = App\Models\Akun::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->kode); ?>" <?php echo e(request('kode_akun') == $item->kode ? 'selected' : ''); ?>><?php echo e($item->kode); ?> - <?php echo e($item->nama); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="invalid-feedback font-weight-bold"></span>
                                </div>
                            </div>
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
                                        <option value="hari-ini" <?php echo e(request('periode') == 'hari-ini' ? 'selected' : ''); ?>>Hari Ini</option>
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

<?php if($akun && $jurnal): ?>
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                <span class="font-weight-900">Nama Akun : <?php echo e($akun->nama); ?></span>
                <span class="font-weight-900">Kode Akun : <?php echo e($akun->kode); ?></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;" width="100px"><a href="<?php echo e(request('tanggal') == 1 ? url()->full() . '&tanggal=0' : url()->full() . '&tanggal=1'); ?>">Tanggal <?php echo request('tanggal') == 1 ? '<i class="fas fa-caret-up"></i>' : '<i class="fas fa-caret-down"></i>'; ?></a></th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Keterangan</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Debit</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Kredit</th>
                                <th colspan="2" style="text-align: center;">Saldo</th>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle; text-align: center;">Debit</th>
                                <th style="vertical-align: middle; text-align: center;">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nilai = 0;
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $jurnal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    if ($item['debit_atau_kredit'] == $item['akun_post_saldo']) {
                                        $nilai += $item['nilai'];
                                    } else {
                                        $nilai -= $item['nilai'];
                                    }
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo e(tgl($item['tanggal'])); ?></td>
                                    <td><?php echo e($item['keterangan']); ?></td>
                                    <td class="text-right"><?php echo e($item['debit_atau_kredit'] == 1 ? 'Rp. ' . substr(number_format($item['nilai'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                    <td class="text-right"><?php echo e($item['debit_atau_kredit'] == 2 ? 'Rp. ' . substr(number_format($item['nilai'], 2, ',', '.'),0,-3) : '-'); ?></td>
                                    <td class="text-right"><?php echo e($item['akun_post_saldo'] == 1 ? 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) : '-'); ?></td>
                                    <td class="text-right"><?php echo e($item['akun_post_saldo'] == 2 ? 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) : '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="15" align="center">Data tidak tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $('#btn-cari').click(function (e) {
            e.preventDefault();
            $("#cari").modal('show');
        });

        $('#kode_akun').select2({
            placeholder: "Pilih Akun",
            allowClear: true
        });

        kriteria();

        $("#kriteria").change(function () {
            kriteria();
        });
    });

    function kriteria(){
        switch ($("#kriteria").val()) {
            case 'periode':
                $("#periode").show();
                $("#rentang-waktu").hide();
                $("#bulan").hide();
                break;
            case 'rentang-waktu':
                $("#periode").hide();
                $("#rentang-waktu").show();
                $("#bulan").hide();
                break;
            case 'bulan':
                $("#periode").hide();
                $("#rentang-waktu").hide();
                $("#bulan").show();
                break;
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Nanda-20069\akuntansi\resources\views/buku-besar/index.blade.php ENDPATH**/ ?>