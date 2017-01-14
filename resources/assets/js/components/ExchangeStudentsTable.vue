<template>
    <div>
    <table>
        <thead>
            <tr>
                <th>Jméno</th>
                <th>
                    <select name="country" class="chosen" data-placeholder="Země">

                    </select>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="student in students">
                <td>{{ student.person.first_name }}</td>
                <td>{{ student.person.last_name }}</td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>

    export default {
        props: {
            students: Array,
            columns: Array
        }
        
    }
</script>
