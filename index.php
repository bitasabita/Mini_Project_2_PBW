<?php
include 'koneksi.php';

$profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile LIMIT 1"));
$gallery = mysqli_query($conn, "SELECT * FROM gallery");
$education = mysqli_query($conn, "SELECT * FROM education");
$experience = mysqli_query($conn, "SELECT * FROM experience");
$skills = mysqli_query($conn, "SELECT * FROM skills");
$certificates = mysqli_query($conn, "SELECT * FROM certificates");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $profile['nama']; ?> Portfolio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo $profile['nama']; ?></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="home" class="home-section">
    <div class="container text-center">
        <p class="subtitle"><?php echo $profile['subtitle']; ?></p>
        <h1 class="title"><?php echo $profile['nama']; ?></h1>

        <div class="gallery">
            <?php while($img = mysqli_fetch_assoc($gallery)) { ?>
                <div class="frame">
                    <img src="<?php echo $img['image_path']; ?>" alt="Gallery">
                </div>
            <?php } ?>
        </div>

        <p class="home-text">
            <?php echo $profile['home_text']; ?>
        </p>

        <div class="home-footer">
            <span>PRESENTED BY : <?php echo $profile['nama']; ?></span>
            <span>EMAIL : <?php echo $profile['email']; ?></span>
        </div>
    </div>
</section>

<section id="about" class="about-wrapper">
    <div class="about-left">
        <div class="photo-box">
            <img src="<?php echo $profile['foto_about']; ?>" alt="Foto Profil">
        </div>
    </div>

    <div class="about-right">
        <h2 class="section-title">Get to Know Me</h2>

        <p class="about-desc">
            <?php echo $profile['about_text']; ?>
        </p>

        <div class="timeline-wrapper">
            <div class="timeline">
                <h6 class="mini-title">Education</h6>
                <?php while($edu = mysqli_fetch_assoc($education)) { ?>
                    <div class="timeline-item">
                        <h6><?php echo $edu['institusi']; ?></h6>
                        <p>
                            <?php echo $edu['jurusan']; ?>
                            <?php if (!empty($edu['tahun'])) { ?>
                                (<?php echo $edu['tahun']; ?>)
                            <?php } ?>
                        </p>
                    </div>
                <?php } ?>
            </div>

            <div class="timeline">
                <h6 class="mini-title">Experience</h6>
                <?php while($exp = mysqli_fetch_assoc($experience)) { ?>
                    <div class="timeline-item">
                        <h6><?php echo $exp['posisi']; ?></h6>
                        <p><?php echo $exp['deskripsi']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <h4 class="mt-4 mb-4 skills-title">✨ Skills</h4>
        <?php while($skill = mysqli_fetch_assoc($skills)) { ?>
            <div class="skill-item">
                <div class="skill-header">
                    <span><?php echo $skill['nama_skill']; ?></span>
                    <span><?php echo $skill['persentase']; ?>%</span>
                </div>
                <div class="skill-bar">
                    <div class="skill-fill" style="width: <?php echo $skill['persentase']; ?>%;"></div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<section id="certificates" class="cert-section">
    <div class="cert-top">
        <h2 class="section-title light">Certificates</h2>
    </div>

    <div class="container cert-container">
        <div class="row">
            <?php while($cert = mysqli_fetch_assoc($certificates)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card cert-card">
                        <img src="<?php echo $cert['image_path']; ?>" class="card-img-top" alt="Certificate">
                        <div class="card-body text-center">
                            <h5><?php echo $cert['title']; ?></h5>
                            <p><?php echo $cert['deskripsi']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<footer class="footer">
    <?php echo $profile['footer_text']; ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>