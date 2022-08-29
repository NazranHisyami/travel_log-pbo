<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH USER</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="nama_lengkap" class="font-weight-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" v-model="pengguna.nama_lengkap">
                                <!-- validation -->
                                <div v-if="validation.nama_lengkap" class="mt-2 alert alert-danger">
                                    {{ validation.nama_lengkap[0] }}
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="tgl_lahir" class="font-weight-bold mt-3">Tanggal Lahir</label>
                                <input type="date" class="form-control" v-model="pengguna.tgl_lahir">
                                <!-- validation -->
                                <div v-if="validation.tgl_lahir" class="mt-2 alert alert-danger">
                                    {{ validation.tgl_lahir[0] }}
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="email" class="font-weight-bold mt-3">Email</label>
                                <input type="text" class="form-control" v-model="pengguna.email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0] }}
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="NIK" class="font-weight-bold mt-3">NIK</label>
                                <input type="number" class="form-control" v-model="pengguna.NIK">
                                <!-- validation -->
                                <div v-if="validation.nik" class="mt-2 alert alert-danger">
                                    {{ validation.nik[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">SIMPAN</button>
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

    setup() {

        //state posts
        const pengguna = reactive({
            nama_lengkap: '',
            tgl_lahir: '',
            email: '',
            NIK: '',
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //method store
        function store() {

            let nama_lengkap   = pengguna.nama_lengkap
            let tgl_lahir = pengguna.tgl_lahir
            let email = pengguna.email
            let NIK = pengguna.NIK

            axios.post('http://localhost:8000/api/Pengguna', {
                pengguna: nama_lengkap,
                tgl_lahir: tgl_lahir,
                email: email,
                NIK: NIK
            }).then(() => {

                //redirect ke post index
                router.push({
                    name: 'travel.index_user'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            pengguna,
            validation,
            router,
            store
        }

    }

}
</script>

<style>
    body{
        background: lightgray;
    }
</style>