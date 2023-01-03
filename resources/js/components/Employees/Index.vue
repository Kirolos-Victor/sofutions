<template>
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employees Table <a class="btn btn-primary ml-3"
                                                                      href="/employees/create">Create Employee</a></h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                           placeholder="Search" @input="getEmployees()" v-model="searchItem">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="employees.length > 0" v-for="employee in employees">
                                    <td>{{ employee.id }}</td>
                                    <td>{{ employee.first_name }}</td>
                                    <td>{{ employee.last_name }}</td>
                                    <td>{{ employee.company.name }}</td>
                                    <td>{{ employee.email }}</td>
                                    <td>{{ employee.phone }}</td>

                                    <td><a class="btn btn-secondary mr-3"
                                           :href="'/employees/'+employee.id+'/edit'">Edit</a>
                                        <a class="btn btn-danger"
                                           @click.prevent="deleteEmployee(employee.id)">Delete</a>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="7" class="text-center">No data</td>
                                </tr>
                                </tbody>
                            </table>
                            <nav class="d-flex justify-content-center mt-5" v-if="pagination.total != 0">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" v-show="pagination.prev_page_url !=null"
                                           :href="pagination.prev_page_url"
                                           @click.prevent="getEmployees(pagination.prev_page_url.substring(pagination.prev_page_url.indexOf('=') + 1))">Previous</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagination.last_page">
                                        <a class="page-link"
                                           :href="'/employees?page='+page"
                                           @click.prevent="getEmployees(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" v-show="pagination.next_page_url !=null"
                                           :href="pagination.next_page_url"
                                           @click.prevent="getEmployees(pagination.next_page_url.substring(pagination.next_page_url.indexOf('=') + 1))">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

</template>

<script>
import {onMounted, ref} from "vue";
import Swal from 'sweetalert2';

export default {
    name: "Index",
    setup() {
        const employees = ref([]);
        const pagination = ref({});
        const searchItem = ref('');

        function getEmployees(page) {
            page === undefined ? page = 1 : page;
            let url;
            if (searchItem.value != '') {
                url = '/employees?search=' + searchItem.value + '&page=' + page;
            } else {
                url = '/employees?page=' + page;
            }

            axios.get(url).then((data) => {
                employees.value = data.data.data;
                pagination.value = data.data;
            })
        }

        function deleteEmployee(employeeId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/employees/' + employeeId).then(() => {
                        window.location.reload();
                    })
                }
            })
        }

        onMounted(() => {
            getEmployees()
        })
        return {employees, pagination, getEmployees, deleteEmployee, searchItem}
    },

}
</script>

<style scoped>
.page-link {
    cursor: pointer;
}

img {
    width: 100px;
    height: 100px;
}
</style>
