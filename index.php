<!DOCTYPE HTML>
<html lang="en" style="height:100%;">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--Theme
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
--Chart.js-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

<Title>Documentation</Title>
</head>
<body style="height:100%;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="#">Countries</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            
          </ul>
        </div>
    </nav>
    
    <div class="container">
        <div class="row justify-content-center" style="margin-top:10px;">
            <form class="col-10">
                <h2>See all countries</h2>
                <lable for="divideBy" style="margin-top:10px;">Chart Type:</lable>
                <select id="divideBy" class="form-control">
                    <option value="1">Years | Then to 2020</option>
                    <option value="13">Dog | 13 years</option>
                    <option value="16">Cat | 16 years</option>
                    <option value="60">Elephant | 60 years</option>
                    <option value="90">Blue Whale | 90 years</option>
                    <option value="100">Human | 100 years</option>
                    <option value="500">Redwood Tree | 500 years</option>
                  </select>
                <lable for="sort">Order By:</lable>
                <select id="sort" class="form-control">
                    <option value="country ASC">Countries Ascending</option>
                    <option value="country DESC">Countries Descending</option>
                    <option value="foundedYear ASC">Age Ascending</option>
                    <option value="foundedYear DESC">Age Descending</option>
                </select>
                <button id="goBtn" type="button" class="btn btn-primary" style="margin-top:10px;">Show Chart</button>
            </form>
            <form class="col-10">
                <h2>How many countries were founded in your lifetime?</h2>
                <lable for="divideBy" style="margin-top:10px;">Chart Type</lable>
                <lable for="sort">Year you were born:</lable>
                <input type="text" id="birthYear" class="form-control" placeholder="1961">
                <lable for="sortBy">Order By:</lable>
                <select id="sortBy" class="form-control">
                    <option value="country ASC">Countries Ascending</option>
                    <option value="country DESC">Countries Descending</option>
                    <option value="foundedYear ASC">Age Ascending</option>
                    <option value="foundedYear DESC">Age Descending</option>
                </select>
                <button id="goBtn1" type="button" class="btn btn-primary" style="margin-top:10px;">Show Chart</button>
            </form>
        </div>
        <div class="chart-container" style="width:300;height:22000;">
            <canvas id="myChart" style="display: block;"></canvas>
        </div>
        <script>
            function displayChart (divider, sort, year) {
                var lableName;
                
                $.get("getFounded.php", { order: sort, birthYear: year }, function (data) {
                    countryData = $.parseJSON(data);
                     //votes = $.parseJSON(votes);
                     
                     if (divider === '100'){
                         lableName="Human Lifetime";
                     }
                     else if(divider === '13'){
                         lableName = "Dog Lifetime";
                     }
                     else if(divider === '16'){
                         lableName = "Cat Lifetime";
                     }
                     else if(divider === '60'){
                         lableName = "Elephant Lifetime";
                     }
                     else if(divider === '90'){
                         lableName = "Blue Whale Lifetime";
                     }
                     else if(divider === '500'){
                         lableName = "Redwood Tree Lifetime";
                     }
                     else{
                         divider = 1;
                         lableName = "Years Ago";
                     }
                     var name=[];
                     var info=[];
                     var countryCount=0;
                     for(i in countryData[0]){
                         name.push(countryData[0][i]);
                         countryCount++;
                     }
                     for(i in countryData[1]){
                         info.push((2020-countryData[1][i])/divider);
                     }
                     var graphType;
                     if(countryCount<15){
                         graphType = 'bar';
                         $('#myChart').height = 600;
                     }
                     else{
                         graphType = 'horizontalBar';
                     }

                     var ctx = document.getElementById('myChart').getContext('2d');
                     var myChart = new Chart(ctx, {
                         type: graphType,
                         data: {
                           labels: name,
                           datasets: [
                             {
                               label: lableName,
                               data: info,
                               backgroundColor: "rgba(61, 149, 204, .4",

                               borderWidth: 10
                             }
                           ]
                         },
                         options: {
                            maintainAspectRatio: false,
                           legend: { display: false },
                           title: {
                             display: false,
                             text: 'Number of Votes By Disney Character'
                           },
                           scales: {
                                 yAxes: [{
                                     ticks: {
                                         beginAtZero:true
                                     }
                                 }]
                             }
                         }
                     });
                 });
             }
             $(document).ready (function () {
                 var divider=1;
                 //displayChart(divider);
                 $("#goBtn").click (function (e) {
                    var divider = $('#divideBy').val();
                    var sort = $('#sort').val();
                    console.log(sort);
                    displayChart(divider, sort, -2600);
                });
                $("#goBtn1").click (function (e) {
                    var year = $('#birthYear').val();
                    var sort = $('#sortBy').val();
                    console.log(sort);
                    displayChart('1', sort, year);
                });
             });

        </script>
    </div><!--/.container-->
    
    

</body>
</html>