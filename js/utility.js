
function checkPassword()
{
    var pw1 = $("#inputpassword").val();
    var pw2 = $("#inputpasswordconfirm").val();
    if (pw1 === pw2) 
    {
        return true;
    }
    else
    {
        alert("Passwords mismatch");
        return false;
    }
}