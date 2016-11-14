$(document).ready(function() {
  $('#river-region').submit(function() { // catch the form's submit event
    $.ajax({ // create an AJAX call...
      data: $(this).serialize(), // get the form data
      type: $(this).attr('method'), // GET or POST
      url: $(this).attr('action'), // the file to call
      success: function(responseData) { // on success..
        //console.log(responseData);
        var response = JSON.parse(responseData);
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

        Highcharts.chart('container-region', options);

      }
    });
    return false; // cancel original event to prevent form submitting
  });

});

//district
$(document).ready(function() {
  $('#river-district').submit(function() { // catch the form's submit event
  $.ajax({ // create an AJAX call...
    data: $(this).serialize(), // get the form data
    type: $(this).attr('method'), // GET or POST
    url: $(this).attr('action'), // the file to call
    success: function(responseData) { // on success..
      //console.log(responseData);
      var error_p = document.getElementById("district-selectors-error");
      if(responseData == "false"){
        error_p.classList.toggle("show", true);
        return;
      }
      error_p.classList.toggle("show", false);
      var response = JSON.parse(responseData);
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

      Highcharts.chart('container_district', options);

    }
  });
  return false; // cancel original event to prevent form submitting
});

});
