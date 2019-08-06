<script>
  // We specify what type of chart we want from vue-chartjs and the mixins module
	import {Line, mixins} from 'vue-chartjs' 
	
	/* Chart.js ordinarily does not provide an option 
	for an automatic update whenever a dataset changes 
	but that can be done in vue-chartjs with the help of the following mixins:
		1. reactiveProp
		2. reactiveData
	These mixins automatically create chartData as a prop or data and add a watcher. 
	If data has changed, the chart will update */
	//const { reactiveProp } = mixins

  //We are extending the base chart class as mentioned above
  export default ({ 
    extends: Line,
    mixins: [mixins.reactiveProp],
    props: {
      chartData:{
        type: Array | Object,
        required: true
      },
      chartLabels:{
        type: Array | Object,
        required: true
      }
    },
    data () {
      return {
        options: { //Chart.js options
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: true
              }
            }]
          },
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
    mounted () {
			/* renderChart() function is responsible for rendering the chart. 
			this.chartData is an object containing the dataset needed for the chart a
			nd we’ll get that by including it as a prop in the vue template, 
			this.options contains the options object that determines the appearance and configuration of the chart */
      this.renderChart(this.chartData, this.options)
    }
  })
</script>