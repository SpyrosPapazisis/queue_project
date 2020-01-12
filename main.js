
function display(id) {

    //Determines which block is going to be appeared
    if(id == 'citizen'){
        document.getElementById('citizen').parentElement.classList.add('checkedClass');
        document.getElementById('organisation').parentElement.classList.remove('checkedClass');
        document.getElementById('anonymous').parentElement.classList.remove('checkedClass');
        document.getElementById('organisation_form').classList.add('displaynone');
        document.getElementById('citizen_form').classList.remove('displaynone');
    }else if(id == 'organisation'){
        document.getElementById('organisation').parentElement.classList.add('checkedClass');
        document.getElementById('citizen').parentElement.classList.remove('checkedClass');
        document.getElementById('anonymous').parentElement.classList.remove('checkedClass');
        document.getElementById('citizen_form').classList.add('displaynone');
        document.getElementById('organisation_form').classList.remove('displaynone');
    }else {
        document.getElementById('anonymous').parentElement.classList.add('checkedClass');
        document.getElementById('citizen').parentElement.classList.remove('checkedClass');
        document.getElementById('organisation').parentElement.classList.remove('checkedClass');
        document.getElementById('citizen_form').classList.add('displaynone');
        document.getElementById('organisation_form').classList.add('displaynone');
    }
}

//------------------------ SEND FUNCTION ------------------------// 
//function to send the data from the html page to the database via Ajax Request
function sender() {
    
    event.preventDefault();

    var service = document.getElementById('service').value;

    if(service == ''){
        alert("Please choose a service!");
        return;
    }

    //Retreives the data from the form 
    if(document.getElementById('citizen').checked) {

        var type = 'Citizen';
        var title = document.getElementById('title').value;
        var first_name = document.getElementById('first_name').value;
        first_name = first_name.charAt(0).toUpperCase() + first_name.substring(1);
        var last_name = document.getElementById('last_name').value;
        last_name = last_name.charAt(0).toUpperCase() + last_name.substring(1);
        var name = title + ' ' + first_name + ' ' + last_name;

        var data = "service="+service+"&type="+type+"&name="+name;

    }else if(document.getElementById('organisation').checked) {

        var type = 'Organisation';
        var name = document.getElementById('name').value;

        var splitStr = name.split(' ');
        for(var i = 0; i < splitStr.length; i++) {
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
        }

        name = splitStr.join(' ');

        var data = "service="+service+"&type="+type+"&name="+name;
    }else {

        var type = 'Anonymous';

        var data = "service="+service+"&type="+type;
        
    }
    console.log(data);
    //AJAX Request
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
       
        if(xhr.readyState == 4 && xhr.status == 200) {
            dataId = JSON.parse(xhr.responseText);
            console.log(dataId);

            var date = new Date();
            h = (date.getHours() < 10 ? '0' : '') + date.getHours();
            m = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
            var time = h + ':' + m;

            i = document.getElementById("queue_list").childElementCount + 1;

            var tr = document.createElement("tr");
            // ----- NUMBER ------ //
            var th_num = document.createElement("td");
            th_num.innerHTML = i;
            tr.appendChild(th_num);
            // ----- TYPE ------ //
            var th_type = document.createElement("td");
            th_type.innerHTML = type;
            tr.appendChild(th_type);

            var th_name = document.createElement("td");
            if(type != 'Anonymous'){
                th_name.innerHTML = name;
            }else{
                th_name.innerHTML = type;
            }
            tr.appendChild(th_name);

            var th_service = document.createElement("td");
            th_service.innerHTML = service;
            tr.appendChild(th_service);

            var th_time = document.createElement("td");
            th_time.className += 'text-center';
            th_time.innerHTML = time;
            tr.appendChild(th_time);

            var th_delete = document.createElement("td");
            th_delete.innerHTML = "<a href='#' onclick='delete_record("+dataId.id+")'>Delete</a>";
            tr.appendChild(th_delete);

            tr.setAttribute("id", dataId.id);

            document.getElementById("queue_list").appendChild(tr);
        }
    }

    xhr.open('POST', 'http://localhost/queue/insert.php', true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send(data);

    //Reseting the form
    document.getElementById("myForm").reset();
    document.getElementById(type.toLowerCase()).checked = true;
    display(type.toLowerCase())
}


//------------------------ SELECT FUNCTION ------------------------// 

function select() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        
        if(xhr.readyState == 4 && xhr.status == 200) {
            data = JSON.parse(xhr.responseText);
            console.log(data);

            var i = 1;
            data.forEach(customer => {

                var date = new Date(customer.queued_time);
                
                var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
                var hour = (date.getHours() < 10 ? '0' : '') + date.getHours();
                var time = hour + ':' + minutes;


                var tr = document.createElement("tr");

                var th_num = document.createElement("td");
                th_num.innerHTML = i;
                tr.appendChild(th_num);

                var th_type = document.createElement("td");
                th_type.innerHTML = customer.type;
                tr.appendChild(th_type);

                var th_name = document.createElement("td");
                th_name.innerHTML = customer.name;
                tr.appendChild(th_name);

                var th_service = document.createElement("td");
                th_service.innerHTML = customer.service;
                tr.appendChild(th_service);

                var th_time = document.createElement("td");
                th_time.innerHTML = time;
                th_time.className += 'text-center';
                tr.appendChild(th_time);

                var th_delete = document.createElement("td");
                th_delete.innerHTML = "<a href='#' onclick='delete_record("+customer.id+")'>Delete</a>";
                tr.appendChild(th_delete);                

                tr.setAttribute("id", customer.id);
                
                document.getElementById("queue_list").appendChild(tr);
                i++;
            });
        }
    }

    xhr.open('GET', 'http://localhost/queue/select.php', true);

    xhr.send();

}

//------------------------ DELETE FUNCTION ------------------------// 

function delete_record(id) {
    console.log(id);

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        
        if(xhr.readyState == 4 && xhr.status == 200) {
            data = xhr.responseText;
            console.log(data);

            var tr = document.getElementById(id);

            var table = document.getElementById("queue_list");
            
            tr.remove();
            console.log(table.childNodes.length);

            //remaining_tags = table.childNodes.length;
            for(i=1; i<table.childNodes.length; i++) {
                table.childNodes[i].childNodes[0].innerHTML = i;
            }
            console.log(table.childNodes[1].childNodes[0].innerHTML);
                        

        }
    }
    xhr.open('POST', 'http://localhost/queue/delete.php', true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send("id="+id);

}

select();