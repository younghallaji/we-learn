<?php
    include 'assets/includes/header.php';
?>

 <!-- Button trigger modal -->
 <!-- <button type="button" class="btn btn-dark mb-2 mr-2" data-toggle="modal" data-target="#loginModal">
                                      Login
                                    </button> -->

                                    <!-- Modal -->
                                    

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-spacing layout-top-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                        <div class="col-md-9 col-sm-12 col-12">
                                            <h4>List Of Registerd Department</h4>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-12 col-12">
                                            <a href="add-course" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#loginModal"> Add New Department</a>
                                        </div>
                                        </div>
                                    </div>                  
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive mb-4">
                                    <table id="column-filter" class="table">
                                        <thead>
                                            <tr>
                                                <th class="checkbox-column"> S/N </th>
                                                <th>Course Title</th>
                                                <th>Course Code</th>
                                                <th>Level</th>
                                                <th>Lecturer </th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="checkbox-column"> 1 </td>
                                                <td>Introduction to Computing</td>
                                                <td>COM 111</td>
                                                <td>100 Level</td>
                                                <td>Mr. Ajayi A. A</td>
                                                <td class="text-center">
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                            <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="checkbox-column"> 1 </td>
                                                <td>Introduction to Programming</td>
                                                <td>COM 111</td>
                                                <td>100 Level</td>
                                                <td>Mr. Lawal A. O</td>
                                                <td class="text-center"><button class="btn btn-outline-primary">View</button></td>
                                            </tr>

                                            <tr>
                                                <td class="checkbox-column"> 1 </td>
                                                <td>Introduction to Web Development</td>
                                                <td>STA 111</td>
                                                <td>100 Level</td>
                                                <td>Mr. Mutolib S. A</td>
                                                <td class="text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="checkbox-column"></th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Start Here -->
  
                <div class="modal rotateInDownLeft login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                          <div class="modal-header" id="loginModalLabel">
                                            <h4 class="modal-title">Add New Department</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                          </div>
                                          <div class="modal-body">
                                            <form class="mt-0">
                                              <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name">
                                              </div>

                                              <div class="form-group">
                                                <input type="text" class="form-control " placeholder="Course Code">
                                              </div>

                                              <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Lecturer">
                                              </div>

                                              <div class="form-group">
                                              <select name="level" id="" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">100 Level</option>
                                                    <option value="">200 Level</option>
                                                    <option value="">300 Level</option>
                                                </select>
                                              </div>

                                              
                                              <button type="submit" name= "submit" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                                            </form>

                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
            <!-- Modal Ends Here -->
<?php include 'assets/includes/footer.php';?>