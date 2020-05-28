google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales', 'Expenses'],
          ['1',  1000,      400],
          ['2',  1170,      460],
          ['3',  660,       1120],
          ['4',  660,       1120],
          ['5',  1660,       1120],
          ['6',  460,       1120],
          ['7',  690,       1120],
          ['8',  680,       1120],
          ['9',  670,       1120],
          ['10',  660,       1120],
          ['11',  650,       1120],
          ['12',  260,       1120],
          ['13',  360,       1120],
          ['14',  460,       1120],
          ['15',  560,       1120],
          ['16',  660,       1120],
          ['17',  760,       1120],
          ['18',  860,       1120],
          ['19',  660,       1120],
          ['20',  1660,       1120],
          ['21',  660,       1120],
          ['22',  860,       1120],
          ['23',  560,       1120],
          ['24',  660,       1120],
          ['25',  960,       1120],
          ['26',  2660,       1120],
          ['27',  660,       1120],
          ['28',  260,       1120],
          ['29',  560,       1120],
          ['30',  660,       1120],
          ['31',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_month_chart'));

        chart.draw(data, options);
      }