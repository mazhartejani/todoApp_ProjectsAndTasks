<template>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label for="taskName">Task Name</label>
            <input v-model="fields.name" type="text" class="form-control" id="taskName" placeholder="Enter Task Name">
            <p v-if="errors && errors.name" class="text-danger"> {{ errors.name[0] }} </p>
        </div>

        <div class="form-group">
            <label for="taskDescription">Task Description</label>
            <textarea v-model="fields.description" class="form-control" id="taskDescription" placeholder="Enter Task Description"></textarea>
            <p v-if="errors && errors.description" class="text-danger"> {{ errors.description[0] }} </p>
        </div>

        <div class="form-group">
            <button :disabled="this.isButtonDisabled" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</template>

<script>
export default {
    name: "AddTaskForm",
    data() {
        return {
            fields:{
                name: null,
                description: null,
                projectId: this.$route.params.projectId,
            },
            errors: {},
            isButtonDisabled: false
        }
    },
    methods: {
        submit(){
            this.errors = {}
            this.isButtonDisabled = true;

            axios.post('/api/tasks', this.fields)
                .then(response => {
                    if(response.status === 200 && response.data.length){

                        console.log(response)

                        //assign tasks array with fresh data
                        this.$parent.tasks = response.data;

                        //execute success function on parent component (task.vue)
                        this.$parent.success();

                        //set form fields to null
                        this.fields.name = null
                        this.fields.description = null
                        this.isButtonDisabled = false
                    }else{
                        console.log(response)
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
