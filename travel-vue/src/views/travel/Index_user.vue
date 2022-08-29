<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>DATA USER</h4>
                        <hr>
                        <router-link :to="{name: 'travel.create_user'}" class="btn btn-md btn-success">TAMBAH POST</router-link>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pengguna, index) in pengguna" :key="index">
                                    <td>{{ pengguna.nama_lengkap }}</td>
                                    <td>{{ pengguna.tgl_lahir }}</td>
                                    <td>{{ pengguna.email }}</td>
                                    <td>{{ pengguna.NIK }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'travel.edit_user', params:{id: pengguna.id }}" class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button class="btn btn-sm btn-danger ml-1">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    setup() {

        //reactive state
        let pengguna = ref([])

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/pengguna')
            .then(response => {
              
              //assign state posts with response data
              pengguna.value = response.data.data

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //return
        return {
            pengguna
        }

    }

}
</script>

<style>
    body{
        background: lightgray;
    }
</style>