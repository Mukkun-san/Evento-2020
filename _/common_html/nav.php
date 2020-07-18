<style>
.menu-logo .navbar-brand {
    margin-left: 1rem!important;
}
.navbar-toggleable-sm .navbar-collapse {
    padding-right: 1rem!important;
}
</style>
<section class="menu cid-rWwszXRaZk " once="menu" id="menu1-47">
      <nav
        class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm"
      >
        <button
          class="navbar-toggler navbar-toggler-right"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </button>
        <div class="menu-logo">
          <div class="navbar-brand">
            <span class="navbar-logo">
              <a href="index.php">
                <img
                  src="assets/images/93670627-571269746842714-5752841786544357376-n-195x129.png"
                  alt="EVENTO"
                  title="EVENTO"
                  style="height: 4.3rem;"
                />
              </a>
            </span>
            <span class="navbar-caption-wrap"
              ><a class="navbar-caption text-white display-5" href="index.php"
                >&nbsp;E V E N T O</a
              ></span
            >
          </div>
        </div> 
        <div class="collapse navbar-collapse float-left" id="navbarSupportedContent">
          <ul class="navbar-nav nav-dropdown " data-app-modern-menu="true">
            <li class="nav-item dropdown">
              <a
                class="nav-link link text-primary dropdown-toggle display-4"
                href="index.php"
                data-toggle="dropdown-submenu"
                aria-expanded="true"
                ><span
                   class="fa fa-home fa-3x" aria-hidden="true"
                ></span
                >Home&nbsp;</a
              >
              <div class="dropdown-menu">
                <a
                  class="text-primary dropdown-item display-4"
                  href="index.php#toggle2-1j"
                  aria-expanded="false"
                  >About us</a
                >
                <a
                  class="text-primary dropdown-item display-4"
                  href="index.php#testimonials-slider1-i"
                  >Clients</a
                ><a
                  class="text-primary dropdown-item display-4"
                  href="index.php#team1-l"
                  aria-expanded="false"
                  >Team</a
                >
                <a
                  class="text-primary dropdown-item display-4"
                  href="index.php#form4-f"
                  aria-expanded="false"
                  >Contact us</a
                >
              </div>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link link text-primary dropdown-toggle display-4"
                href="events.php"
                data-toggle="dropdown-submenu"
                aria-expanded="true"
                ><span
                   class="fa fa-calendar fa-2x" aria-hidden="true"
                ></span
                >EVENTS&nbsp;</a
              >
              <div class="dropdown-menu">
                <a
                  class="text-primary dropdown-item display-4"
                  href="previous .php"
                  >Previous Events</a
                ><a
                  class="text-primary dropdown-item display-4"
                  href="upcoming.php"
                  aria-expanded="false"
                  >Upcoming Events</a
                >
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link link text-primary dropdown-toggle display-4"
                href="bronze form.php"
                data-toggle="dropdown-submenu"
                aria-expanded="true"
                ><i class="pr-2 fa fa-bell fa-2x" aria-hidden="true"></i>
                BOOK NOW&nbsp;</a
              >
              <div class="dropdown-menu">
                <a
                  class="text-primary dropdown-item display-4"
                  href="bronze form.php"
                  >Bronze Offer</a
                >
                <a
                  class="text-primary dropdown-item display-4"
                  href="silver form.php"
                  aria-expanded="false"
                  >Silver Offer</a
                >
                <a
                  class="text-primary dropdown-item display-4"
                  href="gold form.php"
                  >Gold Offer</a
                >
              </div>
            </li>

            <?php
            
                      // Check if the user is logged in, if not then hide profile section
                      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
                          echo '
                          <li class="nav-item">
                            <a
                              class="nav-link link text-primary display-4"
                              href="profile.php"
                              ><span
                                class="fa fa-user fa-2x" aria-hidden="true"
                              ></span>

                              PROFILE</a
                            >
                          </li>';
                      }
              ?>
          </ul>
          <?php
            
            // Check if the user is logged in, if not then hide profile section
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
                echo '
                <div class="navbar-buttons mbr-section-btn">
                        <a class="btn btn-sm btn-success display-4" href="login.php"
                          >LOG IN</a
                        >
                      </div>
                ';
            }
          ?>
          <div class="navbar-buttons mbr-section-btn">
            
            <a
                class="nav-link link text-primary display-4"
                href="search.php"
                >&emsp;<span class="material-icons">search</span></a
              >      
          </div>
        </div>
      </nav>
    </section>
