<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register your kids</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="/assets/images/favicon.ico" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="/assets/css/style.css" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <div class="container row reg-panel">
    <div class="col-md-4 reg-panel-2">
      <div id="center">
      <div> 
      <img style ="width: 20rem; transition: width 2s"  src="/assets/images/rccg_logo.png" alt="RCCG Logo"> 
    </div>


        <h1>Children Church</h1>
        <p>Register your kids for church</p>
        <hr style="background-color: white" />
        <p >Already registered? <a style="color:blue" href="/registration/returning">Click here</a></p>

      
      </div>
      <hr />
      <div style="background-color: none; color: white;  margin-top: 18rem">
      <p style="font-style: italic;">Jesus Christ the same yesterday, today, and forever more. Amen</p>
</div>
    </div>
    <div class="col-md-8" style="border: 1px solid #ccc; padding-top: 1rem;">
      <form method="post" action="/registration/register">
        <h2>RCCG GWC Children Church Registration</h2>
        <p><b>Note:</b> You have to set a responsible party (last section) for drop off and pickup</p>
        <hr>
        <h2>Parent details</h2>
        <div class="row reg-input">
          <div class="col-md-6">
            <label>Parent's first name:</label><br />
            <input name="parentfn" type="text" placeholder="Enter your first name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required /><br />

            <label>Parent's last name:</label><br />
            <input name="parentln" type="text" placeholder="Enter your last name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required /><br />

            <label>Home address:</label><br />
            <textarea rows="3" name="address" placeholder="Enter your home address" required></textarea><br />
          </div>

          <div class="col-md-6">
            <label>Email:</label><br />
            <input name="email" type="email" style="text-transform: lowercase"; placeholder="Enter your email address" required /><br />

            <label>Telephone:</label><br />
            <input name="phonenumber" type="number" placeholder="Enter your telephone number" required /><br />

            <label>Member/Visitor:</label><br />
            <select name="member">
              <option>Member</option>
              <option>Visitor</option>
            </select><br />

            <label>Number of kids to register:</label><br />
            <select id="num-of-kids" name="kidnumber">
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
            <br />
          </div>
        </div>
        <hr>
        <div style="margin-top: 1rem">
          <h2>Children details</h2>
          <p><b>Note:</b> You have to set a responsible party (last section) for drop off and pickup</p>
          <div class="container row reg-input" style="overflow-x: auto; max-height: 200px">
            <div class="col-md-3 kid-form" id="kid-first-names">
              <label>First name:</label><br />
              <input name="cfirstname[]" type="text" placeholder="Kid's first name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"required /><br />
            </div>
            <div class="col-md-3 kid-form" id="kid-last-names">
              <label>Last name:</label><br />
              <input name="clastname[]" type="text" placeholder="Kid's last name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required /><br />
            </div>

            <div class="col-md-3 kid-form" id="kid-dobs">
              <label>D.O.B:</label><br />
              <input name="dob[]" type="date" placeholder="Kid's date of birth" required /><br />
            </div>

            <div class="col-md-3 kid-form" id="kid-classes">
              <label>Class:</label><br />
              <select name="cclass[]">
                <option>Toddler</option>
                <option>5-6 years</option>
                <option>7-8 years</option>
                <option>9-12 years</option>
                <option>Nannies</option>
              </select>
              <br />
            </div>
          </div>
        </div>
        <hr>
        <div>
          <h2>Responsible Party</h2>
          <p>The responsible party identifies the person who will be in charge of dropping off and
            picking up the child(ren)</p>

          <div class="reg-input">
            <div class="row">
              <div class="col-md-6">
                <select id="responsible-party" name="responsible-party">
                  <option value=0>Same as parent</option>
                  <option value=1>Among registered kids</option>
                  <option value=2>Someone different (e.g. a nanny)</option>
                </select>
              </div>
              <div class="col-md-6" id="resp-a-child" style="display: none;">
                <select id="resp-kid">
                  
                </select>
              </div>
            </div>
            <p id="resp-text">Registered parent will be in charge of dropping off and picking up</p>

            <div id="resp-other" style="display: none;">
              <div class="row reg-input">
                <div class="col-md-6">
                  <label>First name:</label><br />
                  <input name="relfn" type="text" placeholder="Enter first name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" /><br />

                  <label>Last name:</label><br />
                  <input name="relln" type="text" placeholder="Enter last name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" /><br />
                </div>

                <div class="col-md-6">
                  <label>Email:</label><br />
                  <input name="relemail" type="email" style="text-transform: lowercase" placeholder="Enter email address"  /><br />

                  <label>Telephone:</label><br />
                  <input name="relphonenumber" type="number" placeholder="Enter telephone number" /><br />
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="g-recaptcha" data-sitekey="6LeeyHwcAAAAADZRigDcewkJ2ZbGU57rram4Z1sG"></div>
        <div style="text-align: center; margin-bottom: 2rem; margin-top: 2rem;">
            
          <button type="submit" class="reg-button btn btn-large" id="save-reg">Save registration</button>
        </div>
      </form>
    </div>
  </div>
  <script src="/assets/js/scripts.js"></script>
</body>

</html>