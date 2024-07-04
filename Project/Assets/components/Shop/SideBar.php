 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3" style="background: #fff;">
      <nav class="navbar">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
          <h3 class="" style="color: #548302;">GREENCART</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
          <div class="position-relative">
            <img class="rounded-circle" src="../Assets//Files//Shop//Photo/<?php echo $data['shop_photo'] ?>" alt=""
              style="width: 40px; height: 40px;">
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
            </div>
          </div>
          <div class="ms-3">
            <h6 class="mb-0" style="color: #548302;">
              <?php echo $data['shop_name']; ?>
            </h6>
            <span>Seller</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a href="./ShopHomePage.php" class="nav-item nav-link active"><i
              class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          <a href="./ShopPlants.php" class="nav-item nav-link"><i class="fa fa-leaf me-2"></i>Plants</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                class="fa fa-book me-2"></i>Orders</a>
            <div class="dropdown-menu bg-transparent border-0" style="padding-left:10%;">
              <a href="./ShopNewOrder.php" class="dropdown-item"><i class="fa fa-arrow-circle-right"
                  aria-hidden="true"></i> New Orders</a>
              <a href="./ShopConfirmOrder.php" class="dropdown-item"><i class="fa fa-arrow-circle-right"
                  aria-hidden="true"></i> Confirm Orders</a>
              <a href="./ShopDeliveredOrder.php" class="dropdown-item"><i class="fa fa-arrow-circle-right"
                  aria-hidden="true"></i> Delivered Orders</a>
              <a href="./ShopCanceledOrder.php" class="dropdown-item"><i class="fa fa-arrow-circle-right"
                  aria-hidden="true"></i> Canceled Orders</a>
            </div>
          </div>
          <a href="./ShopUserComplaints.php" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>User Complaints</a>
          <a href="./ShopProfile.php" class="nav-item nav-link"><i class="fa fa-male me-2"></i>Profile</a>
        </div>
      </nav>
    </div>
    <!-- Sidebar End -->