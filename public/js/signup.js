function validform() {

    var a = document.forms["my-form"]["name"].value;
    var b = document.forms["my-form"]["surname"].value;
    var c = document.forms["my-form"]["email"].value;    
    var d = document.forms["my-form"]["address"].value;
    var e = document.forms["my-form"]["city"].value;
    var f = document.forms["my-form"]["zip"].value;
    var g = document.forms["my-form"]["phone"].value;
    var h = document.forms["my-form"]["vatnumber"].value;

    if (a==null || a=="")
    {
        alert("Please Enter Your Name");
        return false;
    }else if (b==null || b=="")
    {
        alert("Please Enter Your Surname");
        return false;
    }else if (c==null || c=="")
    {
        alert("Please Enter Your Email Address");
        return false;
    }else if (d==null || d=="")
    {
        alert("Please Enter Your address");
        return false;
    }else if (e==null || e=="")
    {
        alert("Please Enter Your City");
        return false;
    }
    else if (f==null || f=="")
    {
        alert("Please Enter Your Zip");
        return false;
    }
    else if (g==null || g=="")
    {
        alert("Please Enter Your Phone");
        return false;
    }
    else if (h==null || h=="")
    {
        alert("Please Enter Your vatnumber");
        return false;
    }

}