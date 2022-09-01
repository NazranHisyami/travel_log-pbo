<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT RENCANA</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="tgl_keberangkatan" class="font-weight-bold">Tgl Keberangkatan</label>
                                <input type="date" class="form-control" v-model="rencana.tgl_keberangkatan" placeholder="Masukkan Judul rencana">
                                <!-- validation -->
                                <div v-if="validation.tgl_keberangkatan" class="mt-2 alert alert-danger">
                                    {{ validation.tgl_keberangkatan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_keberangkatan" class="font-weight-bold">Waktu Keberangkatan</label>
                                <input type="time" class="form-control" v-model="rencana.waktu_keberangkatan" placeholder="Masukkan Judul waktu_keberangkatan">
                                <!-- validation -->
                                <div v-if="validation.waktu_keberangkatan" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_keberangkatan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_perjalanan" class="font-weight-bold">Waktu Perjalanan</label>
                                <input type="time" class="form-control" v-model="rencana.waktu_perjalanan" placeholder="Masukkan Judul waktu_perjalanan">
                                <!-- validation -->
                                <div v-if="validation.waktu_perjalanan" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_perjalanan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="font-weight-bold">Tujuan</label>
                                <input type="text" class="form-control" v-model="rencana.tujuan" placeholder="Masukkan Judul tujuan">
                                <!-- validation -->
                                <div v-if="validation.tujuan" class="mt-2 alert alert-danger">
                                    {{ validation.tujuan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlp" class="font-weight-bold">tlp</label>
                                <input type="number" class="form-control" v-model="rencana.tlp" placeholder="Masukkan Judul tlp">
                                <!-- validation -->
                                <div v-if="validation.tlp" class="mt-2 alert alert-danger">
                                    {{ validation.tlp[0] }}
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
    name: "rencana.edit",
    setup() {

        //state rencanas
        const rencana = reactive({
            tgl_keberangkatan: '',
            waktu_keberangkatan: '',
            waktu_perjalanan: '',
            tujuan: '',
            tlp: ''
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
            axios.get(`http://localhost:8000/api/rencana/${route.params.id}`)
            .then(response => {
              
              //assign state rencanas with response data
              rencana.tgl_keberangkatan  = response.data.data.tgl_keberangkatan  
              rencana.waktu_keberangkatan  = response.data.data.waktu_keberangkatan  
              rencana.waktu_perjalanan      = response.data.data.waktu_perjalanan  
              rencana.tujuan      = response.data.data.tujuan 
              rencana.tlp      = response.data.data.tlp  

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let tgl_keberangkatan   = rencana.tgl_keberangkatan
            let waktu_keberangkatan = rencana.waktu_keberangkatan
            let waktu_perjalanan    = rencana.waktu_perjalanan
            let tujuan              = rencana.tujuan
            let tlp                 = rencana.tlp

            axios.put(`http://localhost:8000/api/rencana/${route.params.id}`, {
                tgl_keberangkatan: tgl_keberangkatan,
                waktu_keberangkatan: waktu_keberangkatan,
                waktu_perjalanan: waktu_perjalanan,
                tujuan: tujuan,
                tlp: tlp
            }).then(() => {

                //redirect ke rencana index
                router.push({
                    name: 'rencana.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            rencana,
            validation,
            router,
            update
        }

    }

}
</script>