<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH CATATAN</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="tgl_keberangkatan" class="font-weight-bold">Tgl Keberangkatan</label>
                                <input type="date" class="form-control" v-model="catatan.tgl_keberangkatan" placeholder="Masukkan Tanggal Keberangkatan Anda">
                                <!-- validation -->
                                <div v-if="validation.tgl_keberangkatan" class="mt-2 alert alert-danger">
                                    {{ validation.tgl_keberangkatan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_keberangkatan" class="font-weight-bold">Waktu Keberangkatan</label>
                                <input type="time" class="form-control" v-model="catatan.waktu_keberangkatan" placeholder="Masukkan Waktu Keberangkatan Anda">
                                <!-- validation -->
                                <div v-if="validation.waktu_keberangkatan" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_keberangkatan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_perjalanan" class="font-weight-bold">waktu_perjalanan</label>
                                <input type="time" class="form-control" v-model="catatan.waktu_perjalanan" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.waktu_perjalanan" class="mt-2 alert alert-danger">
                                    {{ validation.waktu_perjalanan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="font-weight-bold">Tujuan</label>
                                <input type="text" class="form-control" v-model="catatan.tujuan" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.tujuan" class="mt-2 alert alert-danger">
                                    {{ validation.tujuan[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlp" class="font-weight-bold">No Telp</label>
                                <input type="number" class="form-control" v-model="catatan.tlp" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.tlp" class="mt-2 alert alert-danger">
                                    {{ validation.tlp[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rating" class="font-weight-bold">Rating</label>
                                <input type="text" class="form-control" v-model="catatan.rating" placeholder="Masukkan Judul catatan">
                                <!-- validation -->
                                <div v-if="validation.rating" class="mt-2 alert alert-danger">
                                    {{ validation.rating[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan_user" class="font-weight-bold">Catatan User</label>
                                <input type="text" class="form-control" v-model="catatan.catatan_user" placeholder="Masukkan Judul catatan">
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
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    name: "catatan.create",
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

        //method store
        function store() {

            let tgl_keberangkatan   = catatan.tgl_keberangkatan
            let waktu_keberangkatan = catatan.waktu_keberangkatan
            let waktu_perjalanan    = catatan.waktu_perjalanan
            let tujuan              = catatan.tujuan
            let tlp                 = catatan.tlp
            let rating              = catatan.rating
            let catatan_user        = catatan.catatan_user

            axios.post('http://localhost:8000/api/catatan', {
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
            store
        }

    }

}
</script>