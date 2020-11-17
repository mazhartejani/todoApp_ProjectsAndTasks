<template>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label for="projectName">Project Name</label>
            <input v-model="fields.name" type="text" class="form-control" id="projectName" placeholder="Enter Project Name">
            <p v-if="errors && errors.name" class="text-danger"> {{ errors.name[0] }} </p>
        </div>

        <div class="form-group">
            <label for="projectDescription">Project Description</label>
            <textarea v-model="fields.description" class="form-control" id="projectDescription" placeholder="Enter Project Description"></textarea>
            <p v-if="errors && errors.description" class="text-danger"> {{ errors.description[0] }} </p>
        </div>

        <div class="form-group">
            <button :disabled="this.isButtonDisabled" id="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</template>

<script>
export default {
    name: "AddProjectForm",
    data() {
        return {
            fields:{
                name: null,
                description: null,
            },
            errors: {},
            isButtonDisabled: false
        }
    },
    methods: {
        submit(){
            this.errors = {}
            this.isButtonDisabled = true

            axios.post('/api/projects', this.fields)
                .then(response => {
                    if(response.status === 200 && response.data.length){

                        console.log(response)

                        //assign projects array with fresh data
                        this.$parent.projects = response.data;

                        //execute success function on parent component (Project.vue)
                        this.$parent.success();

                        //set form fields to null
                        this.fields.name = null
                        this.fields.description = null
                        this.isButtonDisabled = false

                    }
                })
                .catch(error => {
                    console.log(error.response)

                    if(error.response.status === 422){
                        this.errors = error.response.data.errors || {};
                    }
                    this.isButtonDisabled = false

                })
        }
    }
}
</script>
