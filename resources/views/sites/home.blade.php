<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Viga">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('sites/css/bootstrap.css')}}">

    <!-- fonts awesome -->
    <link rel="stylesheet" href="{{ asset('sites/vendor/fontawesome-free/css/all.min.css') }}">

    <!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('sites/css/style.css')}}">

    <title>SMK DEPOK</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('sites/img/logo.png') }}" width="50"> SMK MADANI DEPOK</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#">Login</a>
                <a class="nav-item nav-link" href="#">Biaya Daftar</a>
                <a class="nav-item nav-link" href="#">Login Calon Siswa</a>
                <a href="#" class="btn btn-primary tombol">Daftar</a>
            </div>
            </div>
        </div>
    </nav>
	<!-- Close Navbar -->
    
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Selamat Datang di website <br> SMK MADANI DEPOK</h1>
        </div>
    </div>
    <!-- Close Jumbotron -->

    <!-- container -->
		
    <div class="container">
        <!-- Info Panel -->

        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <img class="float-left" src="{{ asset('sites/img/tkj.png') }}" alt="tkj">
                        <h4>TKJ</h4> 
                        <p>Teknik Komputer Jaringan</p>
                    </div>
                    <div class="col-lg">
                        <img class="float-left" src="{{ asset('sites/img/tkr.png') }}" alt="tkr">
                        <h4>TKR</h4>
                        <p>Teknik Kendaraan Ringan</p>
                    </div>
                    <div class="col-lg">
                        <img class="float-left" src="{{ asset('sites/img/tpr.png') }}" alt="tpr">
                        <h4>TPR</h4>
                        <p>Teknik Pendingin Ruangan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Close Info Panel -->
        
        <!-- Working Space -->
        
        <div class="row workingspace">
            <div class="col-lg-6">
                <img src="{{ asset('sites/img/w.png') }}" alt="workingspace" class="img-fluid">
            </div>
            <div class="col-lg-5">
                <h3>Tempat yang Strategis</h3>
                <p>Sekolah dengan suasana yang lebih asik dan mempelajari hal baru setiap harinya</p>
                <a href="" class="btn btn-primary tombol">Daftar</a>
            </div>
        </div>

        <!-- Akhir Working Space -->

        <!-- Testomonials -->
        
        <section class="testimonial">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h5>"Ayo Bergabung Dengan Kami"</h5>
                </div>
                </div> 
        

            <div class="row justify-content-center">
                <div class="col-lg-6 d-flex justify-content-center">

                    <figure class="figure">
                        <i class="fab fa-facebook-square fa-fw"></i>
                    </figure>

                    <figure class="figure">
                        <i class="fab fa-instagram fa-fw"></i>
                    </figure>

                    <figure class="figure">
                        <i class="fas fa-envelope fa-fw"></i>
                    </figure>

                </div>
            </div>

        </section>
        <!-- Close Testimonials -->

        <!-- Footer -->

        <div class="row footer">
            <div class="col text-center">
                <p>2020 All Rights Reserved by AAP</p>
            </div>
        </div>
        <!-- Close Footer -->

    </div>
    <!-- Close Container -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sites/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sites/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sites/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sites/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('sites/js/script.js') }}"></script>
    <script src="{{ asset('sites/js/tes.js') }}"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>
</html>