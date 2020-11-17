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
            <tr v-for="project in projects">
                <td>{{ project.name }}</td>
                <td>{{ project.description }}</td>
                <td>
                    <router-link :to="'/projects/'+ project.id" data-toggle="tooltip" data-placement="top" title="Open Project">
                        <span class="badge badge-success p-2">
                            <i class="far fa-folder-open text-light"></i>
                        </span>
                    </router-link>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "ProjectsList",
    props: ['projects'],
    methods: {
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
