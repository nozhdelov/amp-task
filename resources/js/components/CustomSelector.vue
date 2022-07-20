

<template>
<select @change="changed" class="form-control form-select" >

    <option v-for="option in options" :value="option.value" >{{ option.label }}</option>
</select>
</template>

<script>

export default {
    emits : ['change'],
    props : ['options'],
    data : function(){
        return {
           
        };
    },

    methods : {
        
        changed(e){
            this.$emit('change', e.target.value);
        }

    },

   
    

};
</script>



