function processAjaxRequest(js_project_id,js_action)
{
    var tmp_js_project_id = js_project_id.split('_');
    js_project_id = tmp_js_project_id[1];

    if (js_project_id.length == 0)
    { 
        document.getElementById("txtHint" + js_project_id).innerHTML = "";
        return;
    } 
    else 
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                var objArray = JSON.parse(this.responseText);
                var outputHtml = "";
                for(var i = 0; i < objArray.length; i++)
                {
                    outputHtml += ('<span class="label label-info">' + objArray[i].Starting_Time_Stamp + ' - ' + objArray[i].End_Time_Stamps + '</span><br>');
                }

                document.getElementById("txtHint" + js_project_id).innerHTML = outputHtml;

                if(document.getElementById("btnAjax_" + js_project_id).value == "Start working")
                {
                    document.getElementById("btnAjax_" + js_project_id).value = "Stop working";
                    document.getElementById("btnAjax_" + js_project_id).className = "btn btn-danger";
                }
                else
                {
                    document.getElementById("btnAjax_" + js_project_id).value = "Start working";
                    document.getElementById("btnAjax_" + js_project_id).className = "btn btn-success"; 
                }
            }
        };

        xmlhttp.open("GET", "restfulapi/getjson.php/getProjectTimeRecords/" + js_project_id, true);
        xmlhttp.send();
    }
}
