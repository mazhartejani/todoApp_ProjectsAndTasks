<template>
    <div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks">
                <td :style="textStyles(task.isCompleted)">{{ task.name }}</td>
                <td :style="textStyles(task.isCompleted)">{{ task.description }}</td>
                <td>
                    <a v-if="task.isCompleted === 0" :id="task.id" :href="task.id" v-on:click="toggleComplete" data-toggle="tooltip" data-placement="top" title="Mark as Completed">
                        <span class="badge badge-success p-2" :id="task.id">
                            <i class="fa fa-check text-light" :id="task.id"></i>
                        </span>
                    </a>
                    <a v-else :id="task.id" :href="task.id" v-on:click="toggleComplete" data-toggle="tooltip" data-placement="top" title="Mark as Incomplete">
                        <span class="badge badge-warning p-2" :id="task.id">
                            <i class="fas fa-exclamation text-light" :id="task.id"></i>
                        </span>
                    </a>
                    <a href="#myModal" v-on:click="confirmDelete" data-tooltip="tooltip" data-placement="top" title="Delete Task" :id="task.id" data-toggle="modal">
                        <span class="badge badge-danger p-2" :id="task.id">
                            <i class="fa fa-trash-alt text-light" :id="task.id"></i>
                        </span>
                    </a>

                </td>
            </tr>

            </tbody>
        </table>

        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="fas fa-times"></i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                        <button type="button" class="close" v-on:click="cancelDelete" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete this task? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" v-on:click="cancelDelete" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" v-on:click="handleDelete" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {
    name: "TasksList",
    props: ['tasks'],
    data(){
        return{
            taskToDelete: null
        }
    },
    methods: {
        toggleComplete(e){
            e.preventDefault();
            console.log(e.target)
            let taskId = e.target.id
            axios.put("/api/tasks/"+taskId, taskId)
                .then(response => {
                    console.log("done")
                    //assign tasks array with fresh data
                    this.$parent.tasks = response.data;
                })
                .catch(error => {
                    console.log(error)
                })

        },
        confirmDelete(e){
            e.preventDefault();
            this.taskToDelete = e.target.id
        },
        cancelDelete(){
            this.taskToDelete = null;
        },
        handleDelete(){
            axios.delete("/api/tasks/" + this.taskToDelete)
                .then(response => {
                    console.log("done")
                    //assign tasks array with fresh data
                    this.$parent.tasks = response.data;
                })
                .catch(error => {
                    console.log(error)
                })
        },
        textStyles(isCompleted){
            if(isCompleted){
                return "text-decoration: line-through; color: red";
            }else{
                return "";
            }
        },
        updateTooltip(){
            $('[data-tooltip="tooltip"]').tooltip()
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.updateTooltip()
        })
    },
    updated() {
        this.updateTooltip()
    }
}

</script>

<style scoped>

</style>
