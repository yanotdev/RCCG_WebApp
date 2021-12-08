$("#num-of-kids").change(function () {
  var amount = $(this).val();
  var firstnames = "<label>First name:</label><br />";
  var lastnames = "<label>Last name:</label><br />";
  var dobs = "<label>D.O.B:</label><br />";
  var classes = "<label>Class:</label><br />";
  for (var count = 1; count <= amount; count++) {
    firstnames +=
      '<input name="cfirstname[]" type="text" placeholder="Kid\'s first name" required /><br />';
    lastnames +=
      '<input name="clastname[]" type="text" placeholder="Kid\'s last name" required /><br />';
    dobs +=
      '<input name="dob[]" type="date" placeholder="Kid\'s date of birth" required /><br />';
    // classes += '<input name="cclass[]" type="text" placeholder="Kid\'s class" required /><br />'
    classes +=
      '<select name="cclass[]">' +
      "<option>Toddler</option>" +
      "<option>5-6 years</option>" +
      "<option>7-8 years</option>" +
      "<option>9-12 years</option>" +
      "<option>Nannies</option>" +
      "</select><br />";
  }
  $("#kid-first-names").html(firstnames);
  $("#kid-last-names").html(lastnames);
  $("#kid-dobs").html(dobs);
  $("#kid-classes").html(classes);
});

$("#returning-fetch").click(function () {
  $("#returning-scan-panel").hide();
  $("#returning-fetch-panel").show();
});

$("#returning-back").click(function () {
  $("#returning-scan-panel").show();
  $("#returning-fetch-panel").hide();
});

$("#manage").click(function () {
  $("#drop-off-panel").hide();
  $("#pick-up-panel").hide();
  $("#manage-panel").show();

  var x = $(".nav-button.active").removeClass("active");
  x.addClass("inactive");

  $(this).removeClass("inactive");
  $(this).addClass("active");
});

$("#drop-off").click(function () {
  $("#drop-off-panel").show();
  $("#pick-up-panel").hide();
  $("#manage-panel").hide();

  var x = $(".nav-button.active").removeClass("active");
  x.addClass("inactive");

  $(this).removeClass("inactive");
  $(this).addClass("active");
});

$("#pick-up").click(function () {
  $("#drop-off-panel").hide();
  $("#pick-up-panel").show();
  $("#manage-panel").hide();

  var x = $(".nav-button.active").removeClass("active");
  x.addClass("inactive");

  $(this).removeClass("inactive");
  $(this).addClass("active");
});

$("#drop-off-code").on("keyup", function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    fetchKids();
  }
});

$("#drop-off-fetch").click(function () {
  fetchKids();
});

function fetchKids() {
  $("#drop-off-scan").hide();
  let code = $("#drop-off-code").val();
  let rows = "";

  $(".details-table .kids-list-for-dropoff").html(rows);
  $.ajax({
    method: "POST",
    url: "/manage/getKidsByCode",
    data: { qrcode: code },
    success: function (data) {
      data = JSON.parse(data);
      console.log(data);

      if (data["status"] == 1) {
        data["message"].forEach((child, index) => {
          rows += "<tr>";
          rows += "<td>" + (index + 1) + "</td>";
          rows +=
            "<td>" + child["firstname"] + " " + child["lastname"] + "</td>";
          rows += "<td>" + calculateAge(child["Date_of_birth"]) + "</td>"; ///
          rows +=
            '<td><label data-id="' +
            child["id"] +
            '" class="reg-button print-code">Print Code</label></td></tr>';
        });
        $(".details-table .kids-list-for-dropoff").html(rows);
      } else {
        rows =
          '<tr><td colspan="4" style="text-align:center">No Record Found</td></tr>';
        $(".details-table .kids-list-for-dropoff").html(rows);
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
  $("#drop-off-details").show();
}

$("#drop-off-back").click(function () {
  $("#drop-off-scan").show();
  $("#drop-off-details").hide();
});

function pickKids() {
  $("#pick-up-scan").hide();
  $("#pick-up-details").show();
  let rows = "";
  let code = $("#pickup-qrcode").val();
  $(".details-table .kid-list").html(rows);
  $.ajax({
    method: "POST",
    url: "/manage/getKidsForPickUp",
    data: { qrcode: code },
    success: function (data) {
      data = JSON.parse(data);
      console.log(data);

      if (data["status"] == 1) {
        data["message"].forEach((child, index) => {
          rows += "<tr>";
          rows += "<td>" + (index + 1) + "</td>";
          rows +=
            "<td>" + child["firstname"] + " " + child["lastname"] + "</td>";
          rows += "<td>" + calculateAge(child["Date_of_birth"]) + "</td>";
          rows +=
            '<td><label class="reg-button scan-code">Scan code</label></td></tr>';
        });
        $(".details-table .kid-list").html(rows);
      } else {
        rows =
          '<tr><td colspan="4" style="text-align:center">No Record Found</td></tr>';
        $(".details-table .kid-list").html(rows);
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
}

$("#pickup-qrcode").on("keyup", function (e) {
  if (e.key === "Enter" || e.keyCode === 13) {
    pickKids();
  }
});

$("#pick-up-fetch").click(function () {
  pickKids();
});

$("#pick-up-back").click(function () {
  $("#pick-up-scan").show();
  $("#pick-up-details").hide();
});

$(document).on("click", ".print-code", function () {
  let childId = $(this).attr("data-id");
  $.ajax({
    method: "POST",
    url: "/manage/createQRForKid",
    data: { id: childId },
    success: function (data) {
      console.log(data);
      $("#print-kid-code img").attr("src", data);
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
  $("#print-kid-code").modal("show");
});

$(document).on("click", "#print-kid-qr", function () {
  printDiv();
});

$(document).on("click", ".scan-code", function () {
  $("#scan-kid-code").modal("show");
});

$(document).on("click", "#pickup-confirm", function () {
  $("#can-pick-msg").css("display", "none");
  $("#cannot-pick-msg").css("display", "none");
  let code = $("#kid-code-for-pickup").val();

  $.ajax({
    method: "POST",
    url: "/manage/verifypickup",
    data: { code: code },
    success: function (data) {
      data = JSON.parse(data);
      if (data["status"] == 1) {
        $("#can-pick-msg").css("display", "block");
      } else {
        $("#cannot-pick-msg").css("display", "block");
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});

$(document).on("click", "#pickup-dismiss", function () {
  $("#scan-kid-code").modal("hide");
});

$("#ret-gensend-code").click(function () {
  let id = $(this).attr("data-id");
  $.ajax({
    method: "POST",
    url: "/manage/sendQR",
    data: { id: id },
    success: function (data) {
      console.log(data);
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});

$(".print-code2").click(function () {
  let id = $(this).attr("data-id");
  $.ajax({
    method: "POST",
    url: "/manage/sendQR",
    data: { id: id },
    success: function (data) {
      console.log(data);
      alert("Code sent successfully");
    },
    error: function (xhr, status, error) {
      console.error(xhr);
      alert("Failed to send code");
    },
  });
});



function calculateAge(birthday) { // birthday is a date
  var birth  = new Date(birthday)
  var ageDifMs = Date.now() - birth.getTime();
  var ageDate = new Date(ageDifMs); // miliseconds from epoch
  var age = Math.abs(ageDate.getUTCFullYear() - 1970);
 
  if (age===0){
    return "<1 year";
  }
  else if (age===1){
    return "1 year";
  }
  else{
    return age + " " + "years";
  }
}

function printDiv() {
  var divContents = document.getElementById("kid-code-img").innerHTML;
  var a = window.open("", "", "height=500, width=500");
  a.document.write("<html>");
  a.document.write("<body>");
  a.document.write(divContents);
  a.document.write("</body></html>");
  a.document.close();
  window.print();
  window.close();
  a.focus();
  
}

$(".view-details").click(function () {
  var parent_id = $(this).attr("data-id");
  var rows = "";
  $.ajax({
    method: "POST",
    url: "/manage/getParentDetails",
    data: { parentId: parent_id },
    success: function (data) {
      data = JSON.parse(data);
      
      $("#modal-parent-name").text(
        data["message"].firstname + " " + data["message"].lastname
      );

      $("#modal-parent-email").text(data["message"].email);
      $("#modal-parent-email").attr("href", "mailto:" + data["message"].email);
      $("#modal-parent-phone").text(data["message"].phonenumber);
      $("#modal-parent-address").text(data["message"].address);
      $("#manage-parent-code").text(data["message"].code);
      $("#parent-qrcode").attr(
        "src",
        "/assets/images/" + data["message"].phonenumber + ".jpeg"
      );

      data["children"].forEach((child, index) => {
        rows +=
          "<li>" +
          child["firstname"] +
          " " +
          child["lastname"] +
          " (" +
          calculateAge(child["Date_of_birth"]) +
          " ) - " +
          child["child_class"] +
          "</li>";
      });
      var active = data["message"].Active
      if(active ==='0')
      {
       document.querySelector('#deactivate-act').innerHTML ='Activate';
       document.querySelector('#deactivate-act').style.background = 'green';
      }
      else
      {
        document.querySelector('#deactivate-act').innerHTML ='Deactivate';
        document.querySelector('#deactivate-act').style.background = 'red';
      }


      $("#man_respcat").val(data["responsibleperson"].persontype);
      $("#man_respfn").val(data["responsibleperson"].fullname);
      $("#man_respem").val(data["responsibleperson"].email);
      $("#man_respph").val(data["responsibleperson"].phonenumber);

      $(".children-list").html(rows);
      $("#parent-details").modal("show");
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
});



$("#fetch-parent-details").click(function(){
 
  var code = $("#fetch-code").val();
  var email = $("#fetch-email").val();
  if (code === "" || email === "")
  {
    
    window.alert("Please fill all information correctly");
    return;
  }
  var x = document.getElementById('parent-login');
  $.ajax({
    method: "POST",
    url: "/registration/getParentKidRespDetails",
    data: {parentId: code, parentemail: email},
    success: function (data){
      data= JSON.parse(data);
      console.log(data);
      if (data.status === 1){
      $("#ret-parent-name").text(
        data["message"].firstname+" " + data["message"].lastname
      );
      $("#ret-parent-email").attr("href", "mailto:" + data["message"].email);
      $("#ret-parent-phone").text(data["message"].phonenumber);
      $("#ret-parent-email").text(data["message"].email);
      $("#ret-parent-code").text(data["message"].code);
      $("#ret-parent-Address").text(data["message"].address); 
      

      $("#res-person-id").text(data["responsibleperson"].id);
      $("#reg-id").text(data["message"].regid);
      $("#parent-id").text(data["message"].id);
      
      $("#ret-gensend-code").attr("data-id", "" + data["message"].id);
      if ((data ["responsibleperson"].persontype)==="parent"){
        $("#man_respcat [value='0']").attr("selected","selected");
        $("#man_respfn").hide();
        $("#man_respem").hide(); 
        $("#man_respph").hide();

      }
      else if ((data ["responsibleperson"].persontype)==="relative"){
         $("#man_respcat [value='2']").attr("selected","selected");
      
      }
      else {
        $("#man_respcat [value='1']").attr("selected","selected");
      }
      $("#man_respfn").val(data["responsibleperson"].fullname);
      $("#man_respem").val(data["responsibleperson"].email);
      $("#man_respph").val(data["responsibleperson"].phonenumber);
      $("#res-person-id").val(data["responsibleperson"].id);
      $("#parent-details-1").hide();
      $("#parent-details-main").show();
      var html=""; var sn= 0;

      data["children"].forEach((child, index) => {
        sn++;
        var name = child["firstname"] + " " +child["lastname"];
        var button =" <button class='=reg-button delete-child' style='padding: 0px 5px;' onClick='DeleteChild(\""+child["id"]+"\")'> Delete </button>";
        html = html + "<tr><td>"+ sn +"</td><td>"+ name +"</td><td>"+child["Date_of_birth"]+"</td><td>"+button+"</td></tr>";
        
      });

      $("#retkidbody-table").html(html);
      x.style.display = "none";
      $("#parent-details-2").show();
      $("#returning-drop-off-panel").hide();
     

      document.querySelector('#returning-drop-off').style.visibility = '';
      document.querySelector('#log-out').style.visibility ='' ; 
    }
    else{
      window.alert(data.message);
    }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
});

$("#ret-back").click(function () {
  $("#parent-details-1").show();
  $("#parent-details-2").hide();
});

$("#responsible-party").change(function () {
  var selected = $(this).val();
  if (selected == 0) {
    $("#resp-text").text(
      "Registered parent will be in charge of dropping off and picking up"
    );
    $("#resp-a-child").hide();
    $("#resp-other").hide();
  } else if (selected == 1) {
    var firsts = document.getElementsByName("cfirstname[]");
    var lasts = document.getElementsByName("clastname[]");
    var names = "",
      check_names = "";

    for (var count = 0; count < firsts.length; count++) {
      check_names += firsts[count].value + "" + lasts[count].value;
      names +=
        "<option value=abc>" +
        firsts[count].value +
        " " +
        lasts[count].value +
        "</option>";
    }

    if (check_names) {
      $("#resp-kid").html(names);

      $("#resp-text").text(
        "One of the registered kids will be in charge of dropping off and picking up"
      );
      $("#resp-a-child").show();
      $("#resp-other").hide();
    } else {
      alert("No kids added");
    }
  } else if (selected == 2) {
    $("#resp-text").text(
      "Register someone else who will be in charge of dropping off and picking up the kids"
    );
    $("#resp-a-child").hide();
    $("#resp-other").show();
  }
});


$("#deactivate-act").click(function () {
  var text = document.querySelector('#deactivate-act').innerHTML;
  if (text === "Activate")
  {
    var phonenumber = $("#modal-parent-phone").text();
  var email = $("#modal-parent-email").text();
  const active = 1;
  $.ajax({
    method: "POST",
    url: "/registration/deactivateaccount",
    data: { phonenumber: phonenumber, email: email, active: active},
    success: function (data) {
      data = JSON.parse(data);
      window.alert("Account Successfully Activated ");
      document.querySelector('#deactivate-act').innerHTML ='Deactivate';
      document.querySelector('#deactivate-act').style.background = 'red';
    },
    error: function (xhr, error) {
      console.error(xhr);
    },
  });
  } 
  else
  {
    var phonenumber = $("#modal-parent-phone").text();
    var email = $("#modal-parent-email").text();
    const active = 0;
    $.ajax({
      method: "POST",
      url: "/registration/deactivateaccount",
      data: { phonenumber: phonenumber, email: email, active: active },
      success: function (data) {
        data = JSON.parse(data);
        window.alert("Account Successfully Deactivated");
        document.querySelector('#deactivate-act').innerHTML ='Activate';
        document.querySelector('#deactivate-act').style.background = 'green';
      },
      error: function (xhr, error) {
        console.error(xhr);
      },
    });
  }  
});



$("#man_respcat").change(function () {
  var selected = $(this).val();
  if (selected === "2") {
    document.getElementById("man_respfn").value="";
    document.getElementById("man_respem").value="";
    document.getElementById("man_respph").value="";
    $("#man_respfn").show();
    $("#man_respem").show(); 
    $("#man_respph").show();
    document.querySelector('#update_details').style.visibility="";
  
    }
    if (selected === "1"){
      document.getElementById("man_respfn").value="";
      $("#man_respfn").show();
      $("#man_respem").hide(); 
      $("#man_respph").hide();
      document.querySelector('#update_details').style.visibility="";
    }
    if(selected == "0"){
      $("#man_respfn").hide();
      $("#man_respem").hide(); 
      $("#man_respph").hide();
      document.querySelector('#update_details').style.visibility="";
     
    }
});

$("#drop-off").click(function () {
  fetchKids();
});

$("#add_kid").click(function(){
$("#add_Kidoption").show();
$("#add_Kidtext").show();
document.querySelector('#register_kid').style.visibility="";
});


$("#returning-drop-off").click(function () {
  var code = $("#fetch-code").val();
  var email = $("#fetch-email").val();
  var x = document.getElementById('returning-drop-off-panel');
  $.ajax({
    method: "POST",
    url: "/registration/getParentKidRespDetails",
    data: {parentId: code, parentemail: email},
    success: function (data){
      data= JSON.parse(data);

      console.log(data);

      var html=""; var sn= 0;
      data["children"].forEach((child, index) => {
        sn++;
        var name = child["firstname"] + " " +child["lastname"];
       var checkbox ="<input type='checkbox' name='checkbox_name' value='Yes'/>" ; 
  
        html = html + "<tr><td>"+ sn +"</td><td>"+ name +"</td><td>"+child["Date_of_birth"]+"</td><td>"+checkbox+"</td></tr>";
      });

      
      	$("#dropoffkidbody-table").html(html);
     	  x.style.display = "none";
     	  $("#parent-details-2").hide();
    	  document.querySelector("#pd-header").style.visibility="hidden"
      	$("#returning-drop-off-panel").show();
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    },
  });
  

  
});

$("#update_details").click(function () {
  var persontype = "";
  var fullname = "-";
  var email = "-";
  var phoneno = "-"; 
  var id = $("#res-person-id").val();
  var selected = $("#man_respcat").val();
  if (selected === "2") {
    persontype = "relative";
    fullname = $("#man_respfn").val();
    email = $("#man_respem").val();
    phoneno = $("#man_respph").val();
  }
  else if (selected === "1") {
    persontype = "child";
    fullname = $("#man_respfn").val(); 
  }

  if (selected === "0") {
    persontype = "parent";
    fullname = $("#ret-parent-name").val();
    email = $("#ret-parent-email").val();
    phoneno = $("#ret-parent-phone").val();
  }
  var x = document.getElementById('returning-manage-panel');
  $.ajax({
    method: "POST",
    url: "/registration/updaterepperson",
    data: {personType: persontype, Fullname: fullname, Email: email, Phoneno: phoneno, Id: id},
    success: function (data){
      data= JSON.parse(data);
      console.log(data);
      window.alert("Successfully Updated");

  },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
});

$("#register_kid").click(function () {
  var select = document.getElementById('num-of-kids-returning');
  var value = select.options[select.selectedIndex].value;
  var count = value;
  var firstname = document.querySelectorAll("input[name=cfirstname]");
  var lastname = document.querySelectorAll("input[name=clastname]");
  var Date_of_birth = document.querySelectorAll("input[name=dob]");
  var child_class =  document.querySelectorAll("select[name=cclass]");
  var message ="";

  var id = $("#parent-id").text();
  var regid =$("#reg-id").text();

  for( i = 0; i < count ; i++){
    var singlename = firstname[i].value;
    var singlelastname =lastname[i].value;
    var singledob = Date_of_birth[i].value;
    var singlechildclass = child_class[i].value;
    $.ajax({
      method: "POST",
      url: "/registration/updateregisteredkid",
      data: {cclass:singlechildclass, dob:singledob, cfirstname:singlename, clastname:singlelastname,  regid:regid, Id: id, parentid:id },
      success: function(data){
        data=JSON.parse(data);
        window.alert("Successfully Registered");
        
      },
        error: function(xhr, status, error){
          console.log(error);
        }
  
    })

  }
  $("#add_Kidoption").hide();
  $("#add_Kidtext").hide();
  $("#register_kid").hide();
});
 
 
 

function DeleteChild  (id) {
  var childId = id;
  $.ajax({
    method:"POST",
    url: "/registration/deletekid",
    data: {Id:childId},
    success: function(data){
      data=JSON.parse(data);
      console.log(data);
      window.alert("Successfully Deleted");
    },
    error:function(xhr, status, error){
      console.log(error);
    }
  })
}


$("#num-of-kids-returning").change(function () {
  var amount = $(this).val();
  var firstnames = "<label>First name:</label><br />";
  var lastnames = "<label>Last name:</label><br />";
  var dobs = "<label>D.O.B:</label><br />";
  var classes = "<label>Class:</label><br />";
  for (var count = 1; count <= amount; count++) {
    firstnames +=
      '<input name="cfirstname" type="text" placeholder="Kid\'s first name" required /><br />';
    lastnames +=
      '<input name="clastname" type="text" placeholder="Kid\'s last name" required /><br />';
    dobs +=
      '<input name="dob" type="date" placeholder="Kid\'s date of birth" required /><br />';
    // classes += '<input name="cclass[]" type="text" placeholder="Kid\'s class" required /><br />'
    classes +=
      '<select name="cclass">' +
      "<option>Toddler</option>" +
      "<option>5-6 years</option>" +
      "<option>7-8 years</option>" +
      "<option>9-12 years</option>" +
      "<option>Nannies</option>" +
      "</select><br />";
  }
  $("#kid-first-names").html(firstnames);
  $("#kid-last-names").html(lastnames);
  $("#kid-dobs").html(dobs);
  $("#kid-classes").html(classes);
});




