class Errors {
    constructor(){
        this.errors = {}
    }
    get(field){
        if(this.errors[field]){
            return this.errors[field][0]
        }
    }

    has(field){
        return this.errors.hasOwnProperty(field);
    }

    record(errors){
        this.errors = errors;
    }

    clear(field){
        delete this.errors[field];
    }
}
new Vue({
    el:'#validation',
    data:{
        title:'',
        description:'',
        image:'',
        categories:[],
        errors:new Errors()
    },

    methods:{
        onSubmit:function(){
            axios.post('/articles',this.$data)
                .then(response => window.location.replace("http://127.0.0.1:8000/articles"))
                .catch(error => this.errors.record(error.response.data.errors))
        }
    }
})
