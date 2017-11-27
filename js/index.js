function init()
{
    var i=1;
    while($("#part"+String(i)).length>0)
    {
        $("#part"+String(i)).show(300);
        $("#response"+String(i)).hide(300);
        $("#article"+String(i)).attr("onclick","detail("+String(i)+")");
        i++;
    }$("#relresponse").hide(300);
}
function detail(now){
    var i=1;
    while($("#part"+String(i)).length>0)
    {
        if(i!=now)$("#part"+String(i)).hide(300);
        i++;
    }
    $("#response"+String(now)).show(300);
    $("#relresponse").show(300);
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
    $("#relresponse").hide(300);
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
    }$("#relresponse").hide(300);
}
function relarticle()
{
    $.post(
        "php/rel.php?rel=article",
        {
            title:$("#reltitle").val(),
            content:$("#relcontent").val(),
        },
        function(data)
        {
            alert(data);
            $("#relessay").after(data);
            init();
        }
    );
}