<template>
    <div class="form-group">
        <div v-if="isHorizontal" class="form-group row">
            <label :for="id" class="col-sm-3 col-form-label" >{{label}}</label>
            <div class="col-sm-9">
                <input 
                    :type="type" 
                    :class="['form-control', getTheme]" 
                    :id="id" 
                    :placeholder="placeholder" 
                    @input="$emit('input', $event.target.value)"
                    :value="value">
                <!-- <small :v-if="helpBlock" :class="[isValid+'-feedback', 'text-left']"> {{helpBlock}} </small> -->
            </div>
            <!-- <small v-if="helperOn" class="form-text text-muted">{{helperMessage}}</small> -->
        </div>
    </div>
<!--     <div v-else :class="[getTheme]">
        <label :for="id" class="col col-sm-2 control-label" >{{label}}</label>
        <input :type="type" class="form-control" :id="id" :placeholder="placeholder" :value="value">
        <small v-if="helperOn" class="form-text text-muted">{{helperMessage}}</small> 
    </div> -->

</template>

<script>
export default {
    name: 'inputView',
    props: {
        isHorizontal:{
            type: Boolean,
            default: true
        },
        getTheme:{
            type: String
        },
        id: {
            type: String
        },
        type: {
            type: String,
            default: 'text'
        },
        label: {
            type: String
        },
        value: {
            type: String
        },
        placeholder: {
            type: String,
            default: 'Enter Text..'
        },
        helpBlock: {
            type: String
        }
    },
    computed: {
/*         isValid(){
            this.$emit('validate', data)
            if (this.getTheme=="is-valid"){
                return 'valid'
            }
            return 'invalid'
        } */
    },
}
</script>
