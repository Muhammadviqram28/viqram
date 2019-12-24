<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home</title>

    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><a href="#">
                                <p><i class="fa fa-user"></i> Dinas Perdagangan</p>
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                        <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logoindag.jpg" alt="logo" width="70" height="70"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">About Us</a></li>

                    </ul>
                </div>
            </div>
            <!--/.container-->
        </nav>
        <!--/nav-->
    </header>
    <!--/header-->


    <section id="blog" class="container">
        <div class="center">
            <h2>Pendataan Kartu Keluarga</h2>

        </div>

        <?php 



        include('koneksi.php');

        $jdh = 10;
        $jd = count(query("SELECT * FROM kk"));
        $jh = ceil($jd / $jdh);
        $ha = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
        $ad = ($jdh * $ha) - $jdh;

        $mhs = query("SELECT * FROM kk LIMIT $ad, $jdh");


        if (isset($_POST["cari"])) {

            $mhs = cari($_POST["keyword"]);
        }

        ?>



        <div class="container">
            <div class="row">

                <div class="span12">
                    <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
                    <div>
                        <br>
                    </div>
                    <div style="text-align: right;">
                        <form action="" method="post">
                            <input type="text" name="keyword" size="30" autofocus placeholder="cari" autocomplete="off">
                            <button type="submit" name="cari" class="btn btn-info ">Cari!</button>
                        </form>
                        <div>
                            <?php if ($ha > 1) : ?>
                            <a href="?halaman=<?= $ha - 1; ?>">Sebelumnya&laquo;</a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $jh; $i++) : ?>
                            <?php if ($i == $ha) : ?>
                            <a href="?halaman= <?= $i; ?>" style="font-weight: bold;color: black;">
                                <?= $i; ?></a>
                            <?php else : ?>
                            <a href="?halaman= <?= $i; ?>">
                                <?= $i; ?></a>
                            <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($ha < $jh) : ?>
                            <a href="?halaman=<?= $ha + 1; ?>">&raquo;Selanjutnya</a>
                            <?php endif; ?>

                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Kartu Keluarga</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Alamat</th>
                                <th>Pekerjaan</th>
                                <th>No Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mhs as $row) : ?>


                            <tr>
                                <td>
                                    <?= $i ?>
                                </td>
                                <td>
                                    <?= $row["no_kk"]; ?>
                                </td>
                                <td>
                                    <?= $row["nama_kk"]; ?>
                                </td>
                                <td>
                                    <?= $row["alamat"]; ?>
                                </td>

                                <td>
                                    <?= $row["pekerjaan"]; ?>
                                </td>

                                <td>
                                    <?= $row["no_hp"]; ?>
                                </td>

                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                    <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('yakin akan dihapus');">Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="span12">
                <a href="print.php" target="_blank" class="btn btn-primary">Cetak Data</a>
                <div>

    </section>
    <!--/#blog-->



    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2019. Bambang Irianto .TEKNIK INFORMATIKA "A". </div>
                <div class="col-sm-6">
                    <ul class="pull-right">


                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
</body>

</html> 