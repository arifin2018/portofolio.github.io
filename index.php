<?php
session_start();
// include "koneksi.php";

function get_CURL($url)
{
  // persiapkan curl
  $curl = curl_init();

  // set url 
  curl_setopt($curl, CURLOPT_URL, $url);

  // return the transfer as a string 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  // $output contains the output string 
  $output = curl_exec($curl);

  // tutup curl 
  curl_close($curl);

  return json_decode($output, true);
  // var_dump($result);
  // echo $output;
}

//corona virus
$result = get_CURL("https://api.covid19api.com/summary");
$newConfirmed = $result['Global']['NewConfirmed'];
$totalConfirmed = $result['Global']['TotalConfirmed'];
$NewDeaths = $result['Global']['NewDeaths'];
$TotalDeaths = $result['Global']['TotalDeaths'];
$NewRecovered = $result['Global']['NewRecovered'];
$TotalRecovered = $result['Global']['TotalRecovered'];

//indonesia
$IDnewConfirmed = $result['Countries'][77]['NewConfirmed'];
$IDtotalConfirmed = $result['Countries'][77]['TotalConfirmed'];
$IDNewDeaths = $result['Countries'][77]['NewDeaths'];
$IDTotalDeaths = $result['Countries'][77]['TotalDeaths'];
$IDNewRecovered = $result['Countries'][77]['NewRecovered'];
$IDTotalRecovered = $result['Countries'][77]['TotalRecovered'];

//membuat format rupiah dengan PHP 
function koma($angka)
{
  $hasil_rupiah = number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}




//channelYT
$result = get_CURL("https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UClLjSj3HkStDhICC2lr6zYQ&key=AIzaSyADNGCfNMjOkTXLA-Lyg4MEYe-4p2ZxAzw");

$YoutubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$nameYT = $result['items'][0]['snippet']['title'];
$subscribeYT = $result['items'][0]['statistics']['subscriberCount'];

//latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyADNGCfNMjOkTXLA-Lyg4MEYe-4p2ZxAzw&channelId=UClLjSj3HkStDhICC2lr6zYQ&maxResults=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo);
$latestVideoID = $result['items'][0]['id']['videoId'];


//ambil data username foto dan followers
$result = get_CURL("https://www.instagram.com/nrarivin/?__a=1");
$usernameIG = $result['graphql']['user']['username'];
$profilePictureIG = $result['graphql']['user']['profile_pic_url_hd'];
$FollowersIG = $result['graphql']['user']['edge_followed_by']['count'];

//ambil weather
$result = get_CURL("http://api.openweathermap.org/data/2.5/weather?q=Jakarta,&appid=d34ad9ce313c055d5f779d02ecba9959&units=metric");
$Udara = $result['weather'][0]['main'];
$Icon = $result['weather'][0]['icon'];
$main = $result['weather'][0]['main'];
$desc = $result['weather'][0]['description'];
$Wspeed = $result['wind']['speed'];
$Wdeg = $result['main']['temp'];
$temperatur = $result['main']['temp_min'];
$temp_max = $result['main']['temp_max'];
$humidity = $result['main']['humidity'];

//ambil foto
$result = get_CURL("https://graph.instagram.com/me/media?fields=id,media_url,media_type&access_token=IGQVJWT2tWeHJISzhfbnRPeWNsTFU4OW1aVHRhZAjJxVFNBWFZAia2RmcC1QX3NpRDEyNS1NdGIyUk9mSlhFd2tEazdrTHduZAFdUY2p2Y3Y1eHotLTBlZAjFKeEVMZAzVNTmRYOVBUMGxmYnpsd1VJU3kzWQZDZD&fbclid=IwAR0xfT672qx4RdqeX7uTaBG6FmOrc7qqvdAEA6M3n3ackI-NWzfA9sqabNI");
$photos = [];
foreach ($result['data'] as $photo) {
  if ($photo['media_type'] == "IMAGE") {
    $photos[] = $photo['media_url'];
  } else if ($photo['media_type'] == 'CAROUSEL_ALBUM') {
    $photos[] = $photo['media_url'];
  }
  // $photos[] = $photo['media_url'];
  // $video[] = $photo['media_type'];

}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <!-- My CSS -->
  <link rel="stylesheet" href="css/stylee.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <title>My Portfolio</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#home">Nur Arifin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#corona">Data Corona</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#portfolio">Portfolio</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">
    <div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="<?= $profilePictureIG ?>" class="rounded-circle img-thumbnail">
          <h1 class="display-4">Nur Arifin</h1>
          <h3 class="lead">Mahasiswa | Programmer | Music</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Weather -->
  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">

    <h3 class="title text-center">Informasi Udara dan Cuaca</h3>
    <h5 class="title text-center">Jakarta</h5>
    <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
      <div class="single bordered" style="padding-bottom:25px;background:url('back.jpg') no-repeat ;border-top:0px;background-size: cover;">
        <div class="col-sm-9" style="font-size:20px;text-align:left;padding-left:70px;">
          <p style="margin-left:20px;" class="aqi-value"><?php echo $Wdeg; ?> °C</p>
          <p class="weather-icon">
            <img src='http://openweathermap.org/img/wn/<?= $Icon ?>@2x.png'>
            <b><?php echo $main; ?></b>
            <i style="float:bottom text-align:justify"> (<?= $desc ?>)</i>


          </p>
          <div class="weather-icon">
            <p><strong style="margin-left:20px;">Kecepatan angin : </strong><?php echo $Wspeed; ?> m/s</p>
            <p><strong style="margin-left:20px;">Temperature minimal : </strong><?php echo $temperatur; ?> Celsius </p>
            <p><strong style="margin-left:20px;">Temperature maksimal : </strong><?php echo $temp_max; ?> Celsius </p>
            <p><strong id="about" style="margin-left:20px;">Kelembapan : </strong><?php echo $humidity; ?> %</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- About -->
  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">
    <section class="about bg-light">
      <div class="container pt-3 pb-2">
        <div class="row ">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <h3>ME</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
          </div>
          <div class="col-md-5">
            <h3>Website</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Corona virus -->
  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" id="corona">
    <section class="corona">
      <div style="text-align: center">
        <h1>Corona Virus Update</h1>
      </div>
      <div class="row name1 mb-3">
        <div class="col-6 col-md-sm-xs">
          <h3>Global</h3>
          <div class="row justify-content-center">
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-primary">
                <div class="card-body">
                  <h5 class="card-title text-center">Baru di konfirmasi</h5>
                  <p class="card-text text-center">
                    <?= koma($newConfirmed) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-secondary">
                <div class="card-body">
                  <h5 class="card-title text-center">Total di konfirmasi</h5>
                  <p class="card-text text-center">
                    <?= koma($totalConfirmed) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-success">
                <div class="card-body">
                  <h5 class="card-title text-center">Baru Meninggal</h5>
                  <p class="card-text text-center">
                    <?= koma($NewDeaths) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-danger">
                <div class="card-body">
                  <h5 class="card-title">Total meninggal</h5>
                  <p class="card-text">
                    <?= koma($TotalDeaths) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-warning">
                <div class="card-body">
                  <h5 class="card-title">Baru di pulihkan</h5>
                  <p class="card-text">
                    <?= koma($NewRecovered) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="card text-white bg-info">
              <div class="card-body">
                <h5 class="card-title text-center">Total yang di pulihkan</h5>
                <p class="card-text text-center">
                  <?= koma($TotalRecovered) ?>
                  Orang
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-sm-xs">
          <h3>Indonesia</h3>
          <div class="row justify-content-center">
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-primary">
                <div class="card-body">
                  <h5 class="card-title text-center">Baru di konfirmasi</h5>
                  <p class="card-text text-center">
                    <?= koma($IDnewConfirmed) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-secondary">
                <div class="card-body">
                  <h5 class="card-title text-center">Total di konfirmasi</h5>
                  <p class="card-text text-center">
                    <?= koma($IDtotalConfirmed) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-success">
                <div class="card-body">
                  <h5 class="card-title text-center">Baru Meninggal</h5>
                  <p class="card-text text-center">
                    <?= koma($IDNewDeaths) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-danger">
                <div class="card-body">
                  <h5 class="card-title">Total meninggal</h5>
                  <p class="card-text">
                    <?= koma($IDTotalDeaths) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md-sm-xs mb-3">
              <div class="card text-white bg-warning">
                <div class="card-body">
                  <h5 class="card-title">Baru di pulihkan</h5>
                  <p class="card-text">
                    <?= koma($IDNewRecovered) ?>
                    Orang
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="card text-white bg-info">
              <div class="card-body">
                <h5 class="card-title text-center">Total yang di pulihkan</h5>
                <p class="card-text text-center">
                  <?= koma($IDTotalRecovered) ?>
                  Orang
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
  </div>


  <!-- Youtube & Instagram -->
  <section class="social bg-light" id="social">
    <div class="container">
      <div class="row pt-3 pb-3">
        <div class="col text-center">
          <h2>Social Media</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4 mb-3">
              <img src="<?php echo $YoutubeProfilePic ?>" width=" 550" class="rounded-circle img-thumbnail">
            </div>
            <div class="col mb-1">
              <h5><?= $nameYT; ?></h5>
              <p><?php echo $subscribeYT; ?> Subscriber </p>
              <div class="g-ytsubscribe" data-channelid="UClLjSj3HkStDhICC2lr6zYQ" data-layout="default" data-theme="dark" data-count="hidden">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $latestVideoID; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="row">
            <div class="col-md-4 mb-3">
              <img src="<?php echo $profilePictureIG ?>" width="550" class="rounded-circle img-thumbnail">
            </div>
            <div class="col-md-8">
              <h5><?= $usernameIG ?></h5>
              <p><?= $FollowersIG ?> Followers </p>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <?php foreach ($photos as $photo) : ?>
                <div class="ig-thumbnail mr-2 mb-1">
                  <img src="<?= $photo; ?>">
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio -->
  <div id="portfolio">
    <section class="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4 justify-content-center">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row justify-content-center center">
          <div class="col-md mb-4">
            <div class="card cardcss">
              <img class="card-img-top" src="img/thumbs/1.jpeg" alt="Card image cap" />
              <div class="card-body">
                <p class="card-text">
                  built game simple with unity,You can download it this game
                  <a href="https://drive.google.com/file/d/1C46vlMf0Xf9zoEZb8E48oXilYQfoZZ87/view?usp=sharing">https://drive.google.com/file/d/1C46vlMf0Xf9zoEZb8E48oXilYQfoZZ87/view?usp=sharing</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md mb-4">
            <div class="card cardcss">
              <img class="card-img-top" src="img/thumbs/2.jpg" alt="Card image cap" />
              <div class="card-body">
                <p class="card-text">
                  i was have huawei certification routing & network used software ENSP,<i>valid through Aug 29,2023</i>
                </p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card cardcss">
              <img class="card-img-top" src="img/thumbs/3.png" alt="Card image cap" />
              <div class="card-body">
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md mb-4">
            <div class="card cardcss">
              <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap" />
              <div class="card-body">
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md mb-4">
            <div class="card cardcss">
              <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap" />
              <div class="card-body">
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card cardcss">
              <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap" />
              <div class="card-body">
                <p class="card-text">
                  Some quick example text to build on the card title and make up
                  the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>


  <!-- Contact -->
  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">You can send messages to me via the content card that I created.</p>
              </div>
            </div>

            <ul class="list-group mb-4">
              <li class="list-group-item">
                <h3>Location</h3>
              </li>
              <li class="list-group-item">My Home</li>
              <li class="list-group-item">Jl. Gandaria II Jagakarsa No.8A, Jak-Sel </li>
              <li class="list-group-item">DKI Jakarta, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">

            <form method="POST" action="prosesTambah.php" enctype="multipart/form-data">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required="tidak boleh kosong">
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required="tidak boleh kosong" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" required="tidak boleh kosong" class="form-control">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="messagee" required="tidak boleh kosong" id="messagee" rows="3" maxlength="500" placeholder="Maksimal 500 karakter"></textarea>
              </div>
              <div class="form-group">
                <button type="Submit" name="Submit" name="tambah" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- footer -->
  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom">
    <footer class="bg-dark text-white mt-5 container-fluid">
      <div class="row">
        <div class="col text-center">
          <p>Copyright &copy; 2020.</p>
        </div>
      </div>
    </footer>
    <div>






      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <script src="https://apis.google.com/js/platform.js"></script>
      <script src="js/style.js"></script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
        AOS.init();
      </script>
</body>

</html>