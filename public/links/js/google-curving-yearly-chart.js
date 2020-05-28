google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['Jan',  1000,      400],
          ['Feb',  1170,      460],
          ['Mar',  660,       1120],
          ['Apr',  760,       1120],
          ['May',  960,       1120],
          ['Jun',  660,       1120],
          ['Jul',  680,       1120],
          ['Aug',  600,       1120],
          ['Sep',  360,       1120],
          ['Oct',  960,       1120],
          ['Nov',  660,       1120],
          ['Dec',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_year_chart'));

        chart.draw(data, options);
      }