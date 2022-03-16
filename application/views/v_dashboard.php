<style>
#chart {
    height: 100%;
}

.con_chart {
    padding: 20px;
    margin: 0px 30px;
    border-radius: 10px;
    background-color: white;
    box-shadow: 1px 1px 5px 3px rgba(100, 100, 100, 0.2);
}

tspan {
    font-weight: bold;
}
</style>

<div class="con_chart">
    <div class="text-end">
        <select class="ui align-right search dropdown type_id">
            <option value="ALL">ALL</option>

            <?php foreach ($activity_types as $activity_type){ ?>
            <option value="<?php echo $activity_type->_id ?>"
                <?php if(isset($type_id) && $type_id == $activity_type->_id) {echo "selected";}; ?>>
                <?php echo $activity_type->type_name ?>
            </option>
            <?php } ?>

        </select>
    </div>
    <div id="chart"></div>
</div>

<!-- highcharts -->
<!-- <script src="https://se.buu.ac.th/gami_ossd/assets/dist/js/highcharts.js"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
    rel="stylesheet">

<script>
var h_screen = $(window).height() - 200;
var gold_url = "<?= base_url() . "assets/img/gold_crown.png"?>"
var sliver_url = "<?= base_url() . "assets/img/sliver_crown.png"?>"
var bronze_url = "<?= base_url() . "assets/img/broezn_crown.png"?>"
var default_formatter = {
    enabled: true,
    useHTML: true,
    verticalAlign: 'top',
    crop: false,
    overflow: 'none',
    x: 0,
    y: -40,
    formatter: function() {
        return '<div style="text-align: center;" class="tooltip-title-font"><br>' + this.y + '</div>'
    }
}

var gold_formatter = {
    enabled: true,
    useHTML: true,
    y: -70,
    formatter: function() {
        return '<div style="text-align: center;" class="tooltip-title-font"><img width="45px"  src="' +
            gold_url + '"></img><br>' + this.y + '</div>'
    }
}

var sliver_formatter = {
    enabled: true,
    useHTML: true,
    y: -70,
    formatter: function() {
        return '<div style="text-align: center;" class="tooltip-title-font"><img width="45px"  src="' +
            sliver_url + '"></img><br>' + this.y + '</div>'
    }
}

var bronze_formatter = {
    enabled: true,
    useHTML: true,
    y: -70,
    formatter: function() {
        return '<div style="text-align: center;" class="tooltip-title-font"><img width="45px"  src="' +
            bronze_url + '"></img><br>' + this.y + '</div>'
    }
}

// Set data bar chart
var data_bar_chart = [{
    name: "คะแนน ",
    showInLegend: false,
    dataLabels: default_formatter,
    data: [{
            y: <?php echo $team[0]->score ?>
        },
        {
            y: <?php echo $team[1]->score ?>
        },
        {
            y: <?php echo $team[2]->score ?>
        },
        {
            y: <?php echo $team[3]->score ?>
        },
        {
            y: <?php echo $team[4]->score ?>
        },
        {
            y: <?php echo $team[5]->score ?>
        },
        {
            y: <?php echo $team[6]->score ?>
        },
        {
            y: <?php echo $team[7]->score ?>
        },
        {
            y: <?php echo $team[8]->score ?>
        }

    ]
}];

// Set bar char
var bar_chart = Highcharts.chart('chart', {
    chart: {
        height: h_screen,
        type: 'column'
    },
    title: {
        text: 'Open Source Software Developers Camp #10'
    },
    xAxis: {
        categories: [
            'มกุล 0',
            'มกุล 1',
            'มกุล 2',
            'มกุล 3',
            'มกุล 4',
            'มกุล 5',
            'มกุล 6',
            'มกุล 7',
            'มกุล 8',
        ],
        labels: {
            useHTML: true,
            formatter: function() {
                return '<img src="https://se.buu.ac.th/gami_ossd/assets/dist/img/cluster/cluster' + this
                    .value.substring(this.value.length - 1) +
                    '.png" style="width: 30px; vertical-align: middle" /><span style="font-size:14px;font-weight:700"> ' +
                    this.value + '</span>';
            }
        },
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'คะแนน'
        },
    },
    tooltip: {
        headerFormat: '<span style="font-size:20px; padding: 10px">{point.key}</span><table style="width: 120px; margin-left: 10px">',
        pointFormat: '<tr><td style="background-color: white;color:{series.color};padding:10; font-size:15px">{series.name}<br><b>{point.y}</b> </td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: data_bar_chart,
});
// Highcharts.setOptions({
var colors = ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'];
// });


function findIndicesOfMax(inp, count) {
    var outp = new Array();
    for (var i = 0; i < inp.length; i++) {
        outp.push(i);
        if (outp.length > count) {
            outp.sort(function(a, b) {
                return inp[b].y - inp[a].y;
            });
            outp.pop();
        }
    }
    return outp;
}

function rated() {

    var indices = findIndicesOfMax(data_bar_chart[0].data, 3);

    data_bar_chart[0].data[indices[0]].dataLabels = gold_formatter;

    data_bar_chart[0].data[indices[1]].dataLabels = sliver_formatter;

    data_bar_chart[0].data[indices[2]].dataLabels = bronze_formatter;

    bar_chart.update({
        series: data_bar_chart
    });
}

$(document).ready(function() {
    data_bar_chart[0].data[0].color = '#058DC7';
    data_bar_chart[0].data[1].color = '#50B432';
    data_bar_chart[0].data[2].color = '#ED561B';
    data_bar_chart[0].data[3].color = '#CD0000';
    data_bar_chart[0].data[4].color = '#24CBE5';
    data_bar_chart[0].data[5].color = '#FFA500';
    data_bar_chart[0].data[6].color = '#8B658B';
    data_bar_chart[0].data[7].color = '#FFF263';
    data_bar_chart[0].data[8].color = '#6AF9C4';

    rated();

    bar_chart.update({
        series: data_bar_chart
    });
});

$('.type_id').on('change', function() {
    var type_id = $(this).val();
    window.location.href = '<?php echo base_url(); ?>' + 'index.php/C_Dashboard/show_dashboard/' + type_id;
});
</script>