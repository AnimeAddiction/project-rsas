<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create New User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/createuser.css') }}">
  <script src="{{ asset('js/createuser.js') }}"></script>
  <script src="https://kit.fontawesome.com/47cd24d297.js" crossorigin="anonymous"></script>
</head>

<body>

    <!--NAVBAR-->
    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
        <div class="container-fluid">
            <div class="navbar-brand">
                <i class="fa-solid fa-circle-plus icon-white"></i>
                Create New User
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="#" title="View Account"><i class="fa-solid fa-user icon-white"> John Doe</i></a>
                  </li>  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"></a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-wrench"></i> Preferences</a></li>
                      <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
                      <div class="dropdown-divider"></div>
                      <li><a class="dropdown-item" href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
        </div>
      </nav>

    
    <!--FORM -->
    <div class="container pt-5">
    <form action="dataInsert" method="post" enctype="multipart/form-data" class="needs-validation">
        @csrf
      <fieldset>
        <div class="row my-3">
            <div class="col-md-6 input-field">
                <div class="form-outline">
                <label for="user_id" class="input-title">User ID</label>
                <input type="text" class="form-control form-control-sm" placeholder="20XXXXXX" name="user_id" minlength="9" maxlength="9" pattern="[0-9]+" required>
                <div class="valid-feedback">Looks good!</div>
                </div>
            </div>

            <div class="col-md-6 input-field">
                    <label for="user_pswrd" class="input-title">User Password</label>
                    <input type="password" class="form-control form-control-sm" placeholder="XXXX" name="user_pswrd" maxlength="20" required>
                    <div class="valid-feedback">Looks good!</div>
            </div> 
        </div>
    </div>

    <!--User Role-->
    <div class="container pt-2 input-field">
        <div class="input-title pb-2">User Role</div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" onclick="javascript:userCheck();" name="role" id="studentCheck" value="1">
            <label class="form-check-label" for="studentCheck">Student</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" onclick="javascript:userCheck();" name="role" id="advisorCheck" value="2">
            <label class="form-check-label" for="advisorCheck">Advisor</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" onclick="javascript:userCheck();" name="role" id="adminCheck" value="0">
            <label class="form-check-label" for="adminCheck">Administrator</label>
          </div>
        <!--If student-->
            <div class="no-display" id="ifStudent">
                <hr>
                <!--Name-->
                <div class="row my-3">
                    <div class="col-6 col-md-4 input-field">
                        <label for="first" class="input-title">First Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Ex. Jose" name="first" maxlength="20" pattern="[a-zA-Z\s]+" required>
                    </div>
        
                    <div class="col-6 col-md-4 input-field">
                            <label for="middle" class="input-title">Middle Name</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Ex. Protacio" name="middle" maxlength="20" pattern="[a-zA-Z\s]+" required>
                    </div> 

                    <div class="col-6 col-md-4 input-field">
                        <label for="last" class="input-title">Last Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Ex. Rizal" name="last" maxlength="20" pattern="[a-zA-Z\s]+" required>
                    </div> 
                </div>

                <!--Gender-->
                <div class="input-title pb-2">Gender</div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="M">
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                <hr>
                <!--RFID
                <div class="form-outline pb-2">
                    <label for="rfid" class="input-title">RFID Number</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Enter a N-M digit integer" name="rfid" pattern="[0-9]+" required>
                </div>
            </div>

            [If advisor]
            <div class="no-display" id="ifAdvisor">
                <hr>
                [Name]
                <div class="row my-3">
                    <div class="col-6 col-md-4 input-field">
                        <label for="first" class="input-title">First Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Ex. Jose" name="first" maxlength="20" pattern="[a-zA-Z\s]+" required>
                    </div>
        
                    <div class="col-6 col-md-4 input-field">
                            <label for="middle" class="input-title">Middle Name</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Ex. Protacio" name="middle" maxlength="20" pattern="[a-zA-Z\s]+" required>
                    </div> 

                    <div class="col-6 col-md-4 input-field">
                        <label for="last" class="input-title">Last Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Ex. Rizal" name="last" maxlength="20" pattern="[a-zA-Z\s]+" required>
                    </div> 
                </div>
                [Gender]
                <div class="input-title pb-2">Gender</div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="male" value="M">
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="female" value="F">
                    <label class="form-check-label" for="female">Female</label>
                  </div>-->
            </div>
            <div class="form-group pt-3 float-end">
                <span class="submit-reminder me-3">Double-check the information before pressing the button</span>
                <button class="btn btn-primary create" type="submit"><i class="fa-solid fa-square-plus icon-white"></i>  Create</button>
            </div>
            
    </div>
    </div>

  </fieldset>
    </form>

</body>