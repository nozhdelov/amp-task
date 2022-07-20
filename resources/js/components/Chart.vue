

<template>
<div>
    <div class="row" >
        <div class="col">
            <custom-selector :options="this.periods" @change="periodChanged" > </custom-selector>
        </div>
        <div class="col">
            <custom-selector :options="this.types" @change="typeChanged" > </custom-selector>
        </div>
        
    </div>
    <div class="row " > 
         <canvas id="chart" style="margin:auto" ></canvas>
    </div>
    
   
</div>

</template>

<script>
import { Chart as ChartJS, registerables } from 'chart.js';

ChartJS.register(...registerables);

export default {
    props : [],
    emits : ['message', 'error'],
    data : function(){
        return {
           periods : [{label : 'Today', value : 0}, {label : 'Last 7 days', value : 7}, {label : 'Last 30 days', value : 30}],
           period : 0,
           types : [{label : 'Last Price', value : 'last_price'}, {label : 'Low', value : 'low'}, {label : 'High', value : 'high'}],
           type : 'last_price',
           
           chart : null
        };
    },

    methods : {
        
        fetchData(){
            const params = {
                type : this.type,
                period : this.period
            };
            axios.get('/pricePoints', {params : params}).then( response => {
                if(+response.data.status === 0){
                    this.$emit('error', response.data.message);
                }
                this.buildChart(response.data.data);
          
            });
        },

        periodChanged(period){
            this.period = period;
            this.fetchData();
        },

        typeChanged(type){
            this.type = type;
            this.fetchData();
        },

        buildChart(config){
            
            if(this.chart){
                this.chart.destroy();
            }
            const ctx = document.getElementById('chart').getContext('2d');

            const label = this.types.filter(t => t.value === this.type)[0].label;
            this.chart = new ChartJS(ctx, {
                type: 'line',
                responsive : true,
                data: {
                    labels: config.labels,
                    datasets: [{
                        data : config.points, 
                        label : label,
                        borderColor : 'rgba(0, 0, 255, 0.7)',
                    }]
                },
               
            });
        }

    },

    mounted : function(){
        this.fetchData();
        
    },
    

};
</script>

<style>
    .chartContainer {
        width : 800px;
        height : 500px;
    }

</style>

