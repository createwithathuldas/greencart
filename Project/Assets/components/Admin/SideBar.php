<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3" style="background: #fff;">
            <nav class="navbar">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="" style="color: #548302;">GREENCART</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../Assets//Template//AdminTemplate//darkpan-1.0.0//img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0" style="color: #548302;">
                            <?php echo $data['admin_name']; ?>
                        </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="./AdminHomePage.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-location-arrow me-2"></i>Location</a>
                        <div class="dropdown-menu bg-transparent border-0" style="padding-left:10%;">
                            <a href="./AdminDistrict.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> District</a>
                            <a href="./AdminCity.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> City</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Basic Data</a>
                        <div class="dropdown-menu bg-transparent border-0" style="padding-left:10%;">
                            <a href="./AdminPlantCategory.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Plant Category</a>
                            <a href="./AdminComplaintType.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Complaint Type</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa fa-cogs me-2"></i>Profile Settings</a>
                        <div class="dropdown-menu bg-transparent border-0" style="padding-left:10%;">
                            <a href="./AdminChangeName.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Change Name</a>
                            <a href="./AdminChangeEmail.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Change Email</a>
                            <a href="./AdminChangePassword.php" class="dropdown-item"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Change Password</a>
                        </div>
                    </div>
                    <a href="" class="nav-item nav-link">

                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->