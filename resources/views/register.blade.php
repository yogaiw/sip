<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | Sirepaspro</title>

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>

    <style>
        .divider:after, .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                    <a
                        class="nav-link active"
                        id="ex1-tab-1"
                        data-mdb-toggle="tab"
                        href="#ex1-tabs-1"
                        role="tab"
                        aria-controls="ex1-tabs-1"
                        aria-selected="true">MAHASISWA</a>
                    </li>
                    <li class="nav-item" role="presentation">
                    <a class="nav-link"
                        id="ex1-tab-3"
                        data-mdb-toggle="tab"
                        href="#ex1-tabs-3"
                        role="tab"
                        aria-controls="ex1-tabs-3"
                        aria-selected="false">DOSEN</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex1-content">
                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <h3 class="mb-3">Daftar Sebagai Mahasiswa</h3>
                        <form action="{{ route('register.student') }}" method="POST">
                            @csrf
                            <small class="mb-3">username dan password akan digunakan untuk login nanti</small>
                            <div class="form-outline mb-2">
                                <input type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Username" name="username" required/>
                                <label class="form-label" for="form3Example3">Username</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input type="password" id="form3Example3" class="form-control form-control-lg" placeholder="Password" name="password" required/>
                                <label class="form-label" for="form3Example3">Password</label>
                            </div>
                            <hr>
                            <small class="mb-3">Informasi Pribadi</small>
                            <div class="form-outline mb-2">
                                <input type="number" id="form3Example3" class="form-control form-control-lg" placeholder="NIM" name="nim" required/>
                                <label class="form-label" for="form3Example3">NIM</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Nama lengkap" name="name" required/>
                                <label class="form-label" for="form3Example3">Nama Lengkap</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Email" name="email" required/>
                                <label class="form-label" for="form3Example3">Email</label>
                            </div>
                            <div class="form-outline mb-2">
                                <select name="pembimbing1" class="browser-default custom-select">
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->lecturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-2">
                                <select name="pembimbing2" class="browser-default custom-select">
                                    <option value="">kosongi jika tidak ada</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->lecturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-2">
                                <select name="penguji" class="browser-default custom-select">
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->lecturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                        <h3 class="mb-3">Daftar Sebagai Dosen</h3>
                        <form action="" method="POST">
                            @csrf
                            <small class="mb-3">username dan password akan digunakan untuk login nanti</small>
                            <div class="form-outline mb-2">
                                <input type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Username" name="username" required/>
                                <label class="form-label" for="form3Example3">Username</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input type="password" id="form3Example3" class="form-control form-control-lg" placeholder="Password" name="password" required/>
                                <label class="form-label" for="form3Example3">Password</label>
                            </div>
                            <div class="form-outline mb-2">
                                <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Email" name="email" required/>
                                <label class="form-label" for="form3Example3">Email</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>
                    </div>
                </div>
                <!-- Tabs content -->
            </div>
          </div>
        </div>
        <div
          class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
          <!-- Copyright -->
          <div class="text-white mb-3 mb-md-0">
            Copyright © 2022. All rights reserved.
          </div>
          <!-- Copyright -->

          <!-- Right -->
          {{-- <div>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div> --}}
          <!-- Right -->
        </div>
      </section>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>
</html>
