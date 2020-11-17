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
                    <a :href="task.id" v-on:click="handleDelete" data-toggle="tooltip" data-placement="top" title="Delete Task" :id="task.id">
                        <span class="badge badge-danger p-2" :id="task.id">
                            <i class="fa fa-trash-alt text-light" :id="task.id"></i>
                        </span>
                    </a>

                </td>
            </tr>

            </tbody>
        </table>

    </div>
</template>

<script>

export default {
    name: "TasksList",
    props: ['tasks'],
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
        handleDelete(e){
            e.preventDefault();
            console.log(e.target)
            let taskId = e.target.id
            axios.delete("/api/tasks/"+taskId)
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
            $('[data-toggle="tooltip"]').tooltip()
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
