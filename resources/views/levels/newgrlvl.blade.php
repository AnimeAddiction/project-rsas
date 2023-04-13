<link rel="stylesheet" href="{{ asset('css/creategrlvl.css') }}">

@extends('master')
@section('content')

<body>

    <!--NAVBAR-->
    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
        <div class="container-fluid">
            <div class="navbar-brand">
                <i class="fa-solid fa-circle-plus icon-white"></i>
                Create Grade Level
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
    <form class="needs-validation">
      <fieldset>
        <div class="row my-3 gy-4">
            <div class="col-md-3 input-field">
                <div class="form-outline">
                    <label for="subj_id" class="input-title">Section Name</label>
                    <input type="text" class="form-control form-control-sm" placeholder="BARBZ" name="subj_id" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>

            <div class="col-md-3 input-field"> 
                <label for="grade_level" class="input-title">Grade Level</label>   
                <select name="grade_level" class="form-control form-select" placeholder="Choose Department ID" id="grade_level" required>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    <option value="4">Level 4</option>
                    <option value="5">Level 5</option>
                    <option value="6">Level 6</option>
                    <option value="7">Level 7</option>
                    <option value="8">Level 8</option>
                    <option value="9">Level 9</option>
                    <option value="10">Level 10</option>
                </select>
                <div class="is-invalid" role="alert" id="gradeError" name="gradeError">
                    <strong></strong>
                </div>
            </div>

            <div class="col-md-3 input-field">
                <div class="form-outline">
                    <label for="subj_id" class="input-title">Section ID</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Input a 5 digit integer" name="subj_id" minlength="5" maxlength="5" pattern="[0-5]+" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>

            <div class="col-md-3 input-field">
                <div class="form-outline">
                    <label for="subj_id" class="input-title">Adviser ID</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Input a 5 digit integer" name="subj_id" minlength="5" maxlength="5" pattern="[0-5]+" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            


            <div class="row">
              <div class="col-md-5 input-field ">
                  <div class="form-outline">
                      <label for="subj_id" class="input-title">Student ID</label>
                      <input type="text" class="form-control form-control-sm" placeholder="Input a 5 digit integer" id="studid" minlength="9" maxlength="9" pattern="[0-5]" required>
                      <div class="valid-feedback">Looks good!</div>
                  </div>
              </div>
            
              <div class="col-md-6 input-field">
                <div class="form-outline">
                  <label for="subj_id" class="input-title">Student Name</label>
                  <input type="text" class="form-control form-control-sm" placeholder="" id="studname" required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
            
              <div class="col-md-1 input-field float-end" style="padding-top: 12px;">
                <div class="form-group pt-3 ">
                  <button class="btn btn-primary create" type="" onclick="addRow()" id="add"><i class="fa-solid fa-user-plus"></i>  Add</button>
                </div>
              </div>
            </div>

            <hr>
            <table id="list" class="center">
              <tr>
                <th>Student ID</th>
                <th>Student Name</th>
              </tr>
              <tr>
                <td>202012345</td>
                <td>Maria Anders</td>
                <td class="delete"><button type='button' class='btnDelete'><i class="fa-solid fa-xmark"></i></button></td>
              </tr>
              <tr>
                <td>202012346</td>
                <td>Christina Berglund</td>
                <td class="delete"><button type='button' class='btnDelete'><i class="fa-solid fa-xmark"></i></button></td>
              </tr>
              <tr>
                <td>101078945</td>
                <td>Francisco Chang</td>
                <td class="delete"><button type='button' class='btnDelete'><i class="fa-solid fa-xmark"></i></button></td>
              </tr>
            </table>

            <hr>
            <i class="total">Total Number of Students: 3</i>


        </div>

        <div class="form-group pt-3 float-end">
          <span class="submit-reminder me-3">Double-check the information before pressing the button</span>
          <button class="btn btn-primary create" type="submit"><i class="fa-solid fa-square-plus icon-white"></i>  Create</button>
        </div>

    </div>
            
    </div>
    </div>

  </fieldset>
    </form>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $("#multiple").select2({
          placeholder: " Select scheduled days",
          allowClear: true
      });
    </script>
    <script>
      $(document).ready(function(){
        $("#list").on('click','.btnDelete',function(){
            $(this).closest('tr').remove();
          });
      });
    </script>

    <!--This is supposed to add student details to row but for some  reason dili siya muwork T.T-->
    <script>
      function addRow() {
        "use strict";

          var table = document.getElementById("list"); 
          
          var row= document.createElement("tr");
          console.log(row);
          var td1 = document.createElement("td");
          var td2 = document.createElement("td");

          td1.innerHTML = document.getElementById("studid").value;
          td2.innerHTML  = document.getElementById("studname").value;

          row.appendChild(td1);
          row.appendChild(td2);

          table.children[0].appendChild(row);
      };
    </script>

<style>
  button.create {
    margin-top: auto;
    margin-bottom: 0;
  }
  </style>

</body>
</html> 