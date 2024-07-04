<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3" style="background: #fff;">
            <nav class="navbar">
                <a href="../index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="" style="color: #548302;">GREENCART</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../Assets//Files//User//<?php echo $data['user_photo'] ?>"
                            alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0" style="color: #548302;">
                            <?php echo $data['user_name']; ?>
                        </h6>
                        <span>User</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="./UserHomePage.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i> Dashboard </a>
                    <a href="./UserOrders.php" class="nav-item nav-link active"><i class="fa fa-book me-2"></i> My
                        Orders</a>
                    <a href="./UserCart.php" class="nav-item nav-link active"><i class="fa fa-shopping-bag me-2"></i> My
                        Cart</a>
                    <a href="./UserChangeProfile.php" class="nav-item nav-link active"><i
                            class="fa fa fa-cogs me-2"></i> Profile Settings</a>
                    <a href="./UserComplaint.php" class="nav-item nav-link active">
                        <i class="fa fa-comment me-2" aria-hidden="true"></i>
                        Complaint</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->