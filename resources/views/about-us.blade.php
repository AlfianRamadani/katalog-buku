@extends('layout.app')

@section('content')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streamlined Custody Solution</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Hero Section -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h1 class="display-5 fw-bold">Our streamlined custody solution enables organizations to level up their digital asset management.</h1>
            <p class="lead mt-4">Effortlessly manage your assets with cutting-edge solutions tailored to your needs.</p>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Meet Our Team</h2>
            <div class="row text-center">
                <!-- Team Member 1 -->
                <div class="col-md-4">
                    <div class="card shadow-sm team-card">
                        <img src= {{asset('profile/alfian.jpg')}} class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 1" style="width: 18 0px; height: 180px; border: 4px solid white;">
                        <div class="card-body">
                            <h5 class="card-title">Alfian Ramadhani</h5>
                            <p class="card-text"></p>
                            <div class="social-icons mt-3">
                                <a href="https://instagram.com/alboyonnn" target="_blank" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="col-md-4">
                    <div class="card shadow-sm team-card">
                        <img src={{asset('profile/ayudya.jpg')}} class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 2" style="width: 180px; height: 180px; border: 4px solid white;">
                        <div class="card-body">
                            <h5 class="card-title">Ayudya Aisyah Mutiaradinna</h5>
                            <p class="card-text"></p>
                            <div class="social-icons mt-3">
                                <a href="https://instagram.com/asterlaverne" target="_blank" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="col-md-4">
                    <div class="card shadow-sm team-card">
                        <img src={{asset('profile/Taufiq.jpg')}} class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 3" style="width: 180px; height: 180px; border: 4px solid white;">
                        <div class="card-body">
                            <h5 class="card-title">Taufik Erik Herliansyah</h5>
                            <p class="card-text"></p>
                            <div class="social-icons mt-3">
                                <a href="https://instagram.com/erikterl" target="_blank" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                              
                            </div>
                        </div>
                    </div>
                </div>
                <!--team member 4-->
                                <div class="col-md-4">
                    <div class="card shadow-sm team-card">
                        <img src={{asset('profile/meka.jpg')}} class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 3" style="width: 180px; height: 180px; border: 4px solid white;">
                        <div class="card-body">
                            <h5 class="card-title">Syera Salsabilla Mecha</h5>
                            <p class="card-text"></p>
                            <div class="social-icons mt-3">
                                <a href="https://instagram.com/syeraslsblla" target="_blank" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--team member 5-->
                <div class="col-md-4">
                    <div class="card shadow-sm team-card">
                        <img src={{asset('profile/naufal.jpg')}} class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 3" style="width: 180px; height: 180px; border: 4px solid white;">
                        <div class="card-body">
                            <h5 class="card-title">Naufal Zaki Ramadhan</h5>
                            <p class="card-text"></p>
                            <div class="social-icons mt-3">
                                <a href="https://instagram.com/naufalrmdhan._" target="_blank" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                              
                            </div>
                        </div>
                    </div>
                </div>
                <!--team member 6-->
                <div class="col-md-4">
                    <div class="card shadow-sm team-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3yLsgONMss-PI416BmKdxUc4rd6Dtv-9WUA&s" class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 3" style="width: 180px; height: 180px; border: 4px solid white;">
                        <div class="card-body">
                            <h5 class="card-title">Maelinda Sa Firaaidah</h5>
                            <p class="card-text"></p>
                            <div class="social-icons mt-3">
                                <a href="https://instagram.com/maexisnt" target="_blank" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .team-card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .team-card img {
            transition: transform 0.3s ease;
        }

        .team-card:hover img {
            transform: scale(1.1);
        }

        .social-icons a:hover {
            color: #007bff;
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection