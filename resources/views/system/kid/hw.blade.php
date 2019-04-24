@push('custom_css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="{{ asset('js/util.js') }}"></script>
@endpush

@extends('system.layouts.app')

@section('content')
			
<div class="eds03_01_btn_area">
	<div class="search_btn">
		<a href="{{route('hw.log',$kid->id)}}">記録参照</a>
	</div>
</div>		

<h2>{{ $kid->name }} {{ $kid->genderLabel()}}の身長と体重</h2>
<div class="graph_area">
    <div class="graph-wrapper">
        <canvas id="chart-0"></canvas>
    </div>
    
    <div class="graph-wrapper">
        <canvas id="chart-1"></canvas>
    </div>
    
</div>


<form action="{{ route('kid.hw_store', $kid->id )}}" method="post" id="create-form">

    @include('common.errors')
    {{ csrf_field()}}
    <table class="edy11_01_search">
        <tbody><tr>
            <td>
                <span class="form_title_a">測定日（＊）</span>
                {!! Form::text('date', null, ['id' => 'datepicker', 'class' => 'input_field_c', 'readonly' => 'readonly']) !!}
            </td>
            <td>
                <span class="form_title_a">身長(cm)（＊）</span>
                {!! Form::number('height', null, ['class' => 'input_field_a', 'min' => '40']) !!}
                <span class="form_title_b"> 小数点以下1桁まで</span>
            </td>
            <td>
                <span class="form_title_a">体重(kg)（＊）</span>
                {!! Form::number('weight', null, ['class' => 'input_field_a', 'min' => '2']) !!}
                <span class="form_title_b" >小数点以下1桁まで</span>
            </td>
            <td>
                <span class="form_title_a">メモ</span>
                {{ Form::textarea('memo', null, ['class' => 'input_field_b', 'cols' => '30', 'rows' => '5']) }}
            </td>
        </tr>
    </tbody></table>
</form>

<div class="edy11_01_btn_area">
    <div class="save_btn">
        <a href="#" id="save">保存</a>
    </div>
</div>

<script>
    var presets = window.chartColors;
	var utils = Samples.utils;
	var inputs = {
		min: 20,
		max: 80,
		count: 8,
		decimals: 2,
		continuity: 1
	};
	function generateLabels(config) {
		return utils.months({count: inputs.count});
	}
	
	var data_weight = {
        labels: [
			0,"","","","","","","","","","","",
			1,"","","","","","","","","","","",
			2,"","","","","","","","","","","",
			3,"","","","","","","","","","","",
			4,"","","","","","","","","","","",
			5,"","","","","","","","","","","",
			6,
		],
        datasets: [{
            data:{!! isset($weights) && !empty($weights) ? json_encode($weights) : json_encode([]) !!},
            label: 'Kid',
            fill:false,
			borderDash: [8,10],
			borderColor:'#000',
			spanGaps : true
			
        },
        {
			data:{!! isset($MinMax['weight_max']) && !empty($MinMax['weight_max']) ? json_encode($MinMax['weight_max']) : json_encode([]) !!},
			backgroundColor: utils.transparentize(presets.orange),
			borderColor: presets.orange,
            fill:2,
			label:"Max",
			spanGaps : true
        },
        {
			data:{!! isset($MinMax['weight_min']) && !empty($MinMax['weight_min']) ? json_encode($MinMax['weight_min']) :json_encode([]) !!},
			borderColor: presets.orange,
            fill: 1,
			label:"Min",
			spanGaps :true
        }
        ],
       
    };

    var data_height = {
		labels: [
			0,"","","","","","","","","","","",
			1,"","","","","","","","","","","",
			2,"","","","","","","","","","","",
			3,"","","","","","","","","","","",
			4,"","","","","","","","","","","",
			5,"","","","","","","","","","","",
			6,
		],
        datasets: [{
			data:{!! isset($heights) && !empty($heights) ? json_encode($heights) : json_encode([]) !!},
            label: 'Kid',
            fill:false,
			borderDash: [8,10],
			borderColor:'#000',
			scaleSteps: 4,
			spanGaps :true
        },
        {
			data:{!! isset($MinMax['height_max']) && !empty($MinMax['height_max']) ? json_encode($MinMax['height_max']) : json_encode([]) !!},
			backgroundColor: utils.transparentize(presets.orange),
			borderColor: presets.orange,
			fill:2,
			spanGaps : true

        },
        {
			data:{!! isset($MinMax['height_min']) && !empty($MinMax['height_min']) ? json_encode($MinMax['height_min']) : json_encode([]) !!},
			borderColor: presets.orange,
			fill:1,
			spanGaps : true

        }  
        ]
    };


var options1 = {
	maintainAspectRatio: false,
	legend: {
		display: false
	},
	tooltips: {
		callbacks: {
		label: function(tooltipItem) {
				return tooltipItem.yLabel;
			}
		}
	},
	title: {
			display: true,
			text: '体 重',
			fontSize:18
		},
	scales: {
		xAxes: [{
			scaleLabel: {
					display: true,
					labelString: ' 年齢（歳）',
					fontSize:16,
				
			},	
			ticks: {
				maxRotation: 0,
				fontSize:14,
				stepSize:6
			}	
		}],
		yAxes: [{    
			scaleLabel: {
					display: true,
					labelString: ' 体重（kg）',
					fontSize:16,
			},
			ticks: {
				min: 0,
				max: 26,
				beginAtZero:true,
				stepSize: 2,
				fontSize:14
			}
		}],
	},
};

var options2 = {
	maintainAspectRatio: false,
	legend: {
		display: false
	},

	tooltips: {
		callbacks: {
			label: function(tooltipItem) {
					return tooltipItem.yLabel;
			}
		}
	},
	title: {
			display: true,
			text: ' 身 長',
			fontSize:18
		},
	scales: {
		xAxes: [{
			scaleLabel: {
					display: true,
					labelString: '年齢（歳）',	   
					fontSize:16
			},	
			ticks: {
			maxRotation: 0,
			fontSize:14
		}	
		}],
		yAxes: [{    
			scaleLabel: {
				display: true,
				labelString: '身長（cm）',
				fontSize:16
			},
				ticks: {
				min: 40,
				max: 130,
				beginAtZero:true,
				stepSize: 10,			
			}
			
		}],
			
	},
};

var ctx0=document.getElementById("chart-0").getContext("2d");
ctx0.canvas.width = 400;
ctx0.canvas.height = 600;
var chart1 = new Chart(ctx0, {
	type: 'line',
	data: data_weight,
	options: options1
});

var ctx1=document.getElementById("chart-1").getContext("2d");
ctx1.canvas.width = 400;
ctx1.canvas.height = 600;

var chart2 = new Chart(ctx1, {
	type: 'line',
	data: data_height,
	options: options2
});


</script>

@push('custom_js')
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
        } );
        </script>
@endpush
@endsection