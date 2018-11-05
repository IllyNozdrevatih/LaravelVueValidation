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
        errors:new Errors()
    },

    methods:{
        onSubmit:function(){
            axios.post('/public/articles',this.$data)
                .then(response => window.location.replace("/public/articles"))
                .catch(error => this.errors.record(error.response.data.errors))
        },
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    }
})
