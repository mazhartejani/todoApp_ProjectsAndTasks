<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-if="isLoaded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12"><h2>{{projectName}}</h2></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12"><p>{{projectDescription}}</p></div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9"><h2>Tasks</h2></div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" data-target="#addTaskForm" data-toggle="collapse">
                                    Add New Task
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <FlashMessage :position="'right bottom'"></FlashMessage>
                        <add-task-form id="addTaskForm" class="collapse"></add-task-form>
                        <tasks-list v-if="tasks.length && isLoaded" v-bind:tasks="tasks"></tasks-list>
                        <div v-else-if="!tasks.length && isLoaded">
                            <h2>No Tasks Found</h2>
                        </div>
                        <div v-else class="d-flex align-items-center">
                            <strong>Loading...</strong>
                            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tasks",
        data(){
            return{
                tasks: [],
                isLoaded: false,
                projectName: null,
                projectDescription: null
            }
        },
        mounted() {
            //get the detail of the specific project
            axios.get('api/projects/' + this.$route.params.projectId)
                .then(response => {
                    if (response.status === 200 ){
                        this.projectName = response.data.name;
                        this.projectDescription = response.data.description;
                    }else{
                        console.log("Something bad happend", response)
                    }
                })
                .catch(error => console.log(error))

            //get all the tasks of the specific project
            axios.get('api/tasks/' + this.$route.params.projectId)
                .then(response => {
                    if (response.status === 200 && response.data.length){
                        this.tasks = response.data;
                        console.log(response.data)

                    }else{
                        console.log("Something bad happend", response)
                    }

                    //set isLoaded flag to true and update tooltip
                    this.isLoaded = true
                })
                .catch(error => console.log(error))
        },
        methods: {
            success(){
                this.flashMessage.success({
                    title: 'Success',
                    message: 'Task Added Successfully, Great.'
                });
                $("#addTaskForm").collapse('hide')
            }
        },
    }

</script>
