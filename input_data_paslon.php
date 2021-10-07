<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("location:../index.php");
  exit;
}
include'../koneksi.php';

if(isset($_POST['simpan'])) {
  $ttl_formatur= mysqli_real_escape_string($koneksi, $_POST['ttl_formatur']);
  $nm_formatur= mysqli_real_escape_string($koneksi, $_POST['nm_formatur']);
  $no_urut= mysqli_real_escape_string($koneksi, $_POST['no_urut']);

  if($_POST['simpan']){
    $ekstensi_diperbolehkan = array('png','jpg','JPG');
    $gambar1 = $_FILES['gambar1']['name'];
    $x = explode('.', $gambar1);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gambar1']['size'];
    $file_tmp = $_FILES['gambar1']['tmp_name'];     
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran <= 2000000){          
        move_uploaded_file($file_tmp, 'foto/'.$gambar1);
        $query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar1')");
        $gambar2 = $_FILES['gambar2']['name'];
        $x = explode('.', $gambar2);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['gambar2']['size'];
        $file_tmp = $_FILES['gambar2']['tmp_name'];     
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
          if($ukuran <= 2000000){          
            move_uploaded_file($file_tmp, 'foto/'.$gambar2);
            $query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar2')");
			$gambar3 = $_FILES['gambar3']['name'];
			$x = explode('.', $gambar3);
			$ekstensi = strtolower(end($x));
			$ukuran = $_FILES['gambar3']['size'];
			$file_tmp = $_FILES['gambar3']['tmp_name'];     
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran <= 2000000){          
				move_uploaded_file($file_tmp, 'foto/'.$gambar3);
				$query = mysqli_query($koneksi, "INSERT INTO data_paslon VALUES(NULL, '$gambar3')");
          }
        }
          }
        }
      }
    }
  }
  
  mysqli_query($koneksi,"INSERT INTO data_paslon(id, ttl_formatur, nm_formatur, gambar1, no_urut)
    VALUES ('','$ttl_formatur','$nm_formatur','$gambar1','$no_urut')");
  
  echo "<script>window.alert('Data Berhasil ditambahkan')
  window.location='input_data_paslon.php'</script>";
  
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/Logo-Musyda-23-IPM-Sragen-Vertical.png">
  <title>PEMTUR IPM SRAGEN 2021</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <style type="text/css">
   img{
    width: 100%;
    height: 500px;
    text-align: center;
  }
  img{
    border-radius: 10px;
  }
</style>
</head>
<body>
  
  <div id="wrapper">
   <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="adjust-nav">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <!--  <img src="assets/img/Logo-Musyda-23-IPM-Sragen-Vertical.png" /> -->
          <h4 style="color: white;">PEMILIHAN CALON FORMATUR IPM SRAGEN 2021</h4>
        </a>
        
      </div>
      <!--
      <span class="logout-spn" >
        <a href="../logout.php" style="color:#fff;"><i class="fa fa-circle-o-notch"> Logout</i></a>  
      </span>
	  -->
    </div>
  </div>
  <!-- /. NAV TOP  -->
  <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
      <div class="menu">
        <ul class="nav" id="main-menu">
         
          <li>
            <a href="index.php"><i class="fa fa-desktop"></i>Beranda</a>
          </li>
          <?php
          $level = $_SESSION['level'] == 'admin';
          if($level){
            ?>

            <li>
              <a href="input_data_paslon.php"><i class="fa fa-user "></i>Input Data Calon Formatur</a>
            </li>

            <li>
              <a href="upload_dpt.php"><i class="fa fa-file"></i> Upload Data Pemilih</a>
            </li>

            <li>
              <a href="buat_akses.php"><i class="fa fa-lightbulb-o "></i>Buat Akses </a>
            </li>

            <li>
              <a href="hasil_suara.php"><i class=""></i>Hasil Suara </a>
            </li>

          <?php } ?>
          <li>
            <a href="../logout.php"><i class="fa fa-circle-o-notch "></i>Logout</a>
          </li>
          
        </ul>
      </div>
    </div>

  </nav>
  <!-- /. NAV SIDE  -->
  

  <div id="page-wrapper" >
    <div id="page-inner">
      <div class="row">
        <div class="col-lg-12">
          <h2><i class="fa fa-user"> Input data Calon Formatur</i></h2>   
        </div>
      </div>              
      <!-- /. ROW  -->

      <div class="row">
        <div class="col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Tanggal Lahir Calon Formatur</label>
              <input type="text" name="ttl_formatur" required="required" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Calon Formatur</label>
              <input type="text" name="nm_formatur" required="required" autocomplete="off" class="form-control">
            </div>
            <div class="form-group">
              <label>foto Calon Formatur</label>
              <input type="file" name="gambar1" required="required" class="form-control-file">
            </div>

            <div class="form-group">
              <label>Nomor Calon Formatur</label>
              <input type="text" name="no_urut" required="required" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success" name="simpan" value="Input" class="form-control">
            </div>
          </form>
        </div>

        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <h2>Data paslon</h2>  
              <div class="table-responsiv">
                <table class="table table-striped table-bordered table-hover">
                  <tr>
                    <th>Nama Calon Ketua</th>
                    <th>No paslon</th>
                    <th>Opsi</th>
                  </tr>
                  <?php
                  $data_paslon = mysqli_query($koneksi,"SELECT * FROM data_paslon");
                  while($d = mysqli_fetch_array($data_paslon)){
                    ?>
                    <tr>
                      <td><?php echo $d['nm_formatur']; ?></td>
                      <td><?php echo $d['no_urut']; ?></td>
                      <td><a class="btn btn-danger btn-circle" onclick="return confirm('Yakin hapus data ini !!!')" href="hapus.php?no_urut=<?php echo $d['no_urut']; ?>">Hapus</a>
                      </td>
                    </tr>
                  <?php } ?>
                </table>
              </div> 
            </div>
          </div>  
        </div>
      </div>
      <!-- /. ROW  --> 
    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- /. PAGE WRAPPER  -->
</div>


<div class="footer">
  <div class="row">
    <div class="col-lg-12" >
	
      <a href="https://www.instagram.com/ipmsragen" style="color:#fff;" target="_blank">
		&copy; PD IPM SRAGEN <?php echo date('Y') ?></a>
		
    </div>
  </div>
</div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>




</body>
</html>