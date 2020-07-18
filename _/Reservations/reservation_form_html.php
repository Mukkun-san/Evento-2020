

<form action="_/Reservations/ReserveAction.php" method="post" enctype="multipart/form-data">

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="Enter your First Name"
                                name="fname"
                                required
                              />
                              <span class="form-label">First Name</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="Enter you Last Name"
                                name="lname"
                                value=""
                                required
                              />
                              <span class="form-label">Last Name</span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-9">
                            <div class="form-group">
                              <input
                                class="form-control"
                                type="email"
                                placeholder="Enter your Email"
                                name="email"
                                required
                              />
                              <span class="form-label">Email</span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <select class="form-control" name="identity" required>
                                <option value="" selected hidden
                                  >Identity</option
                                >
                                <option>Organisation</option>
                                <option>Club</option>
                                <option>Individual</option>
                              </select>
                              <span class="select-arrow"></span>
                              <span class="form-label">Identity</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <select class="form-control" name="format" required>
                                <option value="" selected hidden
                                  >Choose an Event Format</option
                                >
                                <option>Conference</option>
                                <option>Hackathon</option>
                                <option>Party</option>
                                <option>Non profit</option>
                                <option>Trade Show</option>
                                <option>Corporate</option>
                                <option>Competition</option>
                                <option>Training</option>
                              </select>

                              <span class="select-arrow"></span>
                              <span class="form-label">Event Format</span>
                            </div>
                          </div>
                        </div>


                        <?php
                          // if visited SiLver OR GOLD pages display the Services 
                          if (($_SESSION['PACK'] !== "bronze")) {
                              echo'<div class="row">
                              <div class="col-md-7">
                                <div class="form-group">
                                  <select class="form-control" name="service" required>
                                    <option value="" selected hidden
                                      >Choose a special Service</option
                                    >
                                    <option>Core Event Management </option>
                                    <option>Event marketing</option>
                                    <option>Delegate Management</option>
                                    <option>Financial Management </option>
                                  </select>
    
                                  <span class="select-arrow"></span>
                                  <span class="form-label">Services</span>
                                </div>
                              </div>
                            </div>';
                          }

                        ?>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input
                                class="form-control"
                                type="date"
                                name="checkin"
                                id="checkin"
                                onchange="checkIN(this)" 
                                required
                              />
                              <!-- checkIN(this) will make sure checkin < checkout date -->

                              <span class="form-label">Check In Date</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <input
                                class="form-control"
                                type="date"
                                name="checkout"
                                id="checkout"
                                onchange="checkOUT(this)"
                                required
                              />
                              <!-- checkOUT(this) will make sure checkin < checkout date -->

                              <span class="form-label">Check out Date</span>
                            </div>
                          </div>
                        </div>

                          <!-- SCRIPT for compare dates Functions -->
                       <script src="_/Reservations/CompareDates.js"></script>     


                        <?php

                        // if visited GOLD page display the file upload
                        if ($_SESSION['PACK'] == "gold") {
                            echo'<div class="container">
                          <div class="name">
                            Upload a document describing your event. Max file
                            size 50 MB
                          </div>
                          <div class="form-row">
                            <div class="value">
                              <div class="input-group js-input-file">
                                <input
                                  class="input-file"
                                  type="file"
                                  name="document"
                                  id="file"
                                  onchange="ValidateFileInput(this);"
                                  required
                                />
                                <label class="label--file" for="file"
                                  >Choose file</label
                                >
                                <span class="input-file__info"
                                  >No file chosen</span
                                >
                              </div>
                            </div>
                          </div>
                        </div>';
                        }
                        ?>

                        <br />
                        <div class="form-btn">
                          <button class="submit-btn" name="submit">Book Now</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

