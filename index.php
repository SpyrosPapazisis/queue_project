
<?php

include 'connect.php';

$conn = OpenCon();

?>

<html>

    
    <head>
        <title>Queue App</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="main.js"></script>
    </head>
    
    <body>
        <div class="p-4 main-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <p class="">Queue Application</p>
                </div>
            </div>
            <div class="text-center">
                <img src="https://springmediastrategies.com/wp-content/uploads/2018/12/facebook-icon-white-logo-png-transparent-e1548296645113.png" alt="">
                <img src="https://image.flaticon.com/icons/svg/124/124021.svg" alt="">
                <img src="https://news.artnet.com/app/news-upload/2018/09/2000px-Instagram_logo_2016.svg_-1024x1024.png" alt="">
            </div>
        </div>
        <div class="p-2"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                <h4 class="textColour">New Customer</h4>
                    <form id="myForm" class="ml-1" action="" onsubmit="sender()">
                        <div class="">
                            <label class="my-1 textColour" for="service">Services</label>
                            <select class="custom-select my-2" name="service" id="service">
                                <option value="" disabled selected>Choose...</option>
                                <option value="Housing">Housing</option>
                                <option value="Benefits">Benefits</option>
                                <option value="Council Tax">Council Tax</option>
                                <option value="Fly-tipping">Fly-tipping</option>
                                <option value="Missed Bin">Missed Bin</option>
                            </select>
                        </div>
                        <div class="container text-center">
                            <div class="my-2 btn-group-toggle switch-field" data-toggle="buttons">
                                <label class="btn buttonColours checkedClass buttonShadow">
                                    <input type="radio" name="type" id="citizen" onclick="if (this.checked) {display(id='citizen')}" value='citizen' > Citizen
                                </label>
                                <label class="btn buttonColours buttonShadow">
                                    <input type="radio" name="type" id="organisation" onclick="if (this.checked) {display(id='organisation')}" value='organisation' checked> Organisation
                                </label>
                                <label class="btn buttonColours buttonShadow">
                                    <input type="radio" name="type" id="anonymous" onclick="if (this.checked) {display(id='anonymous')}" value='anonymous'> Anonymous
                                </label>
                            </div>
                        </div>
                        <div id="citizen_form">    
                            <label class="my-1 textColour" for="title">Title</label>
                            <select class="custom-select my-2" name="title" id="title">
                                <option disabled selected>Choose...</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                            </select>
                            <label class="my-1 textColour" for="first_name">First Name</label>
                            <input class="form-control my-2" type="text" id="first_name" name="first_name">
                            <label class="my-1 textColour" for="last_name">Last Name</label>
                            <input class="form-control my-2" type="text" id="last_name" name="last_name">
                        </div>
                        <div id="organisation_form" class="displaynone">
                            <label class="my-1" for="name">Name</label>
                            <input class="form-control my-2" type="text" id="name" name="name">
                        </div>
                        <input type="submit" class="btn buttonColours buttonShadow">    
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 border-left">
                    <h4 class="textColour">Queue</h4> 
                    <p></p>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Queued at</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="queue_list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

</html>


<style>

body {
    height: 100%;
    width: 100%;
    background-color: #F6FFF8;
    
}

.displaynone {
    display: none;
}

.checkedClass {
    background-color: #A19FC5 !important;
    border-color: #A19FC5 !important;
}

.main-header {
    background-color: #A19FC5;
    /*border-radius: 0 0 20px 20px;*/
    color: #FFFFFF;
    font-size: 3em;
    font-weight: 600;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.buttonShadow {
  box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2)

}

.buttonColours {
    color: #fff;
    background-color: #C7AFD1;
    border-color: #C7AFD1
}
.buttonColours:hover {
  background-color: #B1AFD8;
  border-color: #B1AFD8;
  color: #fff;
}
tr:hover {
  background-color: rgba(199,175,209,0.25);
  border-color: #BAA791;
  color: #000;
}

.textColour {
    color: #887A6A;
    text-shadow: 0px 3px 6px rgba(0,0,0,0.2);
}

img {
    margin: 5px;
    width: 35px;
    height: 35px;
    border-radius: 20%;
    filter: grayscale(100%);
    transition: border-radius 0.5s, transform 0.5s, filter 0.5s;
    transition-timing-function: ease-in-out;
}

img:hover {
  transform: rotate(360deg);
  border-radius: 100%;
  filter: grayscale(0%);
}

</style>