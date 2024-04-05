<?php 
/**
 * SEMS server-to-server data exchange
 * @author Deh Saaduddin
 * @version 1.0
 */
require_once('header.php'); include('navbar.php'); include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div id="noticebox" class="card card-atom floating-popup" style="background:#273a4c; width: 100%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p class="notification-text text-white h4"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card card-atom" >
              <div class="card-header" style="background:#343a40;">
                <h3 class="card-title" style="color:#ecf1a0;">Personal Details</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <span>Account #: </span>
                        </td>
                        <td>
                          <span id="accountid" class="text-bold"></span>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <span>Email: </span>
                        </td>
                        <td>
                          <span id="emailadd" class="text-bold"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Name: </span>
                        </td>
                        <td>
                          <span id="cname" class="text-bold"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Address: </span>
                        </td>
                        <td>
                          <span id="address" class="text-bold"></span>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6 ">
            <div class="card card-dark">
              <div class="card-header ui-sortable-handle" style="cursor:move;">
                <h3 class="card-title">Bills & Consumptions</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <span>Total Balance: </span>
                        </td>
                        <td>
                          <span id="balance" class="text-lg text-bold text-red"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Total kWh: </span>
                        </td>
                        <td>
                          <span id="kwc" class="text-lg text-bold"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Total Payment: </span>
                        </td>
                        <td>
                          <span id="totalpaid" class="text-lg text-bold"></span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span>Recent Payment: </span>
                        </td>
                        <td>
                          <span id="prevpayment" class="text-lg text-bold"></span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- info boxes -->
          <div class="col-lg-6">
            <div id="lcdstyle" class="card card-atom" style="background:#343a40;">
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-6">
                                  <strong>Voltage:</strong>
                              </div>
                              <div class="col-md-6">
                                  <span id="voltageValue">220v</span>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <strong>Power Factor:</strong>
                              </div>
                              <div class="col-md-6">
                                  <span id="pfValue">0.02</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-6">
                                  <strong>Current:</strong>
                              </div>
                              <div class="col-md-6">
                                  <span id="currentValue">0.34</span>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <strong>kWh:</strong>
                              </div>
                              <div class="col-md-6">
                                  <span id="kwhUsedValue">0.23</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            
          <div id="remainingdays" class="card card-atom" style="background:#343a40;">
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-12">
                                  <p class="top-left-label">Tenure</p>
                                  <p class="top-left-value"></p>
                              </div>
                              <div class="col-md-12">
                                  <p class="bottom-left-label">Month(s)</p>
                                  <p class="bottom-left-value"></p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-12">
                                  <p class="top-right-label">Remaining</p>
                                  <p class="top-right-value"></p>
                              </div>
                              <div class="col-md-12">
                                  <p class="bottom-right-label">Power outage</p>
                                  <p class="bottom-right-value"></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
          <!-- ./Box info -->
          <!-- Real-time Line Chart -->
          <div class="col-lg-6">
              <div class="card card-dark">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Real-time Usage</h3>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <button id="resetButton" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="realtime-chart" width="400" height="200"></canvas>
                </div>
            </div>
          </div>
          <!-- /.Real-time Line Chart -->
          <!-- Line chart -->
          <div class="col-lg-12">
            <div class="card card-dark">
              <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  Monthly usage as of <?php echo date('F Y');?>
                </h3>
              </div>
              <div class="card-body">
                <div class="position-relative mb-6">
                  <canvas id="consumers-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> V
                  </span>

                  <span class="mr-2" >
                    <i class="fas fa-square text-green"></i> I 
                  </span>
                  <span class="mr-2" >
                    <i class="fas fa-square text-red"></i> pF
                  </span>
                  <span class="mr-2" >
                    <i class="fas fa-square text-yellow"></i> kWh
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.Line Chart -->
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once('footer.php'); // Footer contents?>