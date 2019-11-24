@extends('layout')

@section('content')
  <div class="container">
    <div class="row mb-5">
        <div class="col col-md-7">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('img/dummy.png') }}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img/dummy2.png') }}" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img/dummy3.png') }}" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="col col-md-5">
          <!-- Maks 3 Konten -->
          <div class="col col-12 border-bottom pt-2 pb-0">
            <h5 class="mb-0"><a href="#">Judul Konten</a></h5>
            <small>15 Desember 2019</small>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
          <div class="col col-12 border-bottom pt-2 pb-0">
            <h5 class="mb-0"><a href="#">Judul Konten</a></h5>
            <small>15 Desember 2019</small>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
          <div class="col col-12 border-bottom pt-2 pb-0">
            <h5 class="mb-0"><a href="#">Judul Konten</a></h5>
            <small>15 Desember 2019</small>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
    </div>
    <div class="row mb-5">
      <div class="col col-8">
        <h2>Tebakan Terakhir</h2>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Peserta</th>
              <th scope="col">Liga</th>
              <th scope="col">Tebakan</th>
              <th scope="col">Waktu</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Tottemham vs Uniland</td>
              <td>3 : 1</td>
              <td>15 Dec 2019 15.20</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Mark</td>
              <td>Tottemham vs Uniland</td>
              <td>3 : 1</td>
              <td>15 Dec 2019 15.20</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Mark</td>
              <td>Tottemham vs Uniland</td>
              <td>3 : 1</td>
              <td>15 Dec 2019 15.20</td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="col col-4 bg-primary">
        Iklan
      </div>
    </div>
  </div>

@endsection
