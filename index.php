<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
  <title>Регіональні дані ЗНО-2016 (графіки)</title>
  <script src="js/jquery.js"></script>
  <script src="js/highcharts.js"></script>
  <script src="js/highcharts-more.js"></script>
  <script src="js/exporting.js"></script>
  <script>
    $(document).ready(function() {
      $('#river-select').submit(function() { // catch the form's submit event
      $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: $(this).attr('action'), // the file to call
        success: function(response) { // on success..
          //console.log(response);
          var response = JSON.parse(response);
          var options = {
            chart: {
              type: 'spline'
            },
            title: {
              text: response[4][0]
            },

            xAxis: {
              //type: 'datetime'
              categories: ['2008', '2009', '2010', '2011', '2012', '2013',
                '2014', '2015', '2016']
            },

            yAxis: {
              title: {
                text: null
              },
              labels: {
                formatter: function() {
                  return this.value + ' %';
                }
              },
            },

            tooltip: {
              crosshairs: true,
              shared: true,
              valueSuffix: '%'
            },

            legend: {},

            series: [{
              name: response[4][2],
              data: response[0], //range,
              type: 'arearange',
              lineWidth: 0,
              //linkedTo: ':previous',
              color: Highcharts.getOptions().colors[0],
              fillOpacity: 0.3,
              zIndex: 0
            }, {
              name: response[4][1],
              data: response[1], //averages,
              zIndex: 1,
              color: '#ffeb3b',
              marker: {
                enabled: false,
                fillColor: 'white',
                lineWidth: 0,
                radius: 0,
                lineColor: '#ffeb3b'
              }
            }, {
              name: response[4][3],
              data: response[2], //city_sup,
              color: '#1976d2',
              zIndex: 2,
              marker: {
                fillColor: 'white',
                lineWidth: 1,
                lineColor: '#0d47a1'
              },
              dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%',
                align: 'right',
                crop: false,
                style: {
                  fontWeight: 'bold',
                  color: '#0d47a1'
                },
                x: 3,
                verticalAlign: 'middle'
              }
            }, {
              name: response[4][4],
              data: response[3], //city_sub,
              color: '#e53935',
              zIndex: 2,
              marker: {
                fillColor: 'white',
                lineWidth: 1,
                lineColor: '#c62828'
              },
              dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%',
                align: 'left',
                crop: false,
                style: {
                  fontWeight: 'bold',
                  color: '#c62828'
                },
                x: 3,
                verticalAlign: 'middle'
              }
            }]
          };

          Highcharts.chart('container', options);

        }
      });
      return false; // cancel original event to prevent form submitting
    });

  });
</script>
</head>
<body>
  <style>
    body {
      background: #F5F5F5;
      font-family: monospace;
    }

    h3 {
      text-align: center;
      color: #5C6773;
      font-weight: normal;
    }

    .container {
        max-width: 1400px;
        min-width: 310px;
        margin: 0 auto;
    }

    form {
      text-align: center;
      margin-bottom: 30px;
    }

    .copy {
      margin-top: 20px;
      text-align: right;
      font-family: monospace;
      font-size: 12px;
      color: #B89981;
    }

    .copy span {
      color: #333333;
    }
  </style>
  <div class="container">

    <h3 style="text-align: center;">Оберіть предмет та область для порівняння</h3>
    <form id="river-select" action="getData.php" method="POST">
      <select name="subject_id">
        <option value="1">Українська мова і література</option>
        <option value="2">Математика</option>
        <option value="3">Історія України</option>
        <option value="4">Біологія</option>
        <option value="5">Хімія</option>
        <option value="6">Фізика</option>
        <option value="7">Географія</option>
        <option value="8">Англійська мова</option>
      </select>
      <select name="region_id_sup">
        <option value="1">Автономна Республіка Крим</option>
        <option value="2">Вінницька область</option>
        <option value="3">Волинська область</option>
        <option value="4">Дніпропетровська область</option>
        <option value="5">Донецька область</option>
        <option value="6">Житомирська область</option>
        <option value="7">Закарпатська область</option>
        <option value="8">Запорізька область</option>
        <option value="9">Івано-Франківська область</option>
        <option value="10">Київська область</option>
        <option value="11">Кіровоградська область</option>
        <option value="12">Луганська область</option>
        <option value="13">Львівська область</option>
        <option value="14">Миколаївська область</option>
        <option value="15">Одеська область</option>
        <option value="16">Полтавська область</option>
        <option value="17">Рівненська область</option>
        <option value="18">Сумська область</option>
        <option value="19">Тернопільська область</option>
        <option value="20">Харківська область</option>
        <option value="21">Херсонська область</option>
        <option value="22">Хмельницька область</option>
        <option value="23">Черкаська область</option>
        <option value="24">Чернівецька область</option>
        <option value="25">Чернігівська область</option>
        <option value="26">м.Київ</option>
        <option value="27">м.Севастополь</option>
      </select>
      <select name="region_id_sub">
        <option value="1">Автономна Республіка Крим</option>
        <option value="2">Вінницька область</option>
        <option value="3">Волинська область</option>
        <option value="4">Дніпропетровська область</option>
        <option value="5">Донецька область</option>
        <option value="6">Житомирська область</option>
        <option value="7">Закарпатська область</option>
        <option value="8">Запорізька область</option>
        <option value="9">Івано-Франківська область</option>
        <option value="10">Київська область</option>
        <option value="11">Кіровоградська область</option>
        <option value="12">Луганська область</option>
        <option value="13">Львівська область</option>
        <option value="14">Миколаївська область</option>
        <option value="15">Одеська область</option>
        <option value="16">Полтавська область</option>
        <option value="17">Рівненська область</option>
        <option value="18">Сумська область</option>
        <option value="19">Тернопільська область</option>
        <option value="20">Харківська область</option>
        <option value="21">Херсонська область</option>
        <option value="22">Хмельницька область</option>
        <option value="23">Черкаська область</option>
        <option value="24">Чернівецька область</option>
        <option value="25">Чернігівська область</option>
        <option value="26" selected>м.Київ</option>
        <option value="27">м.Севастополь</option>
      </select>
      <button type="submit" name="submit">Показати графік</button>
    </form>

    <div id="container" style="min-width: 310px; max-width: 1400px; height: 400px; margin: 0 auto"></div>

    <div class="copy" style="">
      <p>&copy; Created by <span>Roman Ivaskevych</span> with Highcharts</p>
    </div>

  </div>
</body>
</html>
