function init()
{
    var i=1;
    while($("#part"+String(i)).length>0)
    {
        $("#part"+String(i)).show(300);
        $("#response"+String(i)).hide(300);
        $("#article"+String(i)).attr("onclick","detail("+String(i)+")");
        i++;
    }$("#response").hide(300);
}
function detail(now){
    var i=1;
    while($("#part"+String(i)).length>0)
    {
        if(i!=now)$("#part"+String(i)).hide(300);
        i++;
    }
    $("#response"+String(now)).show(300);
    $("#response").show(300);
    $("#relresponse").attr("onclick","relresponse("+String(now)+")");
    $("#article"+String(now)).attr("onclick","detail_back("+String(now)+")");
}
function detail_back(now)
{
    var i=1;
    while($("#part"+String(i)).length>0)
    {
        if($("#part"+String(i)).attr("name")==$("#username").attr("value")||$("#username").attr("value")=="")
            $("#part"+String(i)).show(300);
        i++;
    }$("#response"+String(now)).hide(300);
    $("#response").hide(300);
    $("#article"+String(now)).attr("onclick","detail("+String(now)+")");
}
function get_article(username)
{
    $("#username").attr("value",String(username));
    var i=1;
    while($("#part"+String(i)).length>0)
    {
        $("#article"+String(i)).attr("onclick","detail("+String(i)+")");
        $("#response"+String(i)).hide(300);
        if($("#part"+String(i)).attr("name")==$("#username").attr("value")||$("#username").attr("value")=="")
            $("#part"+String(i)).show(300);
        else $("#part"+String(i)).hide(300);
        i++;
    }$("#response").hide(300);
}
function relarticle()
{
    if($("#reltitle").val()==""||$("#relcontent").val()=="")return;
    $.post(
        "php/relarticle.php",
        {
            title:$("#reltitle").val(),
            content:$("#relcontent").val(),
        },
        function(data)
        {
            $("#relessay").after(data);
            init();
        }
    );
}
function relresponse(now)
{
    $.post(
        "php/relresponse.php",
        {
            content:$("#rescontent").val(),
            articleid:now,
        },
        function(data)
        {
            $("#response"+String(now)).append(data);
        }
    );
}
function checkin(now)
{
    $.post(
        "php/checkin.php",
        {},
        function(days)
        {
            $("#checkin").text(days);
            $("#checkin").attr("onclick","");
        }
    );
}