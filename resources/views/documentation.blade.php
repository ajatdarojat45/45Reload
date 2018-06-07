<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="Welcome to the official documentation site for Sad Runner.">
   <meta name="keywords" content="Sad Runner Documentation">

   <title>uangKita - Documentation</title>

   {{-- bootstrap --}}
   <link href="{{asset('bootstrap-3/css/bootstrap.min.css')}}" rel="stylesheet">
   {{-- font awsome  --}}
   <link href="{{ asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
   <!-- Styles -->
   <link href="{{asset('documentation-master/assets/css/theDocs.all.min.css')}} " rel="stylesheet">
   <link href="{{asset('documentation-master/assets/css/skin-sad-runner.css')}} " rel="stylesheet">
   <link href="{{asset('documentation-master/assets/css/custom.css')}}" rel="stylesheet">

   <!-- Fonts -->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

   <!-- Favicons -->
   <link rel="apple-touch-icon" href="/apple-touch-icon.png">
   <link rel="icon" href="{{asset('documentation-master/')}}assets/img/favicon.ico">
</head>

<body data-spy="scroll" data-target=".sidebar" data-offset="200">

   <header class="site-header navbar-fullwidth navbar-transparent">

      <!-- Top navbar & branding -->
      <nav class="navbar navbar-default">
         <div class="container">

            <!-- Toggle buttons and brand -->
            <div class="navbar-header">


               <button type="button" class="navbar-toggle for-sidebar" data-toggle="offcanvas">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>


            </div>
            <!-- END Toggle buttons and brand -->

            <!-- Top navbar -->
            <div id="navbar" class="navbar-collapse collapse" aria-expanded="true" role="banner">
               <ul class="nav navbar-nav navbar-right">

               </ul>
            </div>
            <!-- END Top navbar -->

         </div>
      </nav>
      <!-- END Top navbar & branding -->

      <!-- Banner -->
      <!-- <div class="banner banner-lg overlay-black" style="background-image: url(assets/img/sad-runner-hero.jpg);">
        <div class="container text-left">
          <br>
          <br>
          <br>
          <img src="assets/img/sad-runner-logo.png">
          <h1><strong>Official Documentation</strong></h1>
        </div>
      </div> -->
      <!-- END Banner -->

   </header>
   <main class="container">
      <br>
         <div class="row">
            <div class="text-center main-content" style="color:#636b6f;">
              <a href="{{route('login')}}" target="_blank" style="color:#636b6f;">/Home</a>
              <strong>/Documentation</strong>
           </div>
         </div>
      <div class="row">
         <!-- Sidebar -->
         <aside class="col-sm-3 sidebar">

            <ul class="nav sidenav dropable sticky">

               <li>
                  <a href="#exo">Perkenalan</a>
                  <ul>
                     <li><a href="#mtp">Report by Category</a></li>
                     <li><a href="#objectives">Report by Date</a></li>
                     <li><a href="#open-source">Report by Month</a></li>
                     <li><a href="#report-by-year">Report by Year</a></li>
                  </ul>
               </li>

               <li>
                  <a href="#hq">Cara Penggunaan</a>
               </li>

               <li>
                  <a href="#contribute">Demo</a>
               </li>
            </ul>

         </aside>
         <!-- END Sidebar -->


         <!-- Main content -->
         <article class="col-sm-9 main-content" role="main">

            <p class="lead"><strong>Hadiah #1 uangKita</strong></p>

            <p class="lead">
               Hai, apa kabar, semoga sehat-sehat semuanya. Dan selamat menunaikan ibadah puasa bagi yang menjalankan. Semoga puasa kali ini bisa ngubah kita sama-sama jadi lebih baik.
            </p>

            <p class="lead">
               Saya mau kasih hadiah buat teman-teman. Hadiah apa? Yuk kita baca sama-sama dokumentasinya.
            </p>

            <p class="lead"><strong>Ajat Darojat - Founder</strong></p>

            <section>
               <h2 id="exo">Perkenalan</h2>
               <p>
                  Hadiah ini saya kasih nama uangKita. uangKita ini sejenis aplikasi yang bisa teman-teman gunakan. Baik secara pribadi ataupun organisasi.
               </p>

               <p>
                  uangKita ini aplikasi pengelolaan keuangan berbasis web yang didesain secara sederhana. Serta menyediakan berbagai jenis report.
               </p>

               <p>
                  Teman-teman bisa menambahkan beberapa dompet dalam aplikasi ini, serta mengatur pengeluaran dan pemasukan berdasarkan kategori dari setiap dompetnya dan bisa di tambahkan keterangan disetiap transaksinya sehingga transaksinya jelas.
               </p>

               <p>
                  Dalam pencarian data juga sangat mudah teman-teman tinggal menentukan tanggalnya dan aplikasi akan menampilkan data berdasarkan tanggal yang teman-teman tentukan. Dan hasil pencariannya bisa teman-teman export ke dalam bentuk pdf dan excel.
               </p>

               <p>
                  Ada beberapa report yang disediakan uangKita, diantaranya :
               </p>

               <h3 id="mtp"><strong>Report by Category</strong></h3>
               <img src="{{asset('documentation-master/assets/images/reportByCategory.jpeg')}} " class="image-center" alt="Sad Runner MTP Diagram">
               <p>
                  Report ini disajikan dalam bentuk Pie diagram untuk mengetahui presentase transaksi kita berdasarkan kategori baik itu pengeluaran ataupun pemasukan di setiap dompet/wallet nay berdasarkan tanggal yang kita tentukan.
               </p>

               <h3 id="objectives"><strong>Report by Date</strong></h3>
               <img src="{{asset('documentation-master/assets/images/reportByDate.jpeg')}} " class="image-center" alt="Sad Runner MTP Diagram">
               <p>
                  Report ini disajikan dalam bentuk bar diagram untuk mengetahui pengeluran, pemasukan dan saldo dalam harian.
               </p>

               <h3 id="open-source"><strong>Report by Month</strong></h3>
               <img src="{{asset('documentation-master/assets/images/reportByMonth.jpeg')}}" class="image-center" alt="Sad Runner MTP Diagram">
               <p>
                  Report ini disajikan dalam bentuk bar diagram untuk mengetahui pengeluran, pemasukan dan saldo kita dalam bulanan.
               </p>

               <h3 id="report-by-year"><strong>Report by Year</strong></h3>
               <img src="{{asset('documentation-master/assets/images/reportByYear.jpeg')}} " class="image-center" alt="Sad Runner MTP Diagram">
               <p>
                  Report ini disajikan dalam bentuk bar diagram untuk mengetahui pengeluran, pemasukan dan saldo kita dalam tahunan.
               </p>
            </section>

            <section>
               <h2 id="hq">Cara Penggunaan</h2>

               <p>
                  Untuk menggunakan aplikasi uangKita silahkan teman-teman mendaftar terlebih dahulu <a href="http://uangkita.ajatdarojat45.id/register" target="_blank">disini</a>
               </p>

               <p>
                  Seletah mendaftar teman-teman sudah bisa input data dengan cara import. Cukup sediakan format file excel (.xls/.xlsx) sebagai berikut:
               </p>
               <img src="{{asset('documentation-master/assets/images/excelFormat.jpeg')}} " class="image-center" alt="Sad Runner MTP Diagram">
               <p>
                  a. Kolom account merupakan kolom dompet/wallet <br> b. Kolom category merupakan kolom kategori dari setiap transaksi <br> c. Kolom amount merupakan nominal dari setiap transaksi. Jika amount/nominal nya minus (-) makan akan dianggap
                  debit sebaliknya akan dianggap kredit.<br> d. Kolom date merupakan tanggal dari setiap transaksi.
               </p>
               <p>
                  Setelah file excel yang berisi data transaksi telah siap silahkan impor ke program melalui menu import.
               </p>
               <img src="{{asset('documentation-master/assets/images/index.jpeg')}} " class="image-center" alt="Sad Runner MTP Diagram">
               <p>
                  Setelah data ter-import teman-teman bisa dengan mudah melakukan pencarian transaksi dan membuat report baik itu by kategori, harian, bulanan ataupun tahunan.
               </p>
               <p>
                  Untuk lebih jelasnya uangKita sudah menyiapkan data dummy dan akun demo silahkan teman-teman mencobanya.
               </p>
            </section>


            <section>
               <h2 id="contribute">Demo</h2>
               <p>
                  Untuk teman-teman yang mau lihat demonya silahkan klik <a href="http://uangkita.ajatdarojat45.id" target="_blank">disini</a>
               </p>
               <p>
                  Email : demo@ajatdrojat45.id <br> Password : ajatdarojat45.id

               </p>
            </section>


         </article>
         <!-- END Main content -->
      </div>
   </main>


   <!-- Footer -->
   <!-- <footer class="site-footer">
          <div class="container">
            <a id="scroll-up" href="#"><i class="fa fa-angle-up"></i></a>

            <div class="row">
              <div class="col-md-6 col-sm-6 copyright">
                <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Sad Runner. All rights reserved.</p>
              </div>
              <div class="col-md-6 col-sm-6 contact">
              Visit <a href="http://sadrunner.com">SadRunner.com</a>
              </div>
            </div>
          </div>
        </footer> -->
   <!-- END Footer -->
   <div class="text-center" style="color:#636b6f;">

      <b><a href="https://ajatdarojat45.id" target="_blank" style="color:#636b6f;">lazyCode</a> - <i class="fa fa-code"></i> dengan <i class="fa fa-heart" style="color:red"></i> </b>
   </div><br>

   <!-- Scripts -->
   <script src="{{asset('documentation-master/assets/js/theDocs.all.min.js')}}"></script>
   <script src="{{asset('documentation-master/assets/js/custom.js')}}"></script>

</body>
</html>
