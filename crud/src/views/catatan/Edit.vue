<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT CATATAN</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="tgl_keberangkatan" class="font-weight-bold">Tgl Keberangkatan</label>
                                <input type="date" class="form-control" v-model="catatan.tgl_keberangkatan" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.tgl_keberangkatan" class="mt-2 alert alert-danger">
                                    {{ validation.tgl_keberangkatan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_keberangkatan" class="font-weight-bold">Waktu Keberangkatan</label>
                                <input type="time" class="form-control" v-model="catatan.waktu_keberangkatan" placeholder="Masukkan Judul waktu_keberangkatan">
                                <!-- validation -->
                                <div v-if="validation.waktu_keberangkatan" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_keberangkatan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_perjalanan" class="font-weight-bold">Waktu Perjalanan</label>
                                <input type="time" class="form-control" v-model="catatan.waktu_perjalanan" placeholder="Masukkan Judul waktu_perjalanan">
                                <!-- validation -->
                                <div v-if="validation.waktu_perjalanan" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_perjalanan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="font-weight-bold">Tujuan</label>
                                <input type="text" class="form-control" v-model="catatan.tujuan" placeholder="Masukkan Judul tujuan">
                                <!-- validation -->
                                <div v-if="validation.tujuan" class="mt-2 alert alert-danger">
                                    {{ validation.tujuan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlp" class="font-weight-bold">tlp</label>
                                <input type="number" class="form-control" v-model="catatan.tlp" placeholder="Masukkan Judul tlp">
                                <!-- validation -->
                                <div v-if="validation.tlp" class="mt-2 alert alert-danger">
                                    {{ validation.tlp[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rating" class="font-weight-bold">Rating</label>
                                <input type="text" class="form-control" v-model="catatan.rating" placeholder="Masukkan Judul rating">
                                <!-- validation -->
                                <div v-if="validation.rating" class="mt-2 alert alert-danger">
                                    {{ validation.rating[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan_user" class="font-weight-bold">Catatan User</label>
                                <input type="text" class="form-control" v-model="catatan.catatan_user" placeholder="Masukkan Judul catatan_user">
                                <!-- validation -->
                                <div v-if="validation.catatan_user" class="mt-2 alert alert-danger">
                                    {{ validation.catatan_user[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>                      

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
    name: "catatan.edit",
    setup() {

        //state catatans
        const catatan = reactive({
            tgl_keberangkatan: '',
            waktu_keberangkatan: '',
            waktu_perjalanan: '',
            tujuan: '',
            tlp: '',
            rating: '',
            catatan_user: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //vue router
        const route = useRoute()

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/catatan/${route.params.id}`)
            .then(response => {
              
              //assign state catatans with response data
              catatan.tgl_keberangkatan  = response.data.data.tgl_keberangkatan  
              catatan.waktu_keberangkatan  = response.data.data.waktu_keberangkatan  
              catatan.waktu_perjalanan      = response.data.data.waktu_perjalanan  
              catatan.tujuan      = response.data.data.tujuan 
              catatan.tlp      = response.data.data.tlp  
              catatan.rating      = response.data.data.rating 
              catatan.catatan_user      = response.data.data.catatan_user  

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let tgl_keberangkatan   = catatan.tgl_keberangkatan
            let waktu_keberangkatan = catatan.waktu_keberangkatan
            let waktu_perjalanan    = catatan.waktu_perjalanan
            let tujuan              = catatan.tujuan
            let tlp                 = catatan.tlp
            let rating              = catatan.rating
            let catatan_user        = catatan.catatan_user

            axios.put(`http://localhost:8000/api/catatan/${route.params.id}`, {
                tgl_keberangkatan: tgl_keberangkatan,
                waktu_keberangkatan: waktu_keberangkatan,
                waktu_perjalanan: waktu_perjalanan,
                tujuan: tujuan,
                tlp: tlp,
                rating: rating,
                catatan_user: catatan_user
            }).then(() => {

                //redirect ke catatan index
                router.push({
                    name: 'catatan.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            catatan,
            validation,
            router,
            update
        }

    }

}
</script>