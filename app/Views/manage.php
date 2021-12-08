<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="/assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
</head>

<body>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script> -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <div id="parent-details" class="modal" tabindex="-1" role="dialog">
    <div class="modal-content parent-details-content">
      <div class="row">
        <div class="col-md-4" style="text-align: center">
          <img id="parent-qrcode" style="width: 10rem" src="/assets/images/qr_code.png" alt="Parent QR code here" /><br />
          <p id="manage-parent-code" style="word-wrap: anywhere; font-weight: bold;">Parent code here</p>
          <h4>Responsible party</h4>
          <div class="reg-input" style="padding-left: 1rem;">
            <input id="man_respcat" placeholder="Category" type="text" readonly /><br>
            <input id="man_respfn" placeholder="Full name" type="text" style=input: disabled /><br>
            <input id="man_respem" placeholder="Email" type="text" style=input: disabled /><br>
            <input id="man_respph" placeholder="Phone number" type="text"  /><br>
          </div>
         
        </div>
        <div class="col-md-8" style="padding-top: 16px">
          <h2>Registration Details</h2>
          <hr>
          <h4>Parent Details</h4>
          <lable id="modal-parent-name" style="font-weight: bold"  ></lable><br />
          <p>
            <a id="modal-parent-email" href=""></a><span> | </span>
            <span id="modal-parent-phone"></span><br>
            <span id="modal-parent-address"></span>
          </p>
          <hr>
          <h4>Children Details</h4>
          <div class="children-list-div">
            <ul class="children-list"></ul>
          </div>
          <div style="text-align: center; margin-top: 1rem;">
          <button id="deactivate-act" class="reg-button">Deactivate</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="print-kid-code" class="modal" tabindex="-1" role="dialog">
    <div class="modal-content kid-code-content">
      <div class="row">
        <div id="kid-code-img" class="col-md-4" style="text-align: center">
          <img style="width: 10rem" src="" /><br />
        </div>
`
      </div>
      <div style="text-align: center">
        <label id="print-kid-qr" class="reg-button">Print slip</label>
      </div>
    </div>
  </div>

  <div id="scan-kid-code" class="modal" tabindex="-1" role="dialog">
    <div class="modal-content kid-code-content" style="width: 50%;">
      <div class="row">
        <div class="col-md-4" style="text-align: center">
          <img style="width: 10rem" src="/assets/images/qr_code.png" /><br />
        </div>
        <div class="col-md-8 reg-input" style="padding-top: 16px; padding-right: 7rem">
          <input id="kid-code-for-pickup" type="text" placeholder="Scan QR code (case sentitive)" value=" " /><br />
          <p id="can-pick-msg" class="alert alert-success" style="text-align: center; margin-top: 1rem;display:none">
            Child and parent information properly matched, proceed to confirm
          </p>
          <p id="cannot-pick-msg" class="alert alert-danger" style="text-align: center; margin-top: 1rem; display:none">
            Please contact admin, we can not verify your kid's code.
          </p>
        </div>
      </div>
      <div style="text-align: center">
        <label class="reg-button " id="pickup-confirm">Confirm</label>
        <label class="btn btn-warning" id="pickup-dismiss">Dismiss</label>
      </div>
    </div>
  </div>

  <div class="container row reg-panel">
    <div class="col-md-3 reg-panel-2">
      <div id="center">
      <img style ="width: 10rem" src="/assets/images/rccg_logo.png">
        <h1>Children Church</h1>
        <label class="nav-button active" id="manage">Manage</label><br />
        <label class="nav-button inactive" id="drop-off">Drop off</label><br />
        <label class="nav-button inactive" id="pick-up">Pick up</label>
      </div>
      <hr />
    </div>
    <div class="col-md-9 reg-input" style="border: 1px solid #ccc">
      <div id="manage-panel">
        <div style="text-align: center">
          <h1>Manage List</h1>
          <hr />
        </div>

        <div id="">
          <table class="details-table" id="manage-table">
            <thead>
              <tr>
                <th>SN</th>
                <th>Parent name</th>
                <th>Phone number</th>
                <!-- <th>Email</th> -->
                <th>Registered</th>
                <th>Kids</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($parents) : $i = 0; ?>
                <?php foreach ($parents as $parent) : $i++; ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $parent->firstname . ' ' . $parent->lastname; ?></td>
                    <td><?php echo $parent->phonenumber; ?></td>
                    <!-- <td><?php echo $parent->email; ?></td> -->
                    <td><?php echo date_format(date_create($parent->updated_at), "Y/M/d"); ?></td>
                    <td><?php echo $parent->number_of_kids; ?></td>
                    <td>
                      <label data-id="<?php echo $parent->id; ?>" class="reg-button view-details" style="padding: 0px 5px;">View</label>
                      <label data-id="<?php echo $parent->id; ?>" class="reg-button print-code2" style="padding: 0px 5px;">Resend code</label>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="c" style="display: none">
        <div style="text-align: center">
          <h1>Kids Drop Off</h1>
          <hr />
        </div>
        <div style="text-align: center" id="drop-off-scan">
          <img style="width: 10rem" src="/assets/images/qr_code.png" /><br />
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <input id="drop-off-code" type="text" placeholder="Enter parent code (case sentitive)" />
            </div>
            <div class="col-md-3"></div>
          </div>
          <div>
            <label class="reg-button" style="margin-top: 1rem" id="drop-off-fetch">Fetch drop off details</label><br />
            <p style="color: grey">
              Automatic fetch is done after scanning is enabled. <br />If
              this doesn't happen please click the 'Fetch details' button
            </p>
          </div>
        </div>
        <div id="drop-off-details" style="display: none">
          <table class="details-table" id="drop-off-table">
            <thead>
              <tr>
                <th>SN</th>
                <th>Kid's name</th>
                <th>Age (years)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="kids-list-for-dropoff">

            </tbody>
          </table>
          <div style="text-align: center">
            <label class="reg-button" id="drop-off-back">Back to drop off</label>
          </div>
        </div>
      </div>



      <div id="pick-up-panel" style="display: none">
        <div style="text-align: center">
          <h1>Kids Pick up</h1>
          <hr />
        </div>
        <div style="text-align: center" id="pick-up-scan">
          <img style="width: 10rem" src="/assets/images/qr_code.png" /><br />
          <!-- <form > -->
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <input id="pickup-qrcode" name="qrcode" type="text" placeholder="Enter Parent Code (case sentitive)" />
            </div>
            <div class="col-md-3"></div>
          </div>
          <div>
            <label class="fkid-button" style="margin-top: 1rem" id="pick-up-fetch">Fetch pick up details</label><br />
            <p style="color: grey">
              Automatic fetch is done after scanning is enabled. <br />If
              this doesn't happen please click the 'Fetch details' button
            </p>
          </div>
          <!-- </form> -->
        </div>
        <div id="pick-up-details" style="display: none">
          <table class="details-table" id="pick-up-table">
            <thead>
              <tr>
                <th>SN</th>
                <th>Kid's name</th>
                <th>Age (years)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="kid-list">

            </tbody>

          </table>
          <div style="text-align: center">
            <label class="reg-button" id="pick-up-back">Back to pick up</label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/assets/js/scripts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $("#manage-table").DataTable();
      $("#drop-off-table").DataTable();
      $("#pick-up-table").DataTable();
      $("#children-list").DataTable();
    });
  </script>
</body>

</html>