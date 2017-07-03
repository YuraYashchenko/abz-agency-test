<template>
    <div>
        <div class="form-group">
            <input type="text" class="form-control" style="margin-bottom: 1em" v-model="query">
            <button class="btn btn-primary btn-block" @click="search">Search</button>
        </div>

        <table class="table">
            <thead>
                <th></th>
                <th @click="sort('name')">Name</th>
                <th @click="sort('position')">Position</th>
                <th @click="sort('start_date')">Start Date</th>
                <th @click="sort('salary')">Salary</th>
            </thead>
            <tbody>
                <tr v-for="employee in employees">
                    <td><img class="img" :src="`/storage/avatars/${employee.id}/avatar.jpeg`"></td>
                    <td v-text="employee.name"></td>
                    <td v-text="employee.position"></td>
                    <td v-text="employee.start_date"></td>
                    <td v-text="employee.salary"></td>
                    <a :href="`/employee/${employee.id}`" class="btn btn-success">View</a>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                employees: this.data,
                query: ''
            };
        },

        methods: {
            sort(field) {
                axios.post('/sort', {'field': field}).then(response => {
                    this.employees = response.data;
                });
            },
            search() {
                axios.post('/search', {'query': this.query}).then(response => {
                    this.employees = response.data;
                })
            }
        }
    }
</script>

<style>
    th:hover {
        color: #007F80;
        cursor: pointer;
    }

    img {
        height: 50px;
        width: 75px;
    }
    th,td {
        text-align: center;
    }
</style>