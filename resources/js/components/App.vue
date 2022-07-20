
<template>
<message-box v-for="box in this.messageBoxes" :type="box.type" :message="box.message" :id="box.id" @close="this.closeMessage"></message-box>

<div class="container" >
    <h3 class="text-center">Ampeco task app</h3>
    <div class="row align-items-center" >
        <chart @message="this.showMessage" @error="this.showError"  ></chart>
    </div>
    
    
    <div class="row align-items-center" >
        <notification-controls @message="this.showMessage" @error="this.showError" ></notification-controls>
    </div>
</div>


</template>

<script>
export default {
    props : [],
    data : function(){
        return {
           messageBoxes : []
        };
    },
    
    methods : {
        showMessage(message){
            this.messageBoxes.push({type:'success', message:message, id : Math.random() * 100000});
        },

        showError(message){
            this.messageBoxes.push({type:'error', message:message, id : Math.random() * 100000});
        },
        
        closeMessage(id){
            for(let i = 0; i < this.messageBoxes.length; i++){
                if(this.messageBoxes[i].id === id){
                    console.log('delete', id)
                    this.messageBoxes.splice(i, 1);
                    break;
                }
            }
        }
    },

    mounted(){
        
    }
    
   
    

};
</script>

