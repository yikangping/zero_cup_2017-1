function search_usr()
{
    if($("#username").val()=="")
    {
        $("#password").hide("300");
        $("#submit").hide("300");
        return;
    }
    $.post(
        "php/login.php",
        {username:$("#username").val(),},
        function(success){
            if(success){
                $("#password").attr("placeholder","输入密码以登录");
                $("#submit").text("登录");
				$("#submit").attr("onclick","signup();");
            }else{
                $("#password").attr("placeholder","输入密码以注册");
                $("#submit").text("注册");
				$("#submit").attr("onclick","signin();");
            }
            $("#password").show("300");
            $("#submit").show("300");
        }
    );
}
function signup()
{
    if($("#password").val()==""){
        alert("输入密码");
        return;
    }
    $.post(
        "php/login.php?pwd=1",
        {
            username:$("#username").val(),
            password:$("#password").val(),
        },
        function(success){
            if(success)
                window.location.href="index.php";
            else alert("密码错误");
        }
    );
}
function signin()
{
    if($("#password").val()==""){
        alert("输入密码");
        return;
    }
    $.post(
        "php/login.php?pwd=2",
        {
            username:$("#username").val(),
            password:$("#password").val(),
        },
        function(success){
            if(success)
                window.location.href="index.php";
        }
    );
}