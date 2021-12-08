<!DOCTYPE html>
<html lang="en">

<head>
  <title>Returning parent</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="/assets/css/style.css" />
</head>

<body>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

 

  <div class="container row reg-panel">
    <div class="col-md-4 reg-panel-2">
      <div id="center">
        <div> 
        <img style ="width: 10rem; transition: width 2s"  src="/assets/images/rccg_logo.png" alt="RCCG Logo"> 
        </div>

        <h1>Children Church.</h1>
       
      </div>
        <label class="nav-button active" id="returning-drop-off" style="visibility: hidden">Drop off</label><br />
        <label class="nav-button active" id="log-out" style="visibility: hidden">Log Out</label><br />
    </div>


    <div class="col-md-8 reg-input" style="border: 1px solid #ccc" id="returning-scan-panel">
      <div id="returning-manage-panel">
      <div id ="parent-login">
        <h1>Find your details</h1>
        <p>To generate a new code, enter the following details and click 'fetch details'</p>
        <hr />
        <div class="row reg-input">
          <div class="col-md-6">
            <label>Parent Code:</label><br />
            <input id="fetch-code" placeholder="Enter your Code" type="text" required /><br />
          </div>
          <div class="col-md-6">
            <label>Email:</label><br />
            <input id="fetch-email" style="text-transform: lowercase" placeholder="Enter your email" type="text" required /><br />
          </div>
        </div>
        <div style="text-align:center; margin-top:2rem;">
          <label class="reg-button" id="fetch-parent-details">Fetch details</label>
        </div>
        </div>
       
        <div id ="parent-details-main" style="display: none;">
        <h2  id = "pd-header" style="text-align: center">Parent Details</h2>
        <div id="parent-details-1" style="text-align: center;">
          <p>Parent details</p>
        </div>
        <div id="parent-details-2"  style="display: none;">
          <div class="col-md-12" style="text-align: center">
           
            <label style="font-weight: bold" id="ret-parent-code"></label><br />
            <label style="font-weight: bold" id="ret-parent-name"></label><br />
            <p>
             <label id="ret-parent-email" ></label><br />
              <label id="ret-parent-phone"></label><br />
              <label  id="ret-parent-Address"></label>

              <label id="res-person-id" style= "display: none"></label>
              <label id="parent-id" style= "display:none"></label>
              <label id="reg-id" style= "display: none"></label>
           
            </p>
            <h4>Responsible party</h4>
          <div class="reg-input col-md-4" style="padding-left: 1rem; width: auto; margin:auto">
          <select id="man_respcat" name="responsible-party">
                  <option value=0>Same as parent</option>
                  <option value=1>Among registered kids</option>
                  <option value=2>Someone different (e.g. a nanny)</option>
                </select>
           
            <input id="man_respfn" placeholder="Full name" type="text"/><br>
            <input id="man_respem" placeholder="Email" type="text" style="text-transform: lowercase"/><br> 
            <input id="man_respph" placeholder="Phone number" type="text"  /><br>
          </div>
          <div style="text-align: center; margin-top: 1rem;">
          <label id="update_details" class="reg-button" style="visibility:hidden";>Update Details</label>
          </div>
          </br>
              <div class="col-md-12 reg-input" style="border: 1px solid #ccc">
                        <h4>Children Details</h4>
                      
                          <div id="manage-panel" style="width:100%">
                        <table class="details-table" id="retkid-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>SN</th>
                              <th>Kid Name</th>
                              <th>Date of Birth</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="retkidbody-table">

                            
                          </tbody>
                        </table>

                      </div>
          </div>
          </br>
          <label id="add_kid" class="reg-button">Add Kid</label>
          <div id ="add_Kidoption"  style="display: none">
          <label>Select the number of kids to Add:</label>
          <div class = "row col-md-2">
          
            <select id="num-of-kids-returning" name="kidnumber">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
            </select>
            </div>
          </div>
          
          <div class="row col-md-12" id ="add_Kidtext" style="display: none">
          <div class="col-md-3 kid-form" id="kid-first-names">
              <label>First name:</label><br />
              <input name="cfirstname" type="text" placeholder="Kid's first name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"required /><br />
            </div>
            <div class="col-md-3 kid-form" id="kid-last-names">
              <label>Last name:</label><br />
              <input name="clastname" type="text" placeholder="Kid's last name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required /><br />
            </div>

            <div class="col-md-3 kid-form" id="kid-dobs">
              <label>D.O.B:</label><br />
              <input name="dob" type="date" placeholder="Kid's date of birth" required /><br />
            </div>
            <div class="col-md-3 kid-form" id="kid-classes">
              <label>Class:</label><br />
              <select name="cclass">
                <option>Toddler</option>
                <option>5-6 years</option>
                <option>7-8 years</option>
                <option>9-12 years</option>
                <option>Nannies</option>
              </select>
            </div>
            </div>
            <div style=" text-align:center;"><label id="register_kid" class="reg-button" style="visibility:hidden;">Register Kid(s)</label></div>
          </br>
</div>

        

  </div>
  <div id="returning-drop-off-panel" style="width:100%" >
              <div style="text-align: center">
                <h1>Kids Drop Off Details</h1>
                <hr />
              </div>
          
                <div id="drop-off-details" style="width:100%">
                  <table class="dropoff-details-table" id="drop-off-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>SN</th>
                        <th>Kid's name</th>
                        <th>Date Of Birth</th>
                        <th>Select Kid(s)</th>
                      </tr>
                    </thead>
                    <tbody class="kids-list-for-dropoff" id="dropoffkidbody-table">
                    </tbody>
                  </table>
                  </div>
                  </br>
                <div style="text-align:center">
               <span style="padding-right: 6em"> <label class="reg-button" id="back-to-panel">Back</label>  </span>
               <label class="reg-button" id="pdrop-off">DropOff</label>
                </div>
                
      </div>
  <script src="/assets/js/scripts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $("#retkid-table").DataTable({searching:false, paging:false,info:false});
      $("#dropoff-details-table").DataTable({searching:false, paging:false,info:false});
    });
  </script>
</body>
</html>