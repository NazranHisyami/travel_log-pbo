<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Data Rencana Perjalanan</h4>
                        <hr>
                        <router-link :to="{name: 'rencana.create'}" class="btn btn-md btn-success">TAMBAH RENCANA</router-link>
                        <div class="table-responsive">
                          
                        <table class="table table-bordered mt-4 text-center table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Tgl Keberangkatan</th>
                                    <th scope="col">Waktu Keberangkatan</th>
                                    <th scope="col">Waktu Perjalanan</th>
                                    <th scope="col">Tujuan</th>
                                    <th scope="col">TELP</th>
                                    <th scope="col">OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody v-if="rencanas.length > 0">
                                <tr v-for="(rencana, index) in rencanas" :key="index">
                                    <td>{{ rencana.tgl_keberangkatan }}</td>
                                    <td>{{ rencana.waktu_keberangkatan }}</td>
                                    <td>{{ rencana.waktu_perjalanan }}</td>
                                    <td>{{ rencana.tujuan }}</td>
                                    <td>{{ rencana.tlp }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'rencana.edit', params:{id: rencana.id }}" class="btn btn-sm mr-1 btn-primary">EDIT</router-link>
                                        <button @click.prevent="rencanaDelete(rencana.id)" class="btn btn-sm mr-1 btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                       </div>
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
    name: "rencana.index",
    setup() {
        //method delete
        function rencanaDelete(id) {
            
        //delete data rencana by ID
        axios.delete(`http://localhost:8000/api/rencana/${id}`)
        .then(() => {
                       
        //splice rencanas 
        rencanas.value.splice(rencanas.value.indexOf(id), 1);
         
        }).catch(error => {
            console.log(error.response.data)
        })
         
         }
         
        //reactive state
        let rencanas = ref([])

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/rencana')
            .then(response => {
              
              //assign state rencanas with response data
              rencanas.value = response.data.data

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //return
        return {
            rencanas,
            rencanaDelete
        }

    }

}
</script>