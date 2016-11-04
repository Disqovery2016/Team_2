$(document).ready(function()
{

    $("button[name=submit]").click(function(event)
    {
      var sp4 = $("input[name=email]").val();
      var sp5 = $("input[name=pwd]").val();
      if($.trim(sp4).length < 5|| $.trim(sp4).length >45 )
      {
        event.preventDefault();
       $("#message").text("Characters lengths are allowed between 5 and 45!").css("color","red").css("font-size","16px").show();
       }
      else if(!(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/gm.test(sp4)))
      {
         event.preventDefault();
       $("#message").text("Invalid email!").css("color","red").css("font-size","16px").show();
      }
      if($.trim(sp5).length < 5|| $.trim(sp5).length >25 )
      {
        event.preventDefault();
        $("#message").text("Characters lengths are allowed between 5 and 25!").css("color","red").css("font-size","16px").show();
        }
      else if(!(/[a-z]+/gm.test(sp5))||!(/[A-Z]+/gm.test(sp5))||!(/[0-9]+/gm.test(sp5)))
      {
         event.preventDefault();
       $("#message").text("Atleast one Lowercase,one Uppercase and one Number is required!").css("color","red").css("font-size","16px").show();
       }
       if($.trim(sp4).length >= 5 && $.trim(sp4).length <= 45 && (/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/gm.test(sp4))=== true && $.trim(sp5).length >= 5 && $.trim(sp5).length <= 25 && (/[a-z]+/gm.test(sp5)) === true && (/[A-Z]+/gm.test(sp5))===true && (/[0-9]+/gm.test(sp5))===true )
      {
        $(this).prop("disabled", true);
        var xmlhttp;
    if(window.XMLHttpRequest)
     {
       xmlhttp=new XMLHttpRequest();//for mordern browsers
     }
    else
     {
       xmlhttp =new ActiveXObject ('Microsoft.XMLHTTP');//for old browsers
     }
     xmlhttp.onreadystatechange = function()//checking for a state change
     {
       if(xmlhttp.readyState==4 && xmlhttp.status == 200)//weather file is empty or not
        {

          if(xmlhttp.responseText==="l321@")
          {
            window.location.replace("dashboard.php");
          }
          else
          {
          $("div#message").text(xmlhttp.responseText).css('color','red');
          $("button[name=submit]").prop("disabled", false);
          }
        }
     };
     xmlhttp.open('POST','login.php',true);
     xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
     xmlhttp.send('submit=submit&email='+sp4+'&pwd='+sp5);
     }
    });

});