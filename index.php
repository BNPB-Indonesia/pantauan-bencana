<!DOCTYPE html>
<html>
<head>
  <title>PANTAUAN BENCANA</title>
  <?php
  include "head.php";
  ?>
  <?php
  include "connect.php";
  ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#"><i class="fas fa-globe" style="font-size:2vh"></i> Kejadian Bencana</a>
</nav>
<?php 
			$s_kejadian="";
            if (isset($_POST['submit'])) {
                $s_kejadian = $_POST['s_kejadian'];
            }
      $s_provinsi="";
            if (isset($_POST['submit'])) {
                $s_provinsi = $_POST['s_provinsi'];
            }
      $search_provinsi = '%'. $s_provinsi .'%';
      $s_kabupaten="";
            if (isset($_POST['submit'])) {
                $s_kabupaten = $_POST['s_kabupaten'];
            }
      $search_kabupaten = '%'. $s_kabupaten .'%';
		?>
<div id="myNav" class="overlay">
  <div class="overlay-content">    
    <h1 style="text-align:center;color:white;background-color:#ee7942;font-size:calc(3px + 0.8vw);font-family:Roboto;"><b>Pencarian Data Bencana</h1>
  
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <div class="col-75">
          <div class="row-xs-2 form-group ">
                <label style="text-align:center;color:black;font-size:calc(3px + 0.5vw);font-family:Roboto;">Jenis Kejadian Bencana</label>
              <div class="input-group">
                    <div class="input-group-addon">
                        <span style="text-align:left;font-size:calc(3px + 0.5vw)" class="glyphicon glyphicon-list"></span>
                    </div>
                      <select style="font-size:calc(3px + 0.5vw)" name="s_kejadian" id="s_kejadian" class="form-control">
                        <option disabled selected> Kejadian </option>
                          <?php 
                          $ar_kejadian=$pdo->query("SELECT kejadian FROM data_bencana GROUP BY kejadian");
                          while ($dis=$ar_kejadian->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                        <option value="<?=$dis['kejadian']?>"><?=$dis['kejadian']?></option> 
                          <?php
                          }
                          ?>
                      </select>
                </div> 
            </div>
          <div class="row-xs-2 form-group ">
                <label style="text-align:center;color:black;font-size:calc(3px + 0.5vw);font-family:Roboto;">Provinsi</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <span style="text-align:left;font-size:calc(3px + 0.5vw)" class="glyphicon glyphicon-list-alt"></span>
                    </div>
                      <select style="font-size:calc(3px + 0.5vw)" name="s_provinsi" id="s_provinsi" class="form-control">
                          <option disabled selected> Provinsi </option>
                          <?php 
                          $ar_provinsi=$pdo->query("SELECT provinsi FROM data_bencana GROUP BY provinsi");
                          while ($prov=$ar_provinsi->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                          <option value="<?=$prov['provinsi']?>"><?=$prov['provinsi']?></option> 
                          <?php
                          }
                          ?>
                      </select>
                  </div> 
            </div>
          <div class="row-xs-2 form-group ">
              <label style="text-align:center;color:black;font-size:calc(3px + 0.5vw);font-family:Roboto;">Tanggal Awal</label>
                  <div class="input-group date" data-provide="datepicker">
                      <div class="input-group-addon">
                          <span style="text-align:left;font-size:calc(3px + 0.5vw)" class="glyphicon glyphicon-calendar"></span>
                      </div>
                      <input id="tgl_mulai" placeholder="masukkan tanggal Awal" style="font-size:calc(3px + 0.5vw)" type="text" class="form-control" name="tgl_awal"  value="<?php if (isset($_POST['tgl_awal'])) echo $_POST['tgl_awal'];?>" >
                  </div>
              </div>
          <div class="row-xs-2 form-group ">
              <label style="text-align:center;color:black;font-size:calc(3px + 0.5vw);font-family:Roboto;">Tanggal Akhir</label>
                  <div class="input-group date" data-provide="datepicker">
                      <div class="input-group-addon">
                          <span style="text-align:left;font-size:calc(3px + 0.5vw)" class="glyphicon glyphicon-calendar"></span>
                      </div>
                      <input id="tgl_akhir" placeholder="masukkan tanggal Akhir" style="font-size:calc(3px + 0.5vw)" type="text" class="form-control" name="tgl_akhir" value="<?php if (isset($_POST['tgl_akhir'])) echo $_POST['tgl_akhir'];?>">
                  </div>
            </div>

              <script type="text/javascript">
                $(function(){
                    $(".datepicker").datepicker({
                        format: 'dd/mm/yyyy',
                        autoclose: true,
                        todayHighlight: false,
                    });
                    $("#tgl_mulai").on('changeDate', function(selected) {
                        var startDate = new Date(selected.date.valueOf());
                        $("#tgl_akhir").datepicker('setStartDate', startDate);
                        if($("#tgl_mulai").val() > $("#tgl_akhir").val()){
                            $("#tgl_akhir").val($("#tgl_mulai").val());
                        }
                    });
                });
              </script>
        
          <div class="row-xs-2 form-group">
              <input style="font-size:calc(3px + 0.5vw)" type="submit" id="submit" name="submit" class="btn btn-info" value="Cari Data">
            </div>
          </div>
    </form>
  </div>
</div>

<div id="myNav" class="overlay-right">
  <div class="overlay-content-right">
    <h1 style="color:white;background-color:#ee7942;font-size:calc(2px + 0.5vw);font-family:Roboto;">  Legenda</h1>
    <img src="icon/banjir.png" class="responsive" alt="Trulli" width="20" height="20">
        <text style="font-size:calc(1px + 0.5vw)">  Banjir</text><br>
    <img src="icon/gel_tinggi.png" class="responsive" alt="Trulli" width="20" height="20">  
        <text style="font-size:calc(1px + 0.5vw)">  Gelombang Tinggi / Abrasi</text><br>
    <img src="icon/longsor.png" class="responsive" alt="Trulli" width="20" height="20"> 
        <text style="font-size:calc(1px + 0.5vw)">  Tanah Longsor</text><br>
    <img src="icon/putingbeliung.png" class="responsive" alt="Trulli" width="20" height="20">  
        <text style="font-size:calc(1px + 0.5vw)">  Puting Beliung</text><br>
    <img src="icon/karhutla.png" class="responsive" alt="Trulli" width="20" height="20">  
        <text style="font-size:calc(1px + 0.5vw)">  Karhutla</text><br>
    <img src="icon/kekeringan.png" class="responsive" alt="Trulli" width="20" height="20">
        <text style="font-size:calc(1px + 0.5vw)">  Kekeringan</text><br>
    <img src="icon/gempabumi.png" class="responsive" alt="Trulli" width="20" height="20">  
        <text style="font-size:calc(1px + 0.5vw)">  Gempabumi</text><br>
    <img src="icon/tsunami.png" class="responsive" alt="Trulli" width="20" height="20">  
        <text style="font-size:calc(1px + 0.5vw)">  Tsunami</text><hr>
    <text style="font-size:calc(1px + 0.4vw)">Sumber data:<br><a href="dibi.bnpb.go.id" target="_blank">Data dan Informasi Bencana Indonesia</a></text> 
  </div>
</div>

<div id="map" class="container-fluid"></div>

<script>
function openNav() {
  document.getElementById("myNav").style.width = "16%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}

var map = L.map('map').setView([-3.824181, 114.8191513],5);

   //Basemap
    var basemap0 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'OpenStreetMap | GIS BNPB'
    });
    var basemap1 = L.tileLayer('http://a.tile.stamen.com/terrain/{z}/{x}/{y}.png', {
      attribution: 'Stamen Terrain'
    });
    var basemap2 = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
       maxZoom: 20,
       subdomains:['mt0','mt1','mt2','mt3'],
       attribution: 'Google Satellite'
    });
    basemap0.addTo(map);

    var iconku = L.Icon.extend({
      options: {
        iconSize: [30, 30],
        iconAnchor: [16, 30],
        popupAnchor: [0, -30]
      }
    });

    <?php 
    include "connect.php";
    $setUri['assets']='localhost/databencana/';
    $search_kejadian = '%'. $s_kejadian .'%';
    
    $tgl_awal=date('Y-m-d', strtotime($_POST["tgl_awal"]));
    $tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));
            
    if ($search_kejadian!='Kejadian'||$search_provinsi=='Provinsi'&&empty($_POST['tgl_awal'])&& empty($_POST['tgl_akhir'])){
        $sql=$pdo->query("SELECT * FROM data_bencana WHERE kejadian LIKE '%$search_kejadian%' AND tanggal_status > NOW() - interval '14' day");
    }

    if ($search_provinsi!='Provinsi'||$search_kejadian=='Kejadian'&&empty($_POST['tgl_awal'])&& empty($_POST['tgl_akhir'])){
      $sql=$pdo->query("SELECT * FROM data_bencana WHERE provinsi LIKE '%$search_provinsi%' AND tanggal_status > NOW() - interval '14' day");
    }

    if ($search_provinsi!='Provinsi'&&$search_kejadian!='Kejadian'&&empty($_POST['tgl_awal'])&& empty($_POST['tgl_akhir'])){
      $sql=$pdo->query("SELECT * FROM data_bencana WHERE provinsi LIKE '%$search_provinsi%' AND kejadian LIKE '%$search_kejadian%' AND tanggal_status > NOW() - interval '14' day");
    }

    elseif ($search_kejadian=='Kejadian'&&$search_provinsi=='Provinsi'&&isset($_POST['tgl_awal'])&& isset($_POST['tgl_akhir'])){
      $sql=$pdo->query("SELECT * FROM data_bencana WHERE  tanggal_status BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal_status DESC");
    }

    elseif ($search_kejadian!='Kejadian'&&$search_provinsi=='Provinsi'&&isset($_POST['tgl_awal'])&& isset($_POST['tgl_akhir'])){
        $sql= $pdo->query("WITH subquery AS (SELECT * FROM data_bencana WHERE  tanggal_status BETWEEN '$tgl_awal' AND '$tgl_akhir') SELECT * FROM subquery WHERE kejadian LIKE '%$search_kejadian%' ORDER BY tanggal_status DESC");
    }

    elseif ($search_kejadian=='Kejadian'&&$search_provinsi!='Provinsi'&&isset($_POST['tgl_awal'])&& isset($_POST['tgl_akhir'])){
      $sql= $pdo->query("WITH subquery AS (SELECT * FROM data_bencana WHERE  tanggal_status BETWEEN '$tgl_awal' AND '$tgl_akhir') SELECT * FROM subquery WHERE provinsi LIKE '%$search_provinsi%' ORDER BY tanggal_status DESC");
    }
    
    elseif ($search_kejadian!='Kejadian'&&$search_provinsi!='Provinsi'&&isset($_POST['tgl_awal'])&& isset($_POST['tgl_akhir'])){
      $sql= $pdo->query("WITH subquery AS (SELECT * FROM data_bencana WHERE  tanggal_status BETWEEN '$tgl_awal' AND '$tgl_akhir') SELECT * FROM subquery WHERE provinsi LIKE '%$search_provinsi%' AND kejadian LIKE '%$search_kejadian%' ORDER BY tanggal_status DESC");
    }

    else {
        $sql=$pdo->query("SELECT * from data_bencana where tanggal_status > NOW() - interval '14' day");
    }

      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
      ?>
     $png=".png";
      L.marker([<?=$row['latitude']?>,<?=$row['longitude']?>],{icon: new iconku({iconUrl: '<?=($row['id_jenis_bencana']=='')?('assets/icons/marker.png'):('icon/'.$row['id_jenis_bencana'].'.png')?>'})}).addTo(map).bindPopup("Kejadian: <?=$row['kejadian']?><br>Kabupaten: <?=$row['kabkot']?><br>Tanggal :<?=$row['tanggal_status']?>");
      <?php
    }
      ?>
</script>
     
</body>
</html>
