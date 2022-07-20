

<template>
    <div class="row mt-2" ><h6>Notify me when the price goes above the limit </h6></div>
    <div class="row align-items-center" >
        <div class="col"><input type="text" class="form-control form-text" placeholder="Enter email" @change="this.emailChanged" /> </div>
        <div class="col"><input type="text" class="form-control form-text" placeholder="Enter price" @change="this.priceChanged" /> </div>
        <div class="col"><input type="button" class="btn btn-primary" value="Notify Me" @click="setNotification" /></div>

    </div>
</template>

<script>

export default {
    emits : ['message', 'error'],
    data : function(){
        return {
           
        };
    },

    methods : {
        
        emailChanged(e){
            this.email = e.target.value;
        },

        priceChanged(e){
            this.price = e.target.value;
        },

        setNotification(){
            const params = {
                email : this.email,
                price : this.price
            };
            axios.post('/notifications/add', params).then( response => {
                const eventType = +response.data.status === 1 ? 'message' : 'error';
                this.$emit(eventType, response.data.message);
          
            });
        }
    }

   
    

};
</script>



