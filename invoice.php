<?php
session_start();
include 'koneksi.php';
include 'fungsi.php';
$invoice = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM  master_gaji where id_master_gaji = '" . $_GET["id"] . "' ORDER BY bulan desc "));
$karyawannya = "SELECT *
                                                    FROM karyawan
                                                    INNER JOIN master_gaji ON master_gaji.nik=karyawan.nik
                                                    INNER JOIN golongan ON golongan.nama_golongan=karyawan.nama_golongan
                                                    INNER JOIN jabatan ON jabatan.jabatan=karyawan.jabatan
                                                    where karyawan.nik='" . $invoice["nik"] . "'";
$d = mysqli_fetch_array(mysqli_query($conn, $karyawannya));
if ($d['status'] == 'Menikah') {
    $status = 'Menikah';
    $tjsi = $d['tunjangan_suami_istri'];
    $tja = $d['tunjangan_anak'] * $d['jumlah_anak'];
    $lembur = $d['uang_lembur'] * $d['lembur'];
    // $income = $d['pendapatan'];
    $income = $d['gapok'] + $d['tunjangan'] + $tjsi + $tja + $d['uang_makan'] + $lembur + $d['askes'];
    $sum = $income - $d['potongan'];
} else {
    $status = 'Belum Menikah';

    $tjsi = 0;
    $tja = 0;

    $lembur = $d['uang_lembur'] * $d['lembur'];
    // $income = $d['pendapatan'];
    $income = $d['gapok'] + $d['tunjangan'] + $d['uang_makan'] + $lembur + $d['askes'];
    $sum = $income - $d['potongan'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <style>
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 16
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: left;
            font-size: 16
        }

        .invoice table .no {
            color: #3989c6;
            font-size: 16;
            /* background: #3989c6 */
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: left;
            padding: 10px 20px;
            font-size: 16;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 20;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
</head>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">

    <!-- <div class="toolbar hidden-print">
        <div class="text-left">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div> -->
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="http://www.bakrie-pipe.com/">
                            <img src="assets\img\file.jpg" data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <!-- <a target="_blank" href="https://lobianijs.com"> -->
                            PT. BAKRIE PIPE INDUSTRIES
                            </a>
                        </h2>
                        <div>Alamat : Jl. Sultan Agung No.KM 28, RT.005/RW.0, Medan Satria</div>
                        <div>Kecamatan Medan Satria, Kota Bks, Jawa Barat 17131</div>
                        <div>+62 21 2994 1270</div>
                        <div> commercial@bakrie-pipe.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?= $d["nama_karyawan"] ?></h2>
                        <div class="address">Tel: <?= $d["nomor_telepon"] ?></div>
                        <div class="address">Address: <?= $d["alamat"] ?></div>
                        <!-- <div class="email"><a href="mailto:john@example.com">john@example.com</a></div> -->
                    </div>
                    <div class="col invoice-details">
                        <h3 class="invoice-id">INVOICE <?= $_GET["id"] ?></h3>
                        <div class="date">Date of Invoice: <?= date_format(date_create($invoice["bulan"]), "d F Y") ?></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-left">JUMLAH</th>
                            <!-- <th class="text-left">HOURS</th> -->
                            <th class="text-left">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="no">01</td>
                            <td class="text-left">
                                <h3>Gaji Pokok</h3>
                            </td>
                            <td class="unit"><?= buatRp($d['gapok']) ?></td>
                            <!-- <td class="qty">-</td> -->
                            <td class="total"><?= buatRp($d['gapok']) ?></td>
                        </tr>
                        <tr>
                            <td class="no">02</td>
                            <td class="text-left">
                                <h3>Tunjangan Jabatan</h3>
                            </td>
                            <td class="unit"><?= buatRp($d['tunjangan']) ?></td>
                            <!-- <td class="qty">-</td> -->
                            <td class="total"><?= buatRp($d['tunjangan']) ?></td>
                        </tr>
                        <tr>
                            <td class="no">03</td>
                            <td class="text-left">
                                <h3>Tunjangan Suami Istri</h3>
                            </td>
                            <td class="unit"><?= buatRp($tjsi) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($tjsi) ?></td>
                        </tr>
                        <tr>
                            <td class="no">04</td>
                            <td class="text-left">
                                <h3>Tunjangan Anak</h3>
                            </td>
                            <td class="unit"><?= buatRp($tja) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($tja) ?></td>
                        </tr>
                        <tr>
                            <td class="no">05</td>
                            <td class="text-left">
                                <h3>Uang Makan</h3>
                            </td>
                            <td class="unit"><?= buatRp($d['uang_makan']) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($d['uang_makan']) ?></td>
                        </tr>
                        <tr>
                            <td class="no">06</td>
                            <td class="text-left">
                                <h3>Lembur</h3>
                            </td>
                            <td class="unit"><?= buatRp($lembur) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($lembur) ?></td>
                        </tr>
                        <tr>
                            <td class="no">07</td>
                            <td class="text-left">
                                <h3>Askes</h3>
                            </td>
                            <td class="unit"><?= buatRp($d['askes']) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($d['askes']) ?></td>
                        </tr>
                        <tr>
                            <td class="no">08</td>
                            <td class="text-left">
                                <h3>Pendapatan</h3>
                            </td>
                            <td class="unit"><?= buatRp($income) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($income) ?></td>
                        </tr>
                        <tr>
                            <td class="no">09</td>
                            <td class="text-left">
                                <h3>Potongan</h3>
                            </td>
                            <td class="unit"><?= buatRp($d['potongan']) ?></td>
                            <!-- <td class="qty">20</td> -->
                            <td class="total"><?= buatRp($d['potongan']) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <!-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$5,200.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>$1,300.00</td>
                        </tr> -->
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="0">Total</td>
                            <td><?= buatRp($sum) ?></td>
                        </tr>
                    </tfoot>
                </table>
                <!-- <div class="thanks">Thank you!</div> -->
                <!-- <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div> -->
            </main>
            <!-- <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer> -->
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>