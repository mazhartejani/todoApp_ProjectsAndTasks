<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9"><h2>Projects</h2></div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" data-target="#addProjectForm" data-toggle="collapse">
                                    Add New Project
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <FlashMessage :position="'right bottom'"></FlashMessage>
                        <add-project-form id="addProjectForm" class="collapse"></add-project-form>
                        <projects-list v-if="projects.length && isLoaded" v-bind:projects="projects"></projects-list>
                        <div v-else-if="!projects.length && isLoaded">
                            <h2>No Projects Found</h2>
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
        name: "Projects",
        data(){
            return{
                projects: [],
                isLoaded: false
            }
        },
        mounted() {
            axios.get('api/projects')
                .then(response => {
                    if (response.status === 200 && response.data.length){
                        this.projects = response.data;
                    }
                })
                .then(() => {
                    //Iniate bootstrap tooltip functionality
                    $('[data-toggle="tooltip"]').tooltip()
                    this.isLoaded = true
                })
                .catch(error => console.log(error))
        },
        methods: {
            success(){
                this.flashMessage.success({
                    title: 'Success',
                    message: 'Project Added Successfully, Great.'
                });
                $("#addProjectForm").collapse('hide')
            }
        }
    }

</script>
