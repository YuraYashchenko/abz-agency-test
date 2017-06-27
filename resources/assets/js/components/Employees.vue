<template>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Position</th>
            <th>Start Date</th>
            <th>Salary</th>
        </thead>
        <tbody>
            <tr v-for="employee in employees">
                <td v-text="employee.name"></td>
                <td v-text="employee.position"></td>
                <td v-text="employee.start_date"></td>
                <td v-text="employee.salary"></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['employees']
    }
</script>