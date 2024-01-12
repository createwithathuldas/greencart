<?php
ob_start();
session_start();
unset($_SESSION["aid"]);
include('./Assets/Connection/connection.php')
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>index</title>
    <?php include('./Assets/Template/MainTemplate/Home/headsec.php'); ?>
    <style>
        #cCarousel {
            position: relative;
            max-width: 900px;
            margin: auto;
        }

        #cCarousel .arrow {
            position: absolute;
            top: 50%;
            display: flex;
            width: 45px;
            height: 45px;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            z-index: 1;
            font-size: 26px;
            color: white;
            background: #00000072;
            cursor: pointer;
        }

        #cCarousel #prev {
            left: 0px;
        }

        #cCarousel #next {
            right: 0px;
        }

        #carousel-vp {
            width: 770px;
            height: 400px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin: auto;
        }

        @media (max-width: 770px) {
            #carousel-vp {
                width: 510px;
            }
        }

        @media (max-width: 510px) {
            #carousel-vp {
                width: 250px;
            }
        }

        #cCarousel #cCarousel-inner {
            display: flex;
            position: absolute;
            transition: 0.3s ease-in-out;
            gap: 10px;
            left: 0px;
        }

        .cCarousel-item {
            width: 250px;
            height: 365px;
            border: 2px solid white;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .cCarousel-item img {
            width: 100%;
            object-fit: cover;
            min-height: 246px;
            color: white;
        }

        .cCarousel-item .infos {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            background: white;
            color: black;
        }

        .cCarousel-item .infos button {
            background: #548302;
            padding: 10px 30px;
            border-radius: 15px;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>


<body>


    <?php include('./Assets/Template/MainTemplate/Home/navbar.php');
    ?>


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-uppercase  mb-lg-4" style="color:#fff;">GREENCART</h1>
                    <h1 class="text-uppercase text-white mb-lg-4">Greenery at Your Fingertips</h1>
                    <p class="fs-4 text-white mb-lg-4">Welcome to GREENCART, your number one source for all Plant types.
                        We're dedicated to providing you the very best of Plant categories.
                        We hope you enjoy our products as much as we enjoy offering them to you.
                    </p>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="./Guest/login.php" class="btn btn-outline-light border-2 py-md-3 px-md-5 me-5">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Testimonial Start -->
    <?php
    $selQuery = "select * from tbl_plant group by plant_name";
    $result = $conn->query($selQuery);
    if ($result->num_rows>=3) {
        ?>
        <section style="
  background: url('./Assets/Img/background-tropical-plants-with-leaves-word-jungle-it.jpg')">
            <div id="cCarousel">
                <div class="arrow" id="prev">
                    < </div>
                        <div class="arrow" id="next"> > </div>
                        <div id="carousel-vp">
                            <div id="cCarousel-inner">
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <article class="cCarousel-item">
                                        <img src="./Assets/Files/Plant/<?php echo $row['plant_photo'] ?>"
                                            alt="Moon">
                                        <div class="infos">
                                            <h5><?php echo $row['plant_name'] ?></h5>
                                            <button style="border: none;"  type="button" onclick="window.location='./Guest/login.php'">See</button>
                                        </div>
                                    </article>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                </div>
        </section>
        <?php
    }
    ?>

    <?php
    $selQuery = "select * from tbl_order o inner join tbl_cart cr
    on o.cart_id = cr.cart_id inner join tbl_plant p on p.plant_id =cr.plant_id
    inner join tbl_shop s on p.shop_id = s.shop_id  group by s.shop_name order by count(s.shop_name) desc limit 5";
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        ?>
        <!-- Testimonial Start -->
        <div class="container-fluid bg-testimonial py-5" style="margin: 45px 0;">
            <div class="container py-5">
                <div class="row justify-content-end">
                    <!-- <div class="col-lg-6"> -->
                    <div style="text-align: center; color: #548302; background-color: #fff; padding-top: 1em;padding-bottom: 1em;margin-bottom: -1em;"
                        class="h2">
                        TOP SHOPS
                    </div>
                    <div class="owl-carousel testimonial-carousel bg-white p-5">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="testimonial-item text-center" style="margin-bottom:  3.1em;">
                                <div class="position-relative mb-4">
                                    <img class="img-fluid mx-auto"
                                        src="./Assets/Files/Shop/Photo/<?php echo $row['shop_photo'] ?>" alt="">
                                </div>
                                <hr class="w-25 mx-auto">
                                <h5 class="text-uppercase">
                                    <?php echo $row['shop_name'] ?>
                                </h5>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- </div> -->

                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        <?php
    }
    ?>


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded"
                            src="./Assets/Template/MainTemplate/img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="border-start border-5 ps-5 mb-5">
                        <h6 class="text-uppercase" style="color: #548302;">About Us</h6>
                        <h1 class="display-5 text-uppercase mb-0">Get gardening for your health and wellbeing</h1>
                    </div>
                    <h4 class="text-body mb-4">Greencart germinated in 2023 from a promise to make ‘green and healthy’ a
                        click away for all</h4>
                    <div class="bg-light p-4">
                        <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item w-50" role="presentation" style="background: #548302; color:white;">
                                <button class="nav-link text-uppercase w-100 active" id="pills-1-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab"
                                    aria-controls="pills-1" aria-selected="true">Our Mission</button>
                            </li>
                            <li class="nav-item w-50" role="presentation" style="background: #548302; color:white;">
                                <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                    aria-selected="false">Our Vission</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                                aria-labelledby="pills-1-tab">
                                <p class="mb-0">We cater to all kinds of gardening needs ranging from plants to curated
                                    plant-scaping solutions.
                                    Our ever-growing platform integrates nurseries and customers across Kerala.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                <p class="mb-0">
                                    We believe that Green is Good and are here to enable people to access plants in the
                                    easiest way possible – online!
                                    We are here to shape the future of gardening!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->





    <!-- Testimonial Start -->
    <?php
    $selQuery = "select * from tbl_feedback f inner join tbl_user u on f.user_id = u.user_id where f.feedback_status = 1";
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        ?>
        <div class="container-fluid bg-testimonial py-5" style="margin: 45px 0;">
            <div class="container py-5">
                <div class="row justify-content-end">
                    <!-- <div class="col-lg-7"> -->
                    <div class="owl-carousel testimonial-carousel bg-white p-5">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="testimonial-item text-center">
                                <div class="position-relative mb-4">
                                    <img class="img-fluid mx-auto" src="./Assets/Template/MainTemplate/img/user.png" alt="">
                                    <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white"
                                        style="width: 45px; height: 45px;">
                                        <i class="bi bi-chat-square-quote text-primary"></i>
                                    </div>
                                </div>
                                <p>
                                    <?php echo $row['feedback_content'] ?>
                                </p>
                                <hr class="w-25 mx-auto">
                                <h5 class="text-uppercase">
                                    <?php echo $row['user_name'] ?>
                                </h5>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <!-- Testimonial End -->



    <?php include('./Assets/Template/MainTemplate/Home/footer.php'); ?>



    <?php include('./Assets/Template/MainTemplate/Home/jslibrary.php'); ?>


    <script>
        const prev = document.querySelector("#prev");
        const next = document.querySelector("#next");

        let carouselVp = document.querySelector("#carousel-vp");

        let cCarouselInner = document.querySelector("#cCarousel-inner");
        let carouselInnerWidth = cCarouselInner.getBoundingClientRect().width;

        let leftValue = 0;

        // Variable used to set the carousel movement value (card's width + gap)
        const totalMovementSize =
            parseFloat(
                document.querySelector(".cCarousel-item").getBoundingClientRect().width,
                10
            ) +
            parseFloat(
                window.getComputedStyle(cCarouselInner).getPropertyValue("gap"),
                10
            );

        prev.addEventListener("click", () => {
            if (!leftValue == 0) {
                leftValue -= -totalMovementSize;
                cCarouselInner.style.left = leftValue + "px";
            }
        });

        next.addEventListener("click", () => {
            const carouselVpWidth = carouselVp.getBoundingClientRect().width;
            if (carouselInnerWidth - Math.abs(leftValue) > carouselVpWidth) {
                leftValue -= totalMovementSize;
                cCarouselInner.style.left = leftValue + "px";
            }
        });

        const mediaQuery510 = window.matchMedia("(max-width: 510px)");
        const mediaQuery770 = window.matchMedia("(max-width: 770px)");

        mediaQuery510.addEventListener("change", mediaManagement);
        mediaQuery770.addEventListener("change", mediaManagement);

        let oldViewportWidth = window.innerWidth;

        function mediaManagement() {
            const newViewportWidth = window.innerWidth;

            if (leftValue <= -totalMovementSize && oldViewportWidth < newViewportWidth) {
                leftValue += totalMovementSize;
                cCarouselInner.style.left = leftValue + "px";
                oldViewportWidth = newViewportWidth;
            } else if (
                leftValue <= -totalMovementSize &&
                oldViewportWidth > newViewportWidth
            ) {
                leftValue -= totalMovementSize;
                cCarouselInner.style.left = leftValue + "px";
                oldViewportWidth = newViewportWidth;
            }
        }

    </script>

</body>

</html>

<?php
ob_flush();
?>