<!DOCTYPE html>
<html xmlns:v-on="http://www.w3.org/1999/xhtml">
<meta id="token" name="csrf-token" content="{{csrf_token()}}">
<body>
<div id="app">
    <button name="updateButton" v-on:click="update">Update</button>
    <table>
        <thead>
            <th>Jméno</th>
            <th>
                <select name="zeme" class="chosen" data-placeholder="Země" v-model="exchangeStudents.filters.countries">
                    <option value></option>
                    @foreach($countries as $country)
                    <option value="{{ $country->two_letters }}">{{ $country->full_name }}</option>
                    @endforeach
                </select>
            </th>
            <th>
                School
            </th>
        </thead>
        <tbody>
            <tr v-for="student in exchaneStudents.all()">
                <td>{{ student.person.first_name }} {{ student.person.last_name }}</td>
                <td>{{ student.country.full_name }}</td>
                <td>{{ student.school }}</td>
            </tr>
        </tbody>
    </table>
    <exchangestudentstable :students="exchangeStudents.all()" :columns="columns"></exchangestudentstable>
</div>
<script src="/js/app.js"></script>
</body>
</html>