// Javascript function process Ajax client requests according to project ID
function processAjaxRequest(js_project_id)
{
    var tmp_js_project_id = js_project_id.split('_');
    js_project_id = tmp_js_project_id[1];

    if (js_project_id.length == 0)
    { 
        document.getElementById("ajaxResponseContainer" + js_project_id).innerHTML = "";
        return;
    } 
    else 
    {
        var $btnStartStop = $(this).button('loading');   
        
        var xmlhttpPROJECT = new XMLHttpRequest();
        xmlhttpPROJECT.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {       
                var objArrayPROJECT = JSON.parse(this.responseText);
                document.getElementById("ajaxResponseTotalProjectTimeContainer" + js_project_id).innerHTML = objArrayPROJECT[0].total_time_diff_text;

                var xmlhttpTimeRecords = new XMLHttpRequest();
                xmlhttpTimeRecords.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        var objArray = JSON.parse(this.responseText);
                        var outputHtml = "";
                        for(var i = 0; i < objArray.length; i++)
                        {
                            outputHtml += ('<span class="tiny-font">' + objArray[i].starting_time_stamp + ' - ' + objArray[i].ending_time_stamp + ' = ' + objArray[i].time_diff_text + '</span><br>');
                        }

                        document.getElementById("ajaxResponseContainer" + js_project_id).innerHTML = outputHtml;
                        
                        var button_value = "";
                        var button_css   = "";
                        
                        if(document.getElementById("btnAjax_" + js_project_id).value.charAt(2) == "a") // "Start working" we check 3rd char to be a or o
                        {
                            button_value = "Stop working";
                            button_css = "btn btn-danger";
                        }
                        else
                        {
                            button_value = "Start working";
                            button_css = "btn btn-success"; 
                        }
                        
                        document.getElementById("btnAjax_" + js_project_id).value = button_value;
                        document.getElementById("btnAjax_" + js_project_id).className = button_css;
                        
                        drawChart();
                    }
                };

                xmlhttpTimeRecords.open("GET", "restfulapi/getjson.php/getProjectTimeRecords/" + js_project_id, true);
                xmlhttpTimeRecords.send();
            }
        }
        
        xmlhttpPROJECT.open("GET", "restfulapi/performaction.php/manageProjectTimeRecord/" + js_project_id, true);
        xmlhttpPROJECT.send();
                
                
       $btnStartStop.button('reset');        
    }
}

// Javascript function Add new project to Database with onClick of button
function processAjaxRequestAddNewProject(newProjectTitle)
{
    if (newProjectTitle.length == 0)
    {
        return;
    } 
    else 
    {
        var xmlhttpAddProject= new XMLHttpRequest();
        xmlhttpAddProject.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {       
                var objArrayResult = JSON.parse(this.responseText);
                document.getElementById("save-result").innerHTML = objArrayResult[0].message;
            }
        }
        
       xmlhttpAddProject.open("GET", "restfulapi/performaction.php/addNewProject/" + newProjectTitle, true);
       xmlhttpAddProject.send();  
    }
}
