google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Social Islami Bank', 'Pubali Bank', 'Bank Asia', 'Bank Asia', 'Mercantile Bank', 'Mercantile Bank', 'Average'],
          ['Jan',   165,                    938,            522,        998,           450,             450,                614.6],
          ['Feb',   135,                    1120,           599,        1268,          288,             450,                682],
          ['Mar',   157,                    1167,           587,        807,           397,             450,                623],
          ['Apr',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['May',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Jun',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Jul',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Aug',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Sep',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Oct',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Nov',   139,                    1110,           615,        968,           215,             450,                609.4],
          ['Dec',   136,                    691,            629,        1026,          366,             450,                569.6]
        ]);

        var options = {
          title : 'Yearly Account Transaction',
          vAxis: {title: 'Amount'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {6: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_year'));
        chart.draw(data, options);
      }