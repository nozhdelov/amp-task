
<template>
<div  :class="classObject"  role="alert">
    {{message}}
    <button type="button" class="btn-close" @click="close" ></button>
</div>
</template>

<script>

export default {
    emits : ['close'],
    props : ['message', 'type', 'id'],
    data : function(){
        return {
           isOpen : false
         
        };
    },

    computed: {
        classObject : function() {
          return {
            alert: true,
            myAlertbox : true,
            'alert-success': this.type === 'success',
            'alert-danger': this.type === 'error',
            'alert-dismissible' : true,
            show : this.isOpen,
            hide : !this.isOpen
          };
        }
    }, 

    methods : {
        close(){
            this.isOpen = false;
            setTimeout(() => this.$emit('close', this.id), 1000);
        }
        
    },

    mounted(){
        requestAnimationFrame( () => {
            this.isOpen = true;
        });

        
    }

   
    

};
</script>

<style>

.myAlertbox {
    position : absolute;
    width : 50%;
    left: 25%;
    top : -100px;
    transition: all 1s;
    
    
}

.show {
    transform: translateY( 350px);
}

.hide {
    transform: translateY( 0);
}

</style>


