<template>
    <tr>
        <td>{{ message }}</td>
        <td>{{ student.first_name }} {{ student.last_name }}</td>
        <td>{{ student.university }}</td>
    </tr>
</template>

<script>
    export default {
        props: ['student', 'message']
    }
</script>
